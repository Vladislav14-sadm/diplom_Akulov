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
	<title>Пользователи</title>
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
			

			
		
	echo '<h3>Пользователи: </h3>
		
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">ФИО</th>
			  <th scope="col">Логин</th>
			  <th scope="col">Пароль</th>
			  <th scope="col">Отделение</th>
			  <th scope="col">Права</th>';
			  if ($rights > 2) {
			  echo '<th scope="col"></th>
			  <th scope="col"></th>';}
			echo '</tr>
		  </thead>
			<tbody>
			<tr>';
		
			$select_empl = "SELECT id_employee, FIO, login, password, rights, department.name FROM employee INNER JOIN department ON employee.id_department = department.id_department";
			$result_empl = queryMysql($select_empl);
			$rows = $result_empl->num_rows;
				 
				for ($i = 0 ; $i < $rows ; ++$i){
				$row = $result_empl->fetch_assoc();
				
				$right = $row['rights'];
				
				switch ($right) {
					case 1:
						$right = "Пользователь";;
						break;
					case 3:
						$right = "Администратор";;
						break;
					case 2:
						$right = "Помощник администратора";
						break;
					}
				
				
				echo '<tr>';
				echo '<td>'. $row['FIO'] . '</td>';
				echo '<td>'. $row['login'] . '</td>';
				echo '<td>'. $row['password'] . '</td>';
				echo '<td>'. $row['name'] . '</td>';
				echo '<td>'. $right . '</td>';
				if ($rights > 2) {
				echo '<td><a class="botton" href="update.php?id_emp=' . $row['id_employee'] . '"><img  src="../img/pen_update.png" alt="delete"></a></td>';
				echo '<td><a class="botton" href="delete.php?id_empl=' . $row['id_employee'] . '"><img  src="../img/cross.png" alt="delete"></a></td>';
				}
				echo '</tr>';
			}
				

			 }?>
		</tr>
		  </tbody>
		</table>
		</div>
	</div>		
		  

	<?php include "../html/footer.html"; 
echo '</body>
</html>';
?>