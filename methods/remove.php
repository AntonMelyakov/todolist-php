<?php
include("reusable_methods.php");
session_start();

if(session_expired()){
    header("Location: /to-do-list");
    die();
 }

$task_id = $_POST['task_id'];


$current_task =  fetch_from_db('id', 'tasks', $task_id);
$current_task = $current_task[0];

$current_user_id = $_SESSION['user']['id'];

if (!empty($current_task) && !empty($current_user_id)) { 
    if ($current_task['username_id'] == $current_user_id) { //check if the user owns this task
        delete_task($task_id);
        header("Location: /to-do-list/list.php");
    }
}


