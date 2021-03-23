<?php
$dbhost = 'localhost'; // Эта строка вряд ли нуждается в изменении
$dbname = 'application'; // А значения этих переменных
$dbuser = 'root'; // поменяйте на те, что соответствуют
$dbpass = 'root'; // вашим настройкам

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);

function queryMysql($query)
{
global $connection;
$result = $connection->query($query);
if (!$result) die($connection->error);
return $result;}
?>