<?php
include("reusable_methods.php");
session_start();

if(session_expired()){
    header("Location: /todophp/todolist-php");
    die();
 }

$task_id = $_POST['taskId'] ?? '';
$task_desc = $_POST['task_desc'] ?? '';
$task_done = $_POST['istaskdone'] ?? '';
$deadline = $_POST['deadline'] ?? '';

$result_query_scs = make_edit_task($task_id, $task_desc, $task_done, $deadline);

if($result_query_scs){
        header("Location: /todophp/todolist-php/list.php");
        die();
}





