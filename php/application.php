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


			/*echo "Ваш логин: " . $_COOKIE["login"] . "<br>";
			echo "Ваш пароль: " . $_COOKIE["password"] . "<br>";
			echo "ФИО : " . $FIO . "<br>";
			echo "Отделение : " . $depart . "<br>";*/

		?>
		
		<h3>Здравствуйте, <?php echo $FIO ?> </h3>
		<h3>Отделение :  <?php echo $depart ?></h3>
		
		<div class="mb-3">
		
		  <form method="post" action="application.php">
			<label for="exampleFormControlInput1" class="form-label">Что у вас сломалось? Выберите из списка:</label>
			<select name="device" class="form-select" aria-label="Default select example">
			  
			  <?php 
			  
			  $select_type = "SELECT type FROM device";
			  $result= queryMysql($select_type);
			  $rows = $result->num_rows;
			  
			  
			  for ($i = 0 ; $i < $rows ; ++$i){
				  
				  $row = $result->fetch_assoc();
				  ?><option><?php echo $row['type']; ?></option>
				  <?php
				}
		      
			  ?>
			  </select><br>
			  
			  
			 <!--Выбор Производителя
			 <select name="manufacturer" class="form-select" aria-label="Default select example">
			  <option selected>Выберите производителя</option>
			  <?php /*
			  

				 $result= queryMysql($select_type);
	  			 $rows = $result->num_rows;
				 
			  for ($i = 0 ; $i < $rows ; ++$i){
				  
				  $row = $result->fetch_assoc();
				  ?><option><?php echo $row['name_device']; ?></option>
				  <?php
			  }
		      
			 */ ?>
			  </select>-->
			  
			  
			  <br>
			

			  <label for="exampleFormControlTextarea1" class="form-label">Комментарий (максимально 500 символов)</label>
			  <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Напишите в каком кабинете и вкратце опишите ситуацию"></textarea>
			  <button type="submit" name="button" class="btn btn-primary mb-3">Отправить</button>
			</form>
			
			<?php 
			
			if(isset ($_POST['device'])){
			
			//$manufacturer = $_POST['manufacturer'];
			
			$device = $_POST['device'];
			
			$select_id_device = "select id_device from device where type = '$device'";
			$result_id_device = queryMysql($select_id_device);
			$row = $result_id_device->fetch_assoc();
			$id_device = $row['id_device'];	
			
			$select_id_employee = "select id_employee from employee where FIO = '$FIO'";
			$result_id_employee = queryMysql($select_id_employee);
			$row = $result_id_employee->fetch_assoc();
			$id_employee = $row['id_employee'];	
			
			$comment = $_POST['comment'];
			$date = date("Y.m.d");;
			
			
			//echo $id_device, $manufacturer, $comment, $FIO, $depart, $date;
			//echo $id_employee;
			
			$query_applic="Insert into applications (date_applic, status, comment, id_device) Values ('$date', 'Входящий', '$comment', $id_device)"; 
			$result_applic = queryMysql($query_applic);
			
			$select_id_applications = "select id_applications from applications where comment = '$comment' AND date_applic = '$date'";
			$result_id_applications = queryMysql($select_id_applications);
			$row = $result_id_applications->fetch_assoc();
			$id_applications = $row['id_applications'];
			
			
			$query_empl_applic="Insert into empl_applic (id_employee, id_applications) Values ( $id_employee, $id_applications)"; 
			$result_empl_applic = queryMysql($query_empl_applic);
			
			
			?>
			<script>alert( "Ваша заявка была успешно отправлена. Можете закрывать эту страницу!" );</script>
			
			<?php
			}
			
			?>
			

		  </div>
		</div>
	</div>

	<?php include "../html/footer.html"; ?>
</body>
</html>

<?php } ?>