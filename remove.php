<?php
include("methods/reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /to-do-list");
    die();
}


if (isset($_GET["id"])) {
    $task_id = $_GET["id"];
}

include('header.php');
?>

<div class="container">
    <div class="starter-template">
        <h1 class="text-center">REMOVE TASK</h1>
        <form action="methods/remove.php" method="post" class="mx-auto">
            <div class="form-group">
                <h4 class="text-center">Are you sure you want to delete this task?</h4>
                <input class="form-control" type="hidden" id="task_id" name="task_id" value='<?= $task_id ?>'>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary" type="submit">Yes</button>
                <div>
        </form>
    </div>
</div>

<?php
include('footer.php');
