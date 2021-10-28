<?php
require_once "function.php";

$email = $_POST['email'];
$password = $_POST['password'];

$user = login($email, $password);


if (!$user) {

    redirect_to("page_login.php");

}
redirect_to("users.php");