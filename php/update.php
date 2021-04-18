<?php 
	if (!isset($_COOKIE['login'])) {
	header('Location:../index.php');}
	
	$rights_d = $_COOKIE['rights'];
	if ($rights_d < 3) {
	header('Location:application.php');}
?>
<!DOCTYPE html>
<html lang='ru'>

<head>
	<title>Изменить</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/style.css">
	
</head>
<body>
	<?php include "../html/header.php"; 
		//подключение к БД
		require_once "../connection/connection.php";
	
		$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
		else{
			
			//изменение в пользователях
			$id_emp = $_GET['id_emp'];
			
			if (isset ($id_emp)){
	
			$select_empl = "SELECT id_employee, FIO, login, password, rights, department.name FROM employee INNER JOIN department ON employee.id_department = department.id_department where id_employee = '$id_emp'";
			$result_empl = queryMysql($select_empl);
			$row_empl = $result_empl->fetch_assoc();
			
			$right = $row_empl['rights'];
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

echo '<div class="container">
		<div class="new_user">
			<h3>Изменить данные пользователя</h3>
			
			<div class="mb-3">
			
			<form method="post">
				<p name="id_em" value="'. $emp .'" >
				<label for="exampleFormControlInput1" class="form-label">ФИО: </label>
				
			  <input type="text" name="FIO" class="form-control" value="'. $row_empl['FIO'] .'" placeholder="Иванов Петр Васильевич" required>
			
			  <label for="exampleFormControlInput1" class="form-label">Логин: </label>
			  <input type="text" name="login" class="form-control" value="'. $row_empl['login'] .'" placeholder="ivanov" required>		
			 
			  <label for="exampleFormControlInput1" class="form-label">Пароль: </label>
			  <input type="text" name="passw" class="form-control" value="'. $row_empl['password'] .'" placeholder="petr1602" required>

			  <label for="exampleFormControlInput1" class="form-label">Права доступа: (сейчас: '. $right .')</label>
			<select name="right" class="form-select" aria-label="Default select example">
				<option>Пользователь</option>
				<option>Администратор</option>
				<option>Помощник администратора</option>
			  </select>
			  
			  <label for="exampleFormControlInput1" class="form-label">Отдел: (сейчас: '. $row_empl['name'] . ')</label>
						  
			  	<select name="department" class="form-select" aria-label="Default select example">' .
			  
			  $select_depart = "SELECT name FROM department";
			  $result_depart= queryMysql($select_depart);
			  $rows = $result_depart->num_rows;

			  for ($i = 0 ; $i < $rows ; ++$i){
				  
				  $row = $result_depart->fetch_assoc();
				 echo '<option>'.  $row['name'] . '</option>';
				 } 
				 
				echo '</select>
				</div>
			  <div class="mb-3">
			  <button type="submit" name="button" class="btn btn-primary mb-3">Изменить</button>
			  </form>
			</div>';

			if(isset($_POST['button'])) {
		
			$id_em = $_POST['id_em'];
			$FIO = trim($_POST['FIO']);
			$login = trim($_POST['login']);
			$passw = trim($_POST['passw']);
			$right = $_POST['right'];
			
			
			 if (empty($FIO) && empty($login) && empty($passw) && empty($right) && empty($emp)){
            
		 }else{
			
			switch ($right) {
			case "Пользователь":
				$right = 1;;
				break;
			case "Администратор":
				$right = 3;;
				break;
			case "Помощник администратора":
				$right = 2;
				break;
			}
			
			$department = $_POST['department'];
			$select_depart = "select id_department from department where name = '$department'";
			$result_depart = queryMysql($select_depart);
			$row = $result_depart->fetch_assoc();
			$id_depart = $row['id_department'];
			
			
			//echo $id_em, $id_emp, $FIO, $login, $passw, $right, $id_depart;
			$insert_up_user="UPDATE employee SET FIO = '$FIO', login = '$login', password = '$passw', rights = $right, id_department = $id_depart where id_employee = $id_emp"; 	
			$result_up_user = queryMysql($insert_up_user);
			 echo 'Изменения вступили в силу';
		  }
		}
		  
		  }
			
		 //Изменения в отделах
		 $id_dep = $_GET['id_dep'];
		 
		 if (isset ($id_dep)){
		 
		 $select_dep = "SELECT * FROM department where id_department = $id_dep";
		 $result_dep = queryMysql($select_dep);
		 $row_dep = $result_dep->fetch_assoc();
			
			

echo '<div class="container">
		<div class="new_department">
			<h3>Изменить отдел</h3>
			
			<div class="mb-3">
			
			<form method="post">
			
			  <label for="exampleFormControlInput1" class="form-label">Название отдела: </label>
			  <input type="text" name="dep_name" class="form-control" value="'. $row_dep['name'] .'" required>
				</div>
				
			  <div class="mb-3">
			  <button type="submit" name="button" class="btn btn-primary mb-3">Изменить</button>
			  </form>
			</div>';

			if(isset($_POST['button'])) {
		
			$dep_name = $_POST['dep_name'];
			
			 if (empty($dep_name)){
            
		 }else{
			
			$insert_up_depart="UPDATE department SET name = '$dep_name' where id_department = $id_dep"; 	
			$result_up_depart = queryMysql($insert_up_depart);
			echo 'Изменения вступили в силу';
		  }
		 }
		}
		 
		 
		 //изменение устройства
		 $id_dev = $_GET['id_dev'];
		 if (isset ($id_dev)){
		 
		 $select_dev = "SELECT * FROM device where id_device = $id_dev";
		 $result_dev = queryMysql($select_dev);
		 $row_dev = $result_dev->fetch_assoc();
			
			

echo '<div class="container">
		<div class="new_department">
			<h3>Изменить устройство</h3>
			
			<div class="mb-3">
			
			<form method="post">
			
			  <label for="exampleFormControlInput1" class="form-label">Название устройства: </label>
			  <input type="text" name="dev_name" class="form-control" value="'. $row_dev['name_device'] .'" required>
			
			</div>
				
			<div class="mb-3">
			  <button type="submit" name="button" class="btn btn-primary mb-3">Изменить</button>
			  </form>
			</div>';

			if(isset($_POST['button'])) {
		
			$dev_name = $_POST['dev_name'];
			
			 if (empty($dev_name)){    
		 }else{
		
			$insert_up_depart="UPDATE device SET name_device = '$dev_name' where id_device = $id_dev"; 	
			$result_up_depart = queryMysql($insert_up_depart);
			echo 'Изменения вступили в силу';
		  }
		 }
		 
		}
		
		//изменение заявок
		$id_app = $_GET['id_app'];
		 if (isset ($id_app)){
		 
		 $select_app = "SELECT device.type, applications.status, applications.comment FROM device INNER JOIN (applications INNER JOIN (empl_applic Inner JOIN (employee INNER JOIN department ON employee.id_department = department.id_department) ON empl_applic.id_employee = employee.id_employee) ON empl_applic.id_applications = applications.id_applications) ON device.id_device = applications.id_device where applications.id_applications = $id_app";
		 $result_app = queryMysql($select_app);
		 $row_app = $result_app->fetch_assoc();
			
			

echo '<div class="container">
		<div class="new_device">
			<h3>Изменить заявку</h3>
			
			
			
			<form method="post">
			
			<!-- <div class="mb-3">		  
			  <label for="exampleFormControlInput1" class="form-label">Статус: </label>
			  <input type="text" name="app_status" class="form-control" value="'. $row_app['status'] .'" required>
			</div>-->
			<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Выбрать статус: (сейчас: '. $row_app['status'] .')</label>
			<select name="app_status" class="form-select" aria-label="Default select example">
				<option>Входящий</option>
				<option>В работе</option>
				<option>Выполнен</option>
				<option>Отклонен</option>
			  </select>
			</div>
			
			<div class="mb-3">			
			  <label for="exampleFormControlInput1" class="form-label">Комментарий: </label>
			  <input type="text" name="comm" class="form-control" rows="3" value="'. $row_app['comment'] .'" placeholder="Напишите в каком кабинете и вкратце опишите ситуацию"  required">
			
			</div>
				
			<div class="mb-3">
			  <button type="submit" name="button" class="btn btn-primary mb-3">Изменить</button>
			  </form>
			</div>';

			if(isset($_POST['button'])) {
		
			$app_status = $_POST['app_status'];
			$comm = $_POST['comm'];
			
			 if (empty($app_status) && empty($comm)){  
		 }else{
		
	
			$insert_up_app="UPDATE applications SET status = '$app_status', comment = '$comm' where id_applications = $id_app"; 
			
			$result_up_app = queryMysql($insert_up_app);
			echo 'Изменения вступили в силу';
		  }
		 }
		}
		 
		 }
		 ?>
		
		</div>
	</div>		
		  
	<?php include "../html/footer.html"; ?>
</body>
</html>