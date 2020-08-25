<?php 


	/**
	 * Post Controller
	 */
	class Posts extends Controller
	{
		
		function __construct()
		{
			// Session Helper
			if (!isLoggedIn()) {
				// URL Helper
				redirect('users/login');
			}
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
		} // __construct

		public function index()
		{
 			// Get Post
 			$posts = $this->postModel->getPosts();
			$data = [
				'posts' => $posts,
			];
			// Load view
			$this->view('posts/index', $data);

			

		} // index

		public function add()
		{
			// Check for Post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// PROCESS FORM				
				// Sanitize Post Data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Init Data
				$data = [
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_error' => '',
					'body_error' => '',
				];
				// VALIDATE DATA
				// Validate Title
				if (empty($data['title'])) {
					$data['title_error'] = "Please Enter Title";
				}
				// Validate Body 
				if (empty($data['body'])) {
					$data['body_error'] = "Please Enter Post";
				}
				// Make sure errors are empty
				if (empty($data['title_error']) && empty($data['body_error'])) {
					// ADD POST
					if ($this->postModel->addPost($data)) {
						// ADD POST SUCCESSFULLY
						// Session Helper
						flash('post_message', 'Post Added');
						// Redirect to post index
						// URL Helper
						redirect('posts'); 
					} else {
						die('Something went wrong');
					}
				} else {
					// Load view with erros
					$this->view('posts/add', $data);
				}
			} else {
				// Init Data - Inorder for the user to not re-fill the form
				$data = [
					'title' => '',
					'body' => '',
				];
				// Laod view
				$this->view('posts/add', $data);
			}
		} // add

		public function edit($id)
		{
			// Check for Post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// PROCESS FORM				
				// Sanitize Post Data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Init Data
				$data = [
					'id' => $id,
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_error' => '',
					'body_error' => '',
				];
				// VALIDATE DATA
				// Validate Title
				if (empty($data['title'])) {
					$data['title_error'] = "Please Enter Title";
				}
				// Validate Body 
				if (empty($data['body'])) {
					$data['body_error'] = "Please Enter Post";
				}
				// Make sure errors are empty
				if (empty($data['title_error']) && empty($data['body_error'])) {
					// ADD POST
					if ($this->postModel->updatePost($data)) {
						// ADD POST SUCCESSFULLY
						// Session Helper
						flash('post_message', 'Post edited');
						// // Redirect to post index
						// // URL Helper
						redirect('posts'); 
					} else {
						die('Something went wrong');
					}
				} else {
					// Load view with erros
					$this->view('posts/edit', $data);
				}
			} else {
				// Get current post
				$post = $this->postModel->getPostById($id);
				// Check for Owner
				if ($post->user_id != $_SESSION['user_id']) {
					redirect('post');
				}
				// Init Data 			
				$data = [
					'id' => $id,
					'title' => $post->title,
					'body' => $post->body,
				];
				// Laod view
				$this->view('posts/edit', $data);
			}
		} // edit

		public function delete($id)
		{
			// Check for Post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if ($this->postModel->deletePost($id)) {
					// Session Helper
					// flash('post_message', 'Post Removed', 'alert-danger');
					// URL Helper
					redirect('posts'); 
				}else {
					die('Something went wrong');
				}
			} else {
				// URL Helper
				redirect('posts');
			}
		} // delete()

		public function show($id)
		{
			// Get Post
			$post = $this->postModel->getPostById($id);
			$user = $this->userModel->getUserById($post->user_id);
			$data = [
				'post' => $post,
				'user' => $user,
			];
			// Laod view
			$this->view('posts/show', $data); 
		} // show

	} // Post

 ?>