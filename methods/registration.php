<?php
include("../classes/connection.php");
include("../classes/task.php");
include("../classes/user.php");
include("reusable_methods.php");

$username = $_POST['reg_username'];
$mail = $_POST['reg_mail'];
$pass = $_POST['reg_password'];



//check if values are empty
if(empty($username) || empty($mail) || empty($pass)) {
    header("Location: /todophp/todolist-php");
    die();
}

//hash
$pass = password_hash($pass, PASSWORD_DEFAULT);

//check if username or email are already used
if(User::verify_user_not_exist($username, $email)){
    User::create($username, $email, $pass);
    header("Location: /todophp/todolist-php");
}

