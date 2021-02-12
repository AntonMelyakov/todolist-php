<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_list";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
email VARCHAR(30) NOT NULL,
pass VARCHAR(100),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table users created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

// sql to create table
$sql = "CREATE TABLE tasks (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username_id INT(6) NOT NULL,
    task VARCHAR(150) NOT NULL,
    task_done BOOLEAN DEFAULT 0,
    deadline TIMESTAMP NULL DEFAULT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
      echo "Table tasks created successfully";
    } else {
      echo "Error creating table: " . $conn->error;
    }

    //test task for the firs user
$sql = "INSERT INTO tasks (username_id, task)
VALUES ('1', 'test_task')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>