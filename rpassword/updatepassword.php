<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ngonyama Link</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <img alt="Brand" src="http://localhost/ngonyamalink/resource/img/logo.png" width="100%" height="50px" >
                            </div>
                            <div class="panel-body">
                                <?php
                                error_reporting(1);

                                function do_hash($str, $type = 'sha1') {
                                    if ($type == 'sha1') {
                                        return sha1($str);
                                    } else {
                                        return md5($str);
                                    }
                                }

                                $pwd = md5($_POST['password']);
                                $email = strtolower($_POST['email']);
                                $code = $_POST['code'];



                                //ngonyama
                                $link = mysqli_connect("localhost", "root", "", "ngonyama");
                                $query = "update member set member_password='$pwd' where  (member_email='$email' and activation_code=$code)";
                                $result = $link->query($query);

                                //phangisa
                                $link = mysqli_connect("localhost", "root", "", "phangisa");
                                $query = "update member set member_password='$pwd' where  (member_email='$email')";
                                $result = $link->query($query);

                                //umculo
                                $link = mysqli_connect("localhost", "root", "", "umculo");
                                $query = "update member set member_password='$pwd' where  (member_email='$email')";
                                $result = $link->query($query);


                                echo "Your password has been updated successfully.<br><br><a href='http://localhost/ngonyamalink' class='btn btn-default'>Login Here</a>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </body>
</html>
