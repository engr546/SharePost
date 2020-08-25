<?php require APPROOT . '/views/inc/header.php'; ?>

	<div class="container">

				<a class="btn btn-light" href="<?php echo URLROOT; ?>/posts/"> <li class="fa fa-backward"></li> Back</a>

				<div class="card card-body bg-light mt-5">

					<h2>Edit Post</h2>
					<p>Edit post with this Form</p>

					<!-- sharepost/posts/add = sharepost/controller/method -->
					<form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method='post'>
						<div class="form-group">
							<label for="title">Title: <sup>*</sup></label>
							<input type="text" name="title" class="form-control form-control-lg
							<?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?> " 
								value="<?php echo $data['title']; ?>"> 
							<span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
						</div> <!-- /form-group -->

						<div class="form-group">
							<label for="body">Body: <sup>*</sup></label>
        					<textarea name="body" class="form-control form-control-lg 
        					<?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
        					<span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
						</div> <!-- /form-group -->
						<input type="submit" name="Submit" class="btn btn-success">
					</form>
				</div> <!-- /card card-body bg-light mt-5 -->
 		
	</div> <!-- /scontainer -->

	
<?php require APPROOT . '/views/inc/footer.php'; ?>