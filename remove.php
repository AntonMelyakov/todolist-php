<?php
include_once('classes/connection.php');
include("methods/reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php");
    die();
}

include('header.php');
?>
<body>
<div class="container">
    <div class="starter-template">
        <h1 class="text-center">REMOVE TASK</h1>
        <form action="methods/remove.php" method="post" class="mx-auto">
            <div class="form-group">
                <h4 class="text-center">Are you sure you want to delete this task?</h4>
                <input class="form-control" type="hidden" id="task_id" name="task_id" value='<?= $_GET["id"] ?>'>
            </div>
            <div class="d-flex justify-content-center">
                <a class="btn btn-secondary mr-2" href="list.php">No</a>
                <button class="btn btn-primary btn-danger" type="submit">Yes</button>
                <div>
        </form>
    </div>
</div>
</body>

<?php
include('footer.php');
