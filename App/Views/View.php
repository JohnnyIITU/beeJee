<?php 
	/**
	 * 
	 */
	class View 
	{
		function __construct()
		{
		}

		function view($view, $content, $data = null){
			include "App/Views/$view.php";
		}
	}
?>