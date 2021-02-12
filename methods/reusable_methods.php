<?php

function make_connection()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todo_list";

    // Create connection ( now part of connection class)
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function fetch_from_db($column, $db_table, $searched_value)
{
    $conn = Connection::getConnection();

    if ($conn) {
        $sql = "SELECT * FROM $db_table WHERE $column = '$searched_value'";
        $result = $conn->query($sql);

        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($rows, $row);
            }
        }
        $conn->close();

        return $rows;
    }
}

// ( now part of user class)
function check_user_and_pass($username,  $password)
{
    $conn = Connection::getConnection();

    if ($conn) {
        $sql = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";
        $result = $conn->query($sql);

        $row = [];
        if ($result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
        }
        $conn->close();
        return $row;
    }
}

//if session is expired
function session_expired()
{
    if ((time() - $_SESSION['started']) > (60 * 30)) {
        return true;
    };
    return false;
}

//CRUD

//make and update task ( now part of task class)
function make_edit_task($task_id = null, $task_desc, $task_done, $deadline)
{
    $conn = Connection::getConnection();
    if ($conn) {
        if ($task_id) { //update
            $sql = "UPDATE tasks SET task='$task_desc', task_done='$task_done', deadline='$deadline' WHERE id='$task_id'";
        } else { //create
            $userid = $_SESSION['user']['id'];
            $sql = "INSERT INTO tasks (`id`, `username_id`, `task`, `task_done`, `deadline`) VALUES (NULL, '$userid', '$task_desc', '$task_done', '$deadline');";
        }

        $result_return = false;
        if ($conn->multi_query($sql) === TRUE) {
            $result_return = true; //no errors
        }
        $conn->close();
        return $result_return;
    }
}

//delete task  ( now part of task class)
function delete_task($task_id)
{
    $conn =  Connection::getConnection();
    if ($conn) {
        $sql = "DELETE FROM tasks WHERE id='$task_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
    }
}

//create new user  ( now part of user class)
function create_new_user($username, $email, $pass)
{
    $conn = make_connection();

    if ($conn) {
        $sql = "INSERT INTO users (`id`, `username`, `email`, `pass`, `reg_date`) VALUES (NULL, '$username', '$email', '$pass', current_timestamp());";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
