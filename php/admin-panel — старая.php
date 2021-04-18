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
			
			
			//$row = $result_id_device->fetch_assoc();
			
			/*for ($i = 0 ; $i < $rows ; ++$i){
			$row = $result_id_device->fetch_assoc();
			echo $row['id_applications'];
			echo $row['FIO'];
			echo $row['name'];
			echo $row['comment'];
			}*/
			
		
 echo	'<h3>Заявки: </h3>
		
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
			  
			  if ($rights > 2) {
			  echo '<th scope="col"></th>
			  <th scope="col"></th>';
			  }
			  
		echo'</tr>
		  </thead>
			<tbody>
			<tr>';
		
		
			$select_id_device = "SELECT applications.id_applications, employee.FIO, department.name, device.type, applications.date_applic , applications.status, applications.comment FROM device INNER JOIN (applications INNER JOIN (empl_applic Inner JOIN (employee INNER JOIN department ON employee.id_department = department.id_department) ON empl_applic.id_employee = employee.id_employee) ON empl_applic.id_applications = applications.id_applications) ON device.id_device = applications.id_device";
			$result_id_device = queryMysql($select_id_device);
			$rows = $result_id_device->num_rows;
				 
				for ($i = 0 ; $i < $rows ; ++$i){
				$row = $result_id_device->fetch_assoc();
				echo '<tr>';
				//echo '<th>'. $row['id_applications'] . '</th>';
				echo '<td>'. $row['FIO'] . '</td>';
				echo '<td>'. $row['name'] . '</td>';
				echo '<td>'. $row['type'] . '</td>';
				echo '<td>'. $row['date_applic'] . '</td>';
				echo '<td class="tdcomm">'. $row['comment'] . '</td>';
				echo '<th>'. $row['status'] . '</th>';
				
				/*выбор заявки выпадающий список
				echo '<th> 
				<select name="right" class="form-select" aria-label="Default select example" onchange=" if (this.value) window.location.href = this.value">
					<option value="device.php">Входящий</option>
					<option value="department.php">В работе</option>
					<option>Выполнен</option>
					<option>Отклонен</option>
				</select> </th>';*/
				
				
				if ($rights > 2) {
				echo '<td><a class="botton" href="update.php?id_app=' . $row['id_applications'] . '"><img  src="../img/pen_update.png" alt="insert"></a></td>';
				echo '<td><a class="botton" href="delete.php?id_appl=' . $row['id_applications'] . '"><img  src="../img/cross.png" alt="Error"></a></td>';
				}
				echo '</tr>';
			}
				
				
				
				/*for ($i = 0 ; $i > $rows ; ++$i){
				//echo '<tr>';
				
				$row = $result_id_device->fetch_assoc();
				
				echo $row['id_applications'];
				echo $row['FIO'];
				echo $row['name'];
				echo $row['name_device'];
				echo $row['comment'];
				echo $row['status'];
				
				//echo '</tr>';
				} */
			 }?>
		</tr>
		  </tbody>
		</table>
		</div>
	</div>		
		  
			  <!--<th scope="row">1</th>
			  <td>Кладовщикаова Дарина Алексеевна</td>
			  <td>Хирургия</td>
			  <td>Принтер</td>
			  <td>аывпвыпуууууууууууууууууууууууу</td>
			  <td>В работе</td>-->
			

	<?php include "../html/footer.html"; ?>
</body>
</html>