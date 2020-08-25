<?php 

	//Page Redirect
	function redirect($page)
	{
		// sharepost/$page = sharepost/controller/method
		header('location: ' . URLROOT . '/' . $page); 
	} // redirect


 ?>