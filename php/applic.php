<?php
	if (!isset($_COOKIE['login'])) {
	header('Location: ../index.php');}
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<?php include "../html/header-application.html"; ?>
	
	<div class="container">
		<div class="menu">

		<?php 
		//подключение к БД
		require_once "../connection/connection.php";
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{

			$FIO = $_COOKIE["FIO"];
			$depart = $_COOKIE["depart"];
		
		
		echo'<h3>Здравствуйте, ' .  $FIO  . '</h3>		
		<h3>Отделение : ' .  $depart . '</h3>
		<p><a href="application.php" class="btn btn-outline-primary">Новая заявка</a></p>';
		
		
		$select_id_device = "SELECT applications.id_applications, employee.FIO, department.name, device.type, applications.date_applic , applications.status, applications.comment FROM device INNER JOIN (applications INNER JOIN (empl_applic Inner JOIN (employee INNER JOIN department ON employee.id_department = department.id_department) ON empl_applic.id_employee = employee.id_employee) ON empl_applic.id_applications = applications.id_applications) ON device.id_device = applications.id_device 
								 where FIO = '$FIO' ORDER BY date_applic DESC";	
		$result_id_device = queryMysql($select_id_device);
		$rows = $result_id_device->num_rows;
		
		if ($rows < 1){
			echo '<h3> Заявок нет </h3>';
		}else {
		
		echo '<br><h3>Вот ваши заявки: </h3>
	
		
		
		<table class="table table-hover">
		  <thead>
			<tr>
			  <!--<th scope="col">ID</th>-->
			  <th scope="col">ФИО</th>
			  <th scope="col">Отделение</th>
			  <th scope="col">Устройство</th>
			  <th scope="col">Дата</th>
			  <th scope="col">Комментарий</th>
			  <th scope="col">Статус</th>';

			  
		echo'</tr>
		  </thead>
			<tbody id="myTable">
			<tr>';
			
			
			
		
			
		   
				 
				for ($i = 0 ; $i < $rows ; ++$i){
				$row = $result_id_device->fetch_assoc();
				echo '<tr>';
				
				echo '<td>'. $row['FIO'] . '</td>';
				echo '<td>'. $row['name'] . '</td>';
				echo '<td>'. $row['type'] . '</td>';
				echo '<td>'. $row['date_applic'] . '</td>';
				echo '<td class="tdcomm">'. $row['comment'] . '</td>';
				echo '<th>'. $row['status'] . '</th>';
				echo '</tr>';
			}
				
				
				
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