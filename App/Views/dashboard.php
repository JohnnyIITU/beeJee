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
		<div class="col-12 d-flex justify-content-end">
			<?php if(!isset($_SESSION['user'])){?>
				<a href="/login">Войти</a>
			<?php }else{ ?>
				<a href="/login/logout">Выйти</a>
			<?php }?>
		</div>
		<div class="col-12 d-flex justify-content-end">
			<a href="/dashboard/new">Новая задача</a>
		</div>
		
		<div class="col-12">
			<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="th-sm" onclick="sort(0)">Имя пользователя</th>
						<th class="th-sm" onclick="sort(1)">Email</th>
						<th class="th-sm">Текст</th>
						<th class="th-sm" onclick="sort(3)">Статус</th>
						<th class="th-sm">Отметка</th>
						<?php if(isset($_SESSION['user'])){?>
							<th class="th-sm">Операции</th>
						<?php }?>	
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($data['table'] as $value) {?>
						<tr>
							<td><?= strip_tags($value['username']) ?></td>
							<td><?= strip_tags($value['email']) ?></td>
							<?php if(!isset($_SESSION['user'])){?>
								<td><?= strip_tags($value['description']) ?></td>
							<?php }else{?>
								<td><input type="text" id="desc_<?=$value['id']?>" value="<?= strip_tags($value['description']) ?>"/></td>
							<?php } ?>
							<td><?= strip_tags($value['status'])?></td>
							<td><?= $value['created_at'] !== $value['updated_at'] ? 'Отредактировано администратором' : '' ?></td>
							<?php if(isset($_SESSION['user'])){?>
								<td class="th-sm">
									<a onclick="save(<?= $value['id'] ?>)">Сохранить</a>
									<a onclick="setEx(<?= $value['id'] ?>)">Выполнено</a>
								</td>
							<?php }?>	
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if($data['hasPrev']){?>
				<a onclick="prevPage(<?= $_GET['page']??'1'?>)">Prev</a>
			<?php }?>
			<?php if($data['hasNext']){?>
				<a onclick="nextPage(<?= $_GET['page']??'1'?>)">Next</a>
			<?php }?>
		</div>
	</div>
</body>






<!-- MDBootstrap Datatables  -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
	function sort(n) {
  		type = parseInt(n);
  		if(type === 0){
  			location.href = "/dashboard/index?page=<?= $_GET['page']??'1'?>&order=username&type=<?= $_GET['order'] ?? 'id' === 'username' ? ($_GET['type'] === 'desc' ? 'asc' : 'desc'): 'asc' ?>";
  		}else if(type === 1){
			location.href = "/dashboard/index?page=<?= $_GET['page']??'1'?>&order=email&type=<?= $_GET['order'] ?? 'id' === 'email' ? ($_GET['type'] === 'desc' ? 'asc' : 'desc') : 'asc' ?>";
  		}else{
			location.href = "/dashboard/index?page=<?= $_GET['page']??'1'?>&order=status&type=<?= $_GET['order'] ?? 'id' === 'status' ? ($_GET['type'] === 'desc' ? 'asc' : 'desc') : 'asc' ?>";
  		}
  	}
	function save(id){
		var desc = $('#desc_'+id).val();
		location.href="/dashboard/edit?id="+id+"&desc="+desc;
	}

	function setEx(id){
		location.href="/dashboard/set?id="+id;
	}
	function nextPage(page){
		page++;
		location.href = "/dashboard/index?page="+page+"&order=<?= $_GET['order'] ?? 'id' ?>&type=<?= $_GET['type'] ?? 'asc'?>";
	}
	function prevPage(page){
		page--;
		location.href = "/dashboard/index?page="+page+"&order=<?= $_GET['order'] ?? 'id' ?>&type=<?= $_GET['type'] ?? 'asc'?>";
	}

</script>	
</html>