<?php 


	/**
	 * User Model Class
	 */
	class User
	{
		
		private $db;

		public function __construct()
		{
			// Instantiate Database
			$this->db = new Database;
		} //__construct

		// Register User
		public function register($data)
		{
			// Prepare Query
			$this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
			// Bind Values
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);
			// Execute Prepared Statements
			if ($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		} // register

		// Logged In
		public function login($email, $password)
		{
			// Prepare Query
			$this->db->query('SELECT * FROM users WHERE email = :email');
			// Bind Values
			$this->db->bind(':email', $email);
			// Fetch Data
			$row = $this->db->single();
			// Unhash Password
			$hashed_password = $row->password;
			// Check Password
			if (password_verify($password, $hashed_password)) {
				return $row;
			}else {
				return false;
			}
		} // login


		// Get User
		public function getUserById($id)
		{
			// Prepare Query
			$this->db->query('SELECT * FROM users WHERE id = :id');
			// Bind Values
			$this->db->bind(':id', $id);
			$row = $this->db->single();
			return $row;
		} // getUserById

		// Find User Email
		public function findUserByEmail($email)
		{
			// Prepare Query
			$this->db->query('SELECT * FROM users WHERE email = :email');
			// Bind Values
			$this->db->bind(':email', $email);
			$row = $this->db->single();
			// Check row
			if ($this->db->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		} // findUserByEmail

	} // User

 ?>