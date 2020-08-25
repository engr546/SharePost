<?php 


	/**
	 * Pages Controller
	 */
	class Pages extends Controller
	{

		public function index()
		{
			// Session Helper
			if (isLoggedIn()) {
				// URL Helper
				redirect('posts');
			}
			$data = [
				'title' => 'Share Posts',
				'description' => 'Simple social network built 
					with MVC PHP Framework',
			];
			// Laod view
			$this->view('pages/index', $data);
		} // index

		public function about()
		{
			$data = [
				'title' => 'ABOUT US',
				'description' => 'App to share post with others',				
			];
			// Laod view
			$this->view('pages/about', $data);
		} // about

	} // Pages

 ?>