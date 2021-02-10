<?php
include("methods/reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php/");
    die();
}


if (isset($_GET["id"])) {
    $task = fetch_from_db("id", "tasks", $_GET["id"]);
}

$task_id = $_GET["id"] ?? '';
$task_description = $task[0]["task"] ?? '';
$task_done = $task[0]["task_done"] ?? 0;
$task_deadline = $task[0]["deadline"] ?? NULL;

include('header.php');

?>

<body class="index">
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center">EDIT TASK</h1>
            <form action="methods/edit.php" method="post" class="mx-auto">
                <div class="form-group">
                    <input class="form-control" type="text" id="task_desc" name="task_desc" value="<?= $task_description?>">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="taskdone" name="istaskdone" value="1">
                    <label class="form-check-label" for="taskdone">Task is done</label> </br>
                    <input class="form-check-input" type="radio" id="tasknotdone" name="istaskdone" value="0">
                    <label class="form-check-label" for="female">Task is not done</label>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" id="deadline" name="deadline" value=' <?= $task_deadline ?> '>
                    <input class="form-control" type="hidden" id="taskId" name="taskId" value=' <?= $task_id ?> '>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>               
            </form>
        </div>
    </div>
</body>

<?php
include('footer.php');
