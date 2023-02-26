<?php
require $_SERVER["DOCUMENT_ROOT"].'/database/action.php';

$email = $_POST['email'];
$password = $_POST['password'];

echo Action::auth($email, $password);