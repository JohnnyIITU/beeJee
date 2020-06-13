<?php
session_start();
class LoginController extends Controller
{
	public function actionIndex(){
		$view = new View();
		$view->view('login', '');
	}

	public function actionLogin(){
		$view = new View();
		$username = $_POST['username'];
		$password = $_POST['password'];
		if($username === '' || $password === '')
			return $view->view('error', '', [
				'text' => 'Заполните все поля',
				'redirect' => '/login', 
				'linkText' => 'Войти'
			]);
		Model::init('user');
		$user = new User();
		$auth = $user->checkLogin($username,$password);
		if(!$auth)
			return $view->view('error', '', [
				'text' => 'Введены некорретные данные',
				'redirect' => '/login', 
				'linkText' => 'Войти'
			]);
		$_SESSION['user'] = $auth;
		header('Location: /');
		exit();
	}

	public function actionLogout(){
		session_destroy();
		header('Location: /');
		exit();
	}
}