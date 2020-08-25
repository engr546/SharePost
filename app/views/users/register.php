<?php require APPROOT . '/views/inc/header.php'; ?>

	<div class="container">

		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="card card-body bg-light mt-5">

					<h2>Create An Account</h2>
					<p>Please fill out this form to register</p>

					<!-- sharepost/users/register = sharepost/controller/method -->
					<form action="<?php echo URLROOT; ?>/users/register" method='POST'>

						<div class="form-group">
							<label for="name">Name: <sup>*</sup></label>
							<input type="text" name="name" class="form-control form-control-lg
								<?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" 
									value="<?php echo $data['name']; ?>"> <!-- if Error, 'is-invalid' is true else empty -->
							<span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
						</div> <!-- /form-group -->
						
						<div class="form-group">
							<label for="email">Email: <sup>*</sup></label>
							<input type="email" name="email" class="form-control form-control-lg
								<?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" 
									value="<?php echo $data['email']; ?>"> <!-- if Error, 'is-invalid' is true else empty -->
							<span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
						</div> <!-- /form-group -->
						
						<div class="form-group">
							<label for="password">Password: <sup>*</sup></label>
							<input type="password" name="password" class="form-control form-control-lg
								<?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" 
									value="<?php echo $data['password']; ?>"> <!-- if Error, 'is-invalid' is true else empty -->
							<span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
						</div> <!-- /group -->
						
						<div class="form-group">
							<label for="confirm_password">Confirm Password: <sup>*</sup></label>
							<input type="password" name="confirm_password" class="form-control form-control-lg
								<?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>"
									value="<?php echo $data['confirm_password']; ?>"> <!-- if Error, 'is-invalid' is true else empty -->
							<span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
						</div>	<!-- /form-group -->

						<div class="row">
							<div class="col">
								<input type="submit" name="submit" value="Register" class="btn btn-success btn-block">
							</div> <!-- /col -->
							<div class="col">
								<!-- sharepost/users/login = sharepost/controller/method -->
								<a class="btn btn-light btn-block" href="<?php echo URLROOT; ?>/users/login">Have an Account? Login</a>
							</div> <!-- /col -->
						</div> <!-- /row -->

					</form>
				</div> <!-- /card card-body bg-light mt-5 -->
			</div> <!-- /col-md-6 mx-auto -->
		</div> <!-- /row -->
 		
	</div> <!-- /scontainer -->

	
<?php require APPROOT . '/views/inc/footer.php'; ?>