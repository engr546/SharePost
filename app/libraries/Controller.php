
<?php 

	
	/**
	 * Base Controller
	 * Loads the models and views
	 */
	class Controller
	{

		// Laod Model
		public function model($model)
		{
			// Require model fuke
			require_once('../app/models/' .$model . '.php');
			// Instantiate Model
			// new Post() (example format)
			return new $model() ;
		} // model

		// Laod view
		public function view($view, $data = [])
		{
			// Check for view file
			if (file_exists('../app/views/' . $view . '.php')) {
				require_once '../app/views/' . $view . '.php';
			}else {
				// View does not exists
				die($view . ' does not exist');
			}
		} // view

	} // Controller


 ?>