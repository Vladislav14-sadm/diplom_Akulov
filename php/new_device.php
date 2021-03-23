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
	<title>Заявки</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<?php include "../html/header.html"; 
		//подключение к БД
		require_once "../connection/connection.php";?>
	
	<div class="container">
		<div class="new_device">
			<h3>Добавить устройство: </h3>
			
			<div class="mb-3">
			
			<form method="post" action="new_device.php">
				
				<label for="exampleFormControlInput1" class="form-label">Название устройства: </label>
			  <input type="text" name="type" class="form-control" placeholder="Принтер" required>
			</div>
			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Модель: </label>
			  <input type="text" name="name" class="form-control" placeholder="Canon" required>		
			 
			  </div>
			  <div class="mb-3">
			  <button type="submit" class="btn btn-primary mb-3">Добавить</button>
			  </form>
			</div>

		<?php 
		
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{
			
			$type = trim($_POST['type']);
			$name = trim($_POST['name']);
			
			 if (empty($type) && empty($name)){
		 }else{
			$select_prov = "select id_device from device where type = '$type' and name_device = '$name'";
			$result_prov = queryMysql($select_prov);
			$rows_prov = $result_prov->num_rows;
			
			if ($rows_prov > 0)
			{
				echo 'Такое устройство с этой моделью уже существует';
			}else{
		
			$insert_new_device="Insert into device (name_device, type) Values ('$name', '$type')"; 	
			$result_new_device = queryMysql($insert_new_device);
			
			echo 'Устройство успешно добавлено';
			}	
		  }
		}?>
		
		</div>
	</div>		
		  
	<?php include "../html/footer.html"; ?>
</body>
</html>