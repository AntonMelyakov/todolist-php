<?php
include_once('classes/connection.php');
include("methods/reusable_methods.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php/");
    die();
}

include('header.php');

?>

<body class="index">
    <div class="container">
        <div class="starter-template">
            <h1 class="text-center">Create tesk</h1>
            <form action="methods/edit.php" method="post" class="mx-auto mt-4">
                <div class="form-group mt-3">
                <label for="task_desc">Task</label>
                    <input class="form-control" type="text" id="task_desc" name="task_desc" value="">
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" id="taskdone" name="istaskdone" value="1">
                    <label class="form-check-label" for="taskdone">Task is done</label> </br>
                    <input class="form-check-input" type="radio" id="tasknotdone" name="istaskdone" value="0">
                    <label class="form-check-label" for="female">Task is not done</label>
                </div>
                <div class="form-group mt-3">
                    <label for="deadline">Deadline</label>
                    <input class="form-control" type="date" id="deadline" name="deadline" value=''>
                </div>
                <div class="d-flex justify-content-center flex-column mt-3">
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                    <a type="submit" href="list.php" class="btn btn-secondary mt-2">Back</a>
                </div>
            </form>
        </div>
    </div>
</body>

<?php
include('footer.php');
