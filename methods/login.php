<?php
include("reusable_methods.php");

$username = $_POST['login_username'];
$password = $_POST['login_password'];

if(!$username || !$password ){
    header("Location: /to-do-list");
    die();
}

//check_into_db('username', 'users', $username);

$user = check_user_and_pass($username,  $password);

if($user){ 
    session_start();
    $_SESSION["user"] = $user;
    $_SESSION["started"] = time();
    header("Location: /to-do-list/list.php");

};

?>