<html>
<head>
	<!-- MDBootstrap Datatables  -->
	<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<a href="/">Домой</a>
		<form action="/dashboard/add" method="POST">
		  	<div class="form-group">
		    	<label for="exampleInputEmail1">Имя пользователя</label>
		    	<input type="username" class="form-control" name="username" placeholder="Имя пользователя">
		  	</div>
		  	<div class="form-group">
		    	<label for="exampleInputPassword1">Email</label>
		    	<input type="email" class="form-control" name="email" placeholder="Email">
		  	</div>
		  	<div class="form-group">
		    	<label for="exampleInputPassword1">Описание</label>
		    	<textarea class="form-control" name="description" rows="3"></textarea>
		  	</div>
		  	<button type="submit" class="btn btn-primary">Отправить</button>
		</form>
	</div>
</body>


<!-- MDBootstrap Datatables  -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>