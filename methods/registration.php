<?php
include("reusable_methods.php");

$username = $_POST['reg_username'];
$mail = $_POST['reg_mail'];
$pass = $_POST['reg_password'];

//check if values are empty
if(empty($username) || empty($mail) || empty($pass)) {
    header("Location: /todophp/todolist-php");
    die();
}

//check if username or email are already used
$email_used = fetch_from_db('email', 'users', $mail);
$username_used = fetch_from_db('username', 'users', $username);

//if username or email are already used, redirect to index
if(!empty($email_used) || !empty($username_used) ){
    header("Location: /todophp/todolist-php");
    die();
}else{ //else insert into DB
    create_new_user($username, $mail, $pass);
}

