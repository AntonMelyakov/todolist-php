<?php
include("../classes/connection.php");
include("../classes/task.php");
include("reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php");
    die();
}

$task =  Task::select_task($_POST['task_id']);
$current_user_id = $_SESSION['user']['id'];

if (!empty($task) && !empty($current_user_id)) {
    if ($task->username_id == $current_user_id) { //check if the user owns this task
        $deleted = $task->delete();

        if ($deleted) {
            $_SESSION['msg'] = "Removed!";
        } else {
            $_SESSION['msg'] = "Something went wrong :(";
        }
        header("Location: /todophp/todolist-php/list.php");
    }
}
