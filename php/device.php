<?php 
	if (!isset($_COOKIE['login'])) {
	header('Location:../index.php');}
	
	$rights = $_COOKIE['rights'];
	
	if ($rights < 2) {
	header('Location:application.php');}
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	<script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
	<?php include "../html/header.php"; ?>
	
	<div class="container">
		<div class="admin-table">
		

		<?php 
		
		//подключение к БД
		require_once "../connection/connection.php";
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{

			//модальное
			echo '';
		
			//конец модального
			
	echo'<h3>Устройства: </h3>
	
		<div class="searching">
			<form method="post">
				<input class="form-control" name="search" type="text" placeholder="Search..">
				<br><button class="btn btn-outline-primary">Найти</button>
				<a href="device.php" class="btn btn-outline-danger">Сбросить</a>
			</form>		
		</div>
		
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">Название</th>
			  <th scope="col">Тип устройства</th>';
			  if ($rights > 2) {
			  echo '<th scope="col"></th>
			  <th scope="col"></th>';}
			echo '</tr>
		  </thead>
			<tbody>
			<tr>';
			
		//поиск
			$search = $_POST["search"];
			
			if (isset ($search)){
				$select_device = "SELECT * FROM device where type LIKE '%$search%' ORDER BY type";
			}else{	
			$select_device = "SELECT * FROM device ORDER BY type";
			}
			
			$result_device = queryMysql($select_device);
			$rows = $result_device->num_rows;
				 
				for ($i = 0 ; $i < $rows ; ++$i){
				$row = $result_device->fetch_assoc();
				echo '<tr>';
				echo '<td>'. $row['name_device'] . '</td>';
				echo '<td>'. $row['type'] . '</td>';
				if ($rights > 2) {
				echo '<td><a class="botton" href="update.php?id_dev=' . $row['id_device'] . '"><img  src="../img/pen_update.png" alt="insert"></a></td>';
				echo '<td><a class="botton" href="delete.php?id_device=' . $row['id_device'] . '"><img  src="../img/cross.png" alt="Error"></a></td>';
				}
				echo '</tr>';
			}
		}?>
		</tr>
		  </tbody>
		</table>
		</div>
	</div>	
	
</body>		  
	<?php include "../html/footer.html"; ?>

</html>