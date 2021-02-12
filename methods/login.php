<?php
include("../classes/connection.php");
include("../classes/task.php");
include("../classes/user.php");
include("reusable_methods.php");

$username = $_POST['login_username'];
$password = $_POST['login_password'];

if(!$username || !$password ){
    header("Location: /todophp/todolist-php");
    die();
}

$signin = User::check_user_and_pass($username,  $password);

if(!$signin){
    session_start();
     $_SESSION['msg'] = '<div class="alert alert-danger text-center" role="alert">
                            The user name or password is incorrect :(
                        </div>'; 
    header("Location: ../index.php");
}else{
    header("Location: ../list.php");
}

