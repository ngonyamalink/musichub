<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-5">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Tell a Friend</h3>
				</div>
				<div class="card-body">
					<div class="small mb-3 text-muted">Enter the email address of a
						person you wish to refer to High Media.</div>
					<form action="<?php echo base_url("open/submit_tell_a_friend")?>"
						method="POST">
						<div class="form-group">
							<label class="small mb-1" for="inputEmailAddress">Email</label> <input
								class="form-control py-4" id="inputEmailAddress" name="email"
								type="email" aria-describedby="emailHelp"
								placeholder="Enter email address" />
						</div>
						<div align="center">
							<input type="submit" class="btn btn-primary" />
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>