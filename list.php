<?php
include("methods/reusable_methods.php");
include("css/svgs.php");
session_start();

if (session_expired()) {
    header("Location: /to-do-list");
    die();
}

$all_tasks = fetch_from_db("username_id", 'tasks', $_SESSION["user"]["id"]);

include('header.php');
?>

<div class="container">
    <h1 class="text-center">To Do List</h1>
    <div>
        <a href="create.php" class="btn btn-primary m-2">Create new task</a>
    </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <th scope="col">TASK</th>
            <th scope="col">DONE</th>
            <th scope="col">DEADLINE</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </thead>
        <tbody>
            <?php
            foreach ($all_tasks as $task) {
                $task_done = $task['task_done'] ? $check_icon : "";
                print("<tr> 
      <th scope='row'>" . $task['task'] . "</th>
      <th scope='row' class='text-center'>" . $task_done  . " </th>
      <th scope='row'>" . $task['deadline'] . "</th> 
      <th scope='row' class='text-center'> <a class='btn btn-primary' href='edit.php?id=" . $task['id'] . "'>edit</a></th>  
      <th scope='row' class='text-center'> <a class='btn btn-primary' href='remove.php?id=" . $task['id'] . "'>remove</a></th>      
     </tr>");
            } ?>
        </tbody>
    </table>
</div>

<?php
include('footer.php');
