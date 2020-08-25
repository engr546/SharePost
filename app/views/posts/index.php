<?php require APPROOT . '/views/inc/header.php'; ?>

	<div class="container">

	<!-- Flash Message -->
	<?php flash('post_message'); ?>
		
		<div class="row mb-3">
			
			<div class="col-md-6">
				<h1>Posts</h1>
			</div> <!-- /col-md-6 -->
			<div class="col-md-6">
				<a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right"> <li class="fa fa-pencil-alt"></li>  Add Post</a>
			</div> <!-- /col-md-6 -->

		</div> <!-- /row mb-3 -->

		<?php foreach ($data['posts'] as $post): ?>
			<div class="card card-body mb-3">
				<h4 class="card-title"><?php echo $post->title; ?></h4>
				<div class="bg-light p-2 mb-3">
					Written by <?php echo $post->name; ?> at <?php echo $post->postCreated; ?>
				</div> <!-- bg-light p-2 mb-3 -->
				<p class="card-text"><?php echo $post->postBody; ?> ...</p>
				<a class="btn btn-dark col-md-2" href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>">More</a>
			</div> <!-- card card-body mb-3 -->
		<?php endforeach ?>

	</div> <!-- /container -->

<?php require APPROOT . '/views/inc/footer.php'; ?>