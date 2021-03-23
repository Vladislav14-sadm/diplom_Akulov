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
	<title>Отделы</title>
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

			
		
	echo'<h3>Отделы: </h3>
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">Название отдела</th>';
			  if ($rights > 2) {
			  echo '<th scope="col"></th>
			  <th scope="col"></th>';
			  }
		echo '</tr>
		  </thead>
			<tbody>
			<tr>';
		
		
			$select_depart = "SELECT * FROM department";
			$result_depart = queryMysql($select_depart);
			$rows = $result_depart->num_rows;
				 
				for ($i = 0 ; $i < $rows ; ++$i){
				$row = $result_depart->fetch_assoc();
				echo '<tr>';
				echo '<td>'. $row['name'] . '</td>';
				
				if ($rights > 2) {
				echo '<td><a class="botton" href="update.php?id_dep=' . $row['id_department'] . '"><img  src="../img/pen_update.png" alt="insert"></a></td>';
				echo '<td><a class="botton" href="delete.php?id_depart=' . $row['id_department'] . '"><img  src="../img/cross.png" alt="delete"></a></td>';
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