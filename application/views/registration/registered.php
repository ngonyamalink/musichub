<style type="text/css">
.t {
	font-family: "Arial Black", Gadget, sans-serif;
	font-size: 50px;
	text-align: center;
}

.lrg {
	font-size: 25px;
}

.lrg {
	font-size: 20px;
}
</style>
<p align="center" class="lrg">

	<br /> <strong class="t">Thank You! </strong> <br />
	<br /> Your registration was successful. Please visit your e-mails and
	activate your account.
<div class="container">
	<div class="row centered-form">
		<div
			class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Please sign up for Demo Tracks<small></small>
					</h3>
				</div>
				<div class="panel-body">
					<form role="form"
						action="<?php echo base_url()."registration/add_user" ?>"
						method='post'>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="name" id="first_name"
										class="form-control input-sm" placeholder="First Name">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="text" name="surname" id="last_name"
										class="form-control input-sm" placeholder="Last Name">
								</div>
							</div>
						</div>

						<div class="form-group">
							<input type="email" name="username" id="email"
								class="form-control input-sm" placeholder="Email Address">
						</div>

						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
                                    <?php
                                    $user_categories = get_usercategories();

                                    $a_user_categories = array();

                                    foreach ($user_categories as $u) {
                                        $a_user_categories[$u['usercategory_id']] = $u['usercategory_name'];
                                    }

                                    echo form_dropdown("usercategory_id", $a_user_categories, 0, 'class="form-control input-sm"');
                                    ?>
                                </div>

							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">


                                    <?php
                                    $provinces = get_provinces();

                                    $a_provinces = array();
                                    foreach ($provinces as $p) {
                                        $a_provinces[$p['province_id']] = $p['province_name'];
                                    }
                                    echo form_dropdown("province_id", $a_provinces, 0, 'class="form-control input-sm"');
                                    ?> 

                                </div>
							</div>

						</div>
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password" id="password"
										class="form-control input-sm" placeholder="Password">
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<input type="password" name="password_confirmation"
										id="password_confirmation" class="form-control input-sm"
										placeholder="Confirm Password">
								</div>
							</div>
						</div>

						<input type="submit" value="Register"
							class="btn btn-info btn-block">

					</form>
				</div>
			</div>
		</div>
	</div>
</div>