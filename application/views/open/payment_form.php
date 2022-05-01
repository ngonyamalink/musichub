<div>
	<?php
$this->load->view('alert');
?>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-7">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Payment Details (R <?php echo $music['price']; ?>) </h3>



				</div>

				<div class="card-header">

					<img class="img-responsive cc-img"
						src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png" width='100%'>

				</div>

				<div class="card-body">
					<form
						action='<?php echo base_url()."registration/add_user" ?>'
						method="POST">
						<div class="form-row">




							<div class="col-md-6">
								<div class="form-group">
									<label>CARD NUMBER</label>
									<div class="input-group">
										<input type="tel" class="form-control"
											placeholder="Valid Card Number" /> <span
											class="input-group-addon"></span>
									</div>
								</div>
							</div>



							<div class="col-md-6">
								<div class="form-group">


									<label>EXPIRATION</label>
									<div class="input-group">
										<input type="tel" class="form-control" placeholder="MM / YY" />
										<span class="input-group-addon"></span>
									</div>



								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">


									<label>CV CODE</label>
									<div class="input-group">
										<input type="tel" class="form-control" placeholder="CVC" /> <span
											class="input-group-addon"></span>
									</div>



								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">



									<label>CARD OWNER</label>
									<div class="input-group">
										<input type="text" class="form-control"
											placeholder="Card Owner Names" /> <span
											class="input-group-addon"></span>
									</div>



								</div>
							</div>
						</div>
						<div class="form-group mt-4 mb-0">
							<input type="submit" class="btn btn-primary" />
						</div>

					</form>
				</div>

			</div>
		</div>
	</div>
</div>