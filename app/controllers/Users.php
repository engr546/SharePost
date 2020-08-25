<?php 


	/**
	 * Users Controller
	 */
	class Users extends Controller
	{
		
		public function __construct()
		{
			$this->userModel = $this->model('User');
			// Session Helper
			if (isLoggedIn()) {
				// URL Helper
				redirect('posts/index');
			}
		} // __construct

		public function index()
		{
			// Init data
			$data = [
				'email' => '',
				'password' => '',
				'email_error' => '',
				'password_error' => '',
			];
			// Load View
			$this->view('users/login', $data);
		} // index


		public function register()
		{
			// Check for Post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// PROCESS FORM
				// Sanitize Post Data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Init Data
				$data = [
					'name' => trim($_POST['name']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => '',
				];
				// VALIDATE DATA
				// Validate Email
				if (empty($data['email'])) {
					$data['email_error'] = "Please Enter Email";
				} else if ($this->userModel->findUserByEmail($data['email'])) {
					$data['email_error'] = "Email already used";
				}									
				// Validate Name
				if (empty($data['name'])) {
					$data['name_error'] = "Please Enter Name";
				}
				// Validate Password
				if (empty($data['password'])) {
					$data['password_error'] = "Please Enter Password";
				} else if (strlen($data['password']) < 6 ) {
					$data['password_error'] = "Password must be atleast 6 characters";
				}
				// Validate Confirm Password
				if (empty($data['confirm_password'])) {
					$data['confirm_password_error'] = "Please Confirm Password";
				} else if ($data['password'] != $data['confirm_password']) {
					$data['confirm_password_error'] = "Passwords do not match";
				}
				// Make sure errors are empty
				if (empty($data['email_error']) && empty($data['name_error']) &&
						 empty($data['password_error']) && empty($data['confirm_password_error'])) {
					// REGISTER USER
					// Hash passwords
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					// Register User
					if ($this->userModel->register($data)) {
						// REGISTERED SUCCESFULLY
						// Session Helper
						flash('post_message', 'Registered Succesfuly. You can now login');
						// Redirect to login page
						// URL Helper
						redirect('users/login'); 
					}else {
						die('Something went wrong');
					}
				}else {
					// Load View with errors
					$this->view('users/register', $data);
				}
			} else {
				// Init data - Inorder for the user to not re-fill the form
				$data = [
					'name' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => '',
				];
				// Load View
				$this->view('users/register', $data);
			}
		} // register

		public function login()
		{
			// Check for Post
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// PROCESS FORM
				// Sanitize Post Data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				// Init Data
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_error' => '',
					'password_error' => '',
				];
				// Validate Email
				if (empty($data['email'])) {
					$data['email_error'] = "Please Enter Email";
				}
				// Validate Password
				if (empty($data['password'])) {
					$data['password_error'] = "Please Enter Password";
				}
				// Check for User Email
				if (!($this->userModel->findUserByEmail($data['email']))) {
					$data['email_error'] = 'Email not found';
				}
				// Make sure errors are empty
				if (empty($data['email_error']) && empty($data['password_error'])) {
					// VALIDATE DATA
					// Check and Set Logged in user
					$user = $this->userModel->login($data['email'], $data['password']);
					if ($user) {
						// CREATE SESSION
						//Session Helper
						createUserSession($user->id, $user->email, $user->name);
					} else {
						$data['password_error'] = 'Incorect Password';
						// Load View
						$this->view('users/login', $data);
					}
				} else {
					// Load View with errors
					$this->view('users/login', $data);
				} 
			} else {
				// Init data - Inorder for the user to not re-fill the form
				$data = [
					'email' => '',
					'password' => '',
					'email_error' => '',
					'password_error' => '',
				];
				// Load View
				$this->view('users/login', $data);
			}
		} // login


		public function logout()
		{
			//Session Helper
			userLogout();
		} // logout

	} // Users

 ?>