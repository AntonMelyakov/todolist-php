<?php
include_once('classes/connection.php');
include_once('classes/task.php');
include_once("methods/reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php/");
    die();
}


if (isset($_GET["id"])) {
    $task = Task::select_task($_GET["id"]);
}

include('header.php');

?>

<body class="index">
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center">Edit task</h1>
            <form action="methods/edit.php" method="post" class="mx-auto mt-4">
                <div class="form-group mt-3">
                    <label for="task_desc">Task</label>
                    <input class="form-control" type="text" id="task_desc" name="task_desc" value="<?= $task->task?>">
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input"  <?php if($task->task_done){ echo "checked";} ?> type="radio" id="taskdone" name="istaskdone" value="1">
                    <label class="form-check-label" for="taskdone">Task is done</label> </br>
                    <input class="form-check-input" <?php if(!$task->task_done){ echo "checked";} ?> type="radio" id="tasknotdone" name="istaskdone" value="0">
                    <label class="form-check-label" for="tasknotdone">Task is not done</label>
                </div>
                <div class="form-group mt-3">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" id="deadline" name="deadline" value='<?=date_format(date_create($task->deadline),"Y-m-d") ?>'>
                    <input class="form-control" type="hidden" id="taskId" name="taskId" value=' <?= $task->id ?> '>
                </div>
                <div class="d-flex justify-content-center flex-column mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <a type="submit" href="list.php" class="btn btn-secondary mt-2">Back</a>
                </div>               
            </form>
        </div>
    </div>
</body>

<?php
include('footer.php');
