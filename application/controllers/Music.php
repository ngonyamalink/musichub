<?php


class Music extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array("user_lib", "session","email"));
        $this->load->model(array("music_db"));
        $this->user_session = $this->session->all_userdata();
        $this->load->helper(array("musiccategory"));

        if (isset($this->user_session['user_id']) && $this->user_session['user_id'] > 0) {
           $this->user_lib->get_user_by_username_password($this->user_session['username'], $this->user_session['password']);
        } else {
            redirect("login");
        }
        
      $data['foldersback'] = '..';
        
    }

    public function index() {
        $data['foldersback'] = '.';
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['music_list'] = $this->music_db->get_music_by_userid($this->user_session['user_id']);
        $data['user_session'] = $this->user_session;
        $data['error'] = ' ';
        $this->load->view("layout/header_in", $data);
        $this->load->view("music/index", $data);
        $this->load->view("layout/footer_in",$data);
    }

    public function upload_form($processed = 0) {
        if($processed == 1){
            $this->session->set_flashdata('success', 'File sucessfully uploaded. Enjoy the unlimitted streaming and uploads of media contents.');
            
        }
        
        $data['foldersback'] = '..';
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['user_session'] = $this->user_session;
        $data['error'] = '';
        $this->load->view("template/welcome_header", $data);
        $this->load->view("music/upload_form", $data);
        $this->load->view("template/welcome_footer");
    }

    public function do_upload() {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000777777", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768555",
            'max_width' => "1024555",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array('upload_data' => $this->upload->data());

            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata = $this->input->post();
            
            $this->music_db->add_music(array("price"=>$fdata['price'],"music_link" => $attachment_url, "file_label" => $fdata['file_label'], "user_id" => $this->user_session['user_id'], "musiccategory_id" => $fdata['musiccategory_id']));

            // START BROADCAST
            
            //send email out
            $keyword = "email";
            $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/index.php/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/infiniteshops/index.php/welcome/get_subscriptions_json";
            $json = file_get_contents($url_subscriptions . "/" . $keyword);
            $emails =  json_decode($json, true);
            
            //send sms out
            $keyword = "phone";
            $url_subscriptions = (ENVIRONMENT == 'development') ? "http://localhost:8888/ngonyamalinkwebsite/index.php/welcome/get_subscriptions_json" : "https://www.ngonyamalink.co.za/infiniteshops/index.php/welcome/get_subscriptions_json";
            $json = file_get_contents($url_subscriptions . "/" . $keyword);
            $phones =  json_decode($json, true);
            
            // send email push notifications
            
            $email_string = 'info@ngonyamalink.co.za';
            
            $cnt = 0;
            
            foreach ( $emails as $value) {
                $cnt = $cnt + 1;
                $email_string = $email_string . "," . $value['email'];
            }
            
            if ($email_string != NULL) {
                
                echo ("Email Receipients : " . $email_string);
                
                $this->email->from('no-reply@ngonyamalink.co.za', 'NginyamaLink Wesbite');
                $this->email->bcc($email_string);
                $this->email->subject("Get Music : ".$fdata['file_label']);
                $this->email->message("A new track was uploaded on Ngonyama Link system. Proceed to download ? https://www.ngonyamalink.co.za/highmedia");
                $this->email->send();
            }
            
            sleep(3);
            
            $textmessage = str_replace(" ", "+",  $fdata['file_label'] . " : A new track was uploaded on Ngonyama Link system. Proceed to download ? https://www.ngonyamalink.co.za/highmedia");
            
            
          
            // send sms push notifications
            echo "<br/><br/>";
            
            $phone_string = '+27633861016';
            $cnt = 0;
            foreach ($phones as $value) {
                $cnt = $cnt + 1;
                $phone_string = $phone_string . "," . $value['phone'];
            }
            
            $phone_string = substr($phone_string, 1, strlen($phone_string));
            
            if ($phone_string != NULL) {
                
                echo ("SMS Receipients : " . $phone_string);
                
                $url = "https://platform.clickatell.com/messages/http/send?apiKey=uqTlIWcPRviI0IGfaVtBgg==&to=+27713022315&content=$textmessage.";
                
                $ch = curl_init();
                
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                
                $response = curl_exec($ch);
                curl_close($ch);
                
                var_dump($response);
            }
            
            // END BROADCAST

            redirect(base_url("music/upload_form/1"));
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('music/upload_form', $error);
        }
    }


    public function all_music($category_id = 0) {
        $data['foldersback'] = '..';
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        
        
        
        if($category_id>0){
            $data['music_list'] = $this->music_db->get_all_music_by_category_id($category_id);
        }else{
        $data['music_list'] = $this->music_db->get_all_music();
        }
        
        
        
        $data['user_session'] = $this->user_session;
        
        $this->load->view("template/welcome_header", $data);
        $this->load->view("music/index", $data);
        $this->load->view("template/welcome_footer");
        
   
    }

    public function choose_category() {
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['foldersback'] = '..';
        
        $data['user_session'] = $this->user_session;
        
        $this->load->view("template/welcome_header", $data);
        
        $this->load->view("music/choose_category");
        $this->load->view("template/welcome_footer",$data);
    }

    public function get_music_by_category() {
        $cat_id = $this->input->post('musiccategory_id');
        redirect(base_url("music/all_music/$cat_id"));
    }

 
}
