<div>
	<?php
	  $this->load->view('alert');
	?>
</div>


<?php echo $error; ?> <!-- Error Message will show up here -->


<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload file</h3></div>
                                    <div class="card-body">
                                       <?php echo form_open_multipart(base_url() . 'music/do_upload'); ?>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Genre</label>
                                                   
                                                   <?php 
                                                   
                                                   
                                                   $music_cat = get_musiccategories();
                                                   $a_m_c = array();
                                                   
                                                   
                                                   foreach ($music_cat as $mc) {
                                                       $a_m_c[$mc['musiccategory_id']] = $mc['musiccategory_name'];
                                                   }
                                                   
                                                   echo form_dropdown('musiccategory_id', $a_m_c, 1, "class='form-control'");
                                                   ?>
                                                   
                                                   
                                                   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">File name</label>
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="" name="file_label"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">File to upload</label>
                                                <input class="form-control" id="inputEmailAddress" type="file" aria-describedby="emailHelp" placeholder="" name="userfile"/>
                                            </div>
                                            
                                            
                                             <div class="form-group">
                                               <label class="small mb-1" for="inputLastName">Price In Rands</label>
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="" name="price"/>
                                            </div>
                                            
                                            <div class="form-group mt-4 mb-0"> <input type="submit" class="btn btn-primary"/></div>
                                      <?php 
                                      echo form_close(); ?>
                                      
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>



