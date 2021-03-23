<?php 
if (!isset($_COOKIE['login'])) {
	header('Location:../index.php');}
	
	$rights = $_COOKIE['rights'];
	
	if ($rights < 3) {
	header('Location:application.php');}
	
require_once "../connection/connection.php";
		
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($conn->connect_error) die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
	else{
		
	$id_appl = $_GET['id_appl'];
	$id_device = $_GET['id_device'];
	$id_depart = $_GET['id_depart'];
	$id_empl = $_GET['id_empl'];
		
		if(isset($id_appl)){
	$select_delete = "Delete from empl_applic where id_applications = '$id_appl'";
	$select_delete_appl = "Delete from applications where id_applications = '$id_appl'";
	
	$result = queryMysql($select_delete);
	$result = queryMysql($select_delete_appl);
	
	header('Location: admin-panel.php');
		}
		
		if(isset($id_device)){
	$select_delete_device = "Delete from device where id_device = '$id_device'";
	$result = queryMysql($select_delete_device);
	header('Location: device.php');
		}
		
		if(isset($id_depart)){
	$select_delete_depart = "Delete from department where id_department = '$id_depart'";
	$result = queryMysql($select_delete_depart);
	header('Location: department.php');
		}
		
		if(isset($id_empl)){
	$select_delete_empl = "Delete from employee where id_employee = '$id_empl'";
	$result = queryMysql($select_delete_empl);
	header('Location: users.php');
		}
	}
?>