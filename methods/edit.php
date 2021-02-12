<?php
include("../classes/connection.php");
include("../classes/task.php");
include("reusable_methods.php");
session_start();

if (session_expired()) {
        header("Location: /todophp/todolist-php");
        die();
}

if (isset($_POST['taskId'])) {
        $task = Task::select_task($_POST['taskId']);
        $task->task = $_POST['task_desc'] ?? '';
        $task->task_done = $_POST['istaskdone'] ?? '';
        $task->deadline = $_POST['deadline'] ?? '';
}else{
        $task = new Task(null, $_POST['task_desc'], $_SESSION['user']['id'], $_POST['istaskdone'], $_POST['deadline']);
}

$saved = $task->save();

if($saved){
        $_SESSION['msg'] = '<div class="alert alert-success text-center" role="alert">
                                Done!
                            </div>';
}else{
        $_SESSION['msg'] = '<div class="alert alert-danger text-center" role="alert">
                                Something went wrong :(
                            </div>';    
}

header("Location: ../list.php");
