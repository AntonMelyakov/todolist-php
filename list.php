<?php
include_once('classes/connection.php');
include_once('classes/task.php');
include_once("methods/reusable_methods.php");
include_once("css/svgs.php");
session_start();

if (session_expired()) {
    header("Location: /todophp/todolist-php");
    die();
}

$all_tasks = Task::get_all_tasks($_SESSION['user']['id']);

include('header.php');
?>

<body>

<?php 
if(isset($_SESSION['msg']) && $_SESSION['msg'] != ''){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
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
                    //check icon if task is done
                    $task_done = $task->task_done ? $check_icon : "";
                    //empty value if deadline is not set
                    if(!strtotime($task->deadline) || (strtotime($task->deadline) < 0)){
                        $task_deadline = '';
                    }else{
                        $task_deadline =  date_format(date_create($task->deadline), "d-m-Y"); 
                    }
                    print("<tr> 
      <th scope='row'>" . $task->task . "</th>
      <th scope='row' class='text-center'>" . $task_done  . " </th>
      <th scope='row'>" . $task_deadline . "</th> 
      <th scope='row' class='text-center'> <a class='btn btn-primary' href='edit.php?id=" . $task->id . "'>edit</a></th>  
      <th scope='row' class='text-center'> <a class='btn btn-primary' href='remove.php?id=" . $task->id . "'>remove</a></th>      
     </tr>");
                } ?>
            </tbody>
        </table>
    </div>
</body>
<?php
include('footer.php');
