<?php 
	session_start();
	class DashboardController extends Controller
	{
		function actionIndex(){
			$view = new View();
			Model::init('exercise');
			$exercise = new Exercise();
			$exercises = $exercise->getExercises($_GET['page'] ?? 1, $_GET['order'] ?? 'id', $_GET['type'] ?? 'asc');
			$view->view('dashboard', '', [
				'table' => $exercises, 
				'hasPrev' => ($_GET['page'] ?? 1) > 1,
				'hasNext' => $exercise->hasNext($_GET['page'] ?? 1, $_GET['order'] ?? 'id', $_GET['type'] ?? 'asc')
			]);		
		}

		function actionEdit(){
			if(!isset($_SESSION['user'])){
				return $view->view('error', '', [
					'text' => 'Авторизуйтесь',
					'redirect' => '/', 
					'linkText' => 'Домой'
				]);
			}
			$id = $_GET['id'];
			$desc = $_GET['desc'];
			Model::init('exercise');
			$exercise = new Exercise();
			if($exercise->changeText($id, $desc)){
				header('Location: /');
			}else{
				return $view->view('error', '', [
					'text' => 'Такого ID не существует',
					'redirect' => '/', 
					'linkText' => 'Домой'
				]);
			}
		}

		function actionSet(){
			if(!isset($_SESSION['user'])){
				return $view->view('error', '', [
					'text' => 'Авторизуйтесь',
					'redirect' => '/', 
					'linkText' => 'Домой'
				]);
			}
			$id = $_GET['id'];
			Model::init('exercise');
			$exercise = new Exercise();
			$view = new View();
			if($exercise->setStatus($id)){
				header('Location: /');
			}else{
				return $view->view('error', '', [
					'text' => 'Такого ID не существует',
					'redirect' => '/', 
					'linkText' => 'Домой'
				]);
			}
		}

		function actionNew(){
			$view = new View();
			$view->view('new', '');
		}

		function actionAdd(){
			$view = new View();
			$username = $_POST['username'];
			$email = $_POST['email'];
			$desc = $_POST['description'];
			if($username === '' || $email === '' || $desc === '')
				return $view->view('error', '', [
					'text' => 'Заполните поля',
					'redirect' => '/dashboard/new', 
					'linkText' => 'Назад'
				]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				return $view->view('error', '', [
					'text' => 'неверный Email',
					'redirect' => '/dashboard/new', 
					'linkText' => 'Назад'
				]);
			Model::init('exercise');
			$exercise = new Exercise();
			$exercise->newEx($username, $email, $desc);
			$view = new View();
			$view->view('success', '');
		}
	}
?>