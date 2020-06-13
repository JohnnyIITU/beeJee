<?php
/**
 * 
 */
class Router
{
	static function start(){
		$uri = stristr($_SERVER['REQUEST_URI'], '?', true);
		if(!$uri){
			$uri = $_SERVER['REQUEST_URI'];
		}
		$routes = explode('/', $uri);
		$controller = 'DashboardController';
		$action = 'actionIndex';
		if(!empty($routes[1])){
			$controller = ucfirst(strtolower($routes[1]))."Controller";
		}
		if(!empty($routes[2])){
			$action = "action".ucfirst(strtolower($routes[2]));
		}
		$controllerFile = "App/Controllers/$controller.php";
		if(file_exists($controllerFile)){
			include $controllerFile;
		}else{
			self::abort404();
		}
		$controller = new $controller;
		if (method_exists($controller, $action)) {
			$controller->$action();
		}else{
			self::abort404();
		}
	}

	static function abort404(){
		$view = new View();
		$view->view('404', '');
		die();
	}
}

?>