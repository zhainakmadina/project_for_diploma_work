<?php
$_SERVER["DOCUMENT_ROOT"].'/database/config.php';

$connect = mysqli_connect($host, $username, $password, $db_name);
if ($connect === false) {
  die("Ошибка: " . mysqli_connect_error());
}