<?php require APPROOT . '/views/inc/header.php'; ?>

	<div class="container">

		<a class="btn btn-light" href="<?php echo URLROOT; ?>/posts/"> <li class="fa fa-backward mb-3"></li> Back</a>
		<h1><?php echo $data['post']->title; ?></h1>
		<div class="bg-secondary text-white p-2 mb-3">
			Written by <?php echo $data['user']->name; ?> on <?php echo $data['user']->created_at; ?>
		</div>
		<p class="lead">
			<?php echo $data['post']->body; ?>
		</p>

		<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
			<hr>
			<a class="btn btn-dark" href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>">Edit</a>

			<form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post" >
				<input class="btn btn-danger" type="submit" value="Delete"></input>
			</form>

		<?php endif ?>

	</div> <!-- /container -->

<?php require APPROOT . '/views/inc/footer.php'; ?>