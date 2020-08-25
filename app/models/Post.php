<?php 


	/**
	 * Post Model
	 */		
	class Post
	{
		
		private $db;

		function __construct()
		{
			// Instantiate Database Class
			$this->db = new Database;
		} //__construct

		public function getPosts()
		{
			// Prepare Query
			$this->db->query('SELECT *,
							SUBSTRING(posts.body, 1, 250) as postBody,
							posts.id as postId,
							users.id as userId,
							posts.created_at as postCreated,
							users.created_at as userCreated
							FROM posts
							INNER JOIN users
							ON posts.user_id = users.id
							ORDER BY postCreated DESC
							');
			// Fetch Data
			$results = $this->db->resultSet();
			return $results;
		} // getPosts

		public function getPostById($id)
		{
			// Prepare Query
			$this->db->query('SELECT * FROM posts WHERE id = :id');
			// Bind Values
			$this->db->bind(':id', $id);
			// Fetch Data
			$result = $this->db->single();
			return $result;
		} // getPostById


		public function addPost($data)
		{
			// Prepare Query
			$this->db->query('INSERT INTO posts (user_id, title, body) VALUES(:user_id, :title, :body) ');
			// Bind Values
			$this->db->bind(':user_id', $data['user_id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':body', $data['body']);
			// Execute Prepared Statements
			if ($this->db->execute()) {
				return true;
			}else {
				return false;
			}
		} // addPost	
    
		public function updatePost($data){
			// Prepare Query
			$this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
			// Bind values
			$this->db->bind(':id', $data['id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':body', $data['body']);
			// Execute
			if($this->db->execute()){
			return true;
			} else {
			return false;
			}
		} // updatePost

		public function deletePost($id)
		{
			// Prepare Query
			$this->db->query('DELETE FROM posts WHERE id = :id');
			// Bind Values
			$this->db->bind(':id', $id);
			// Execute Prepared Statements
			if ($this->db->execute()) {
				return true;
			}else {
				return false;
			}
		} // deletePost

	} // Post

 ?>