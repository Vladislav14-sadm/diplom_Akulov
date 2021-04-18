<?php 
	if (!isset($_COOKIE['login'])) {
	header('Location:../index.php');}
	
	$rights_d = $_COOKIE['rights'];
	if ($rights_d < 2) {
	header('Location:application.php');}
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
	<title>Добавить новый отдел: </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<?php include "../html/header.php"; 
		//подключение к БД
		require_once "../connection/connection.php";?>
	
	<div class="container">
		<div class="new_department">
			<h3>Добавить новый отдел: </h3>
			
			<div class="mb-3">
			
			<form method="post" action="new_department.php">
				
				<label for="exampleFormControlInput1" class="form-label">Название отдела: </label>
			  <input type="text" name="name_depart" class="form-control" placeholder="Хирургия" required>
			</div>
			  <div class="mb-3">
			  <button type="submit" class="btn btn-primary mb-3">Добавить</button>
			  </form>
			</div>

		<?php 
		
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{
			
			$name_depart = trim($_POST['name_depart']);
			
			 if (empty($name_depart)){
		 }else{
			$select_prov = "select id_department from department where name = '$name_depart'";
			$result_prov = queryMysql($select_prov);
			$rows_prov = $result_prov->num_rows;
			
			if ($rows_prov > 0)
			{
				echo 'Такой отдел уже существует.';
			}else{
		
			$insert_new_depart="Insert into department (name) Values ('$name_depart')"; 	
			$result_new_depart = queryMysql($insert_new_depart);
			
			echo 'Отдел успешно добавлен.';
			}	
		  }
		}?>
		
		</div>
	</div>		
		  
	<?php include "../html/footer.html"; ?>
</body>
</html>