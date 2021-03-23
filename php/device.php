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
	
</head>
<body>
	<?php include "../html/header.html"; ?>
	
	<div class="container">
		<div class="admin-table">

		<?php 
		//подключение к БД
		require_once "../connection/connection.php";
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{

			
		
	echo'<h3>Устройства: </h3>
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
		
		
			$select_device = "SELECT * FROM device";
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
		  
	<?php include "../html/footer.html"; ?>
</body>
</html>