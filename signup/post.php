<?php
require $_SERVER["DOCUMENT_ROOT"].'/database/action.php';

$name = $_POST['name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];

echo Action::signup($name, $login, $email, $password, $conf_password);