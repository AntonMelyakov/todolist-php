<?php

class Task
{
    public $id;
    public $task;
    public $username_id;
    public $task_done;
    public $deadline;

    public function __construct($id, $task, $username_id, $task_done, $deadline)
    {
        $this->id = $id;
        $this->task = $task;
        $this->username_id = $username_id;
        $this->task_done = $task_done;
        $this->deadline = $deadline;
    }

    public static function select_task($id)
    {
        $conn = Connection::getConnection();

        if ($conn) {
            $sql = "SELECT * FROM tasks WHERE id = '$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
            }
            $conn->close();

            $selected_task = new Self($row['id'], $row['task'], $row['username_id'], $row['task_done'], $row['deadline']);
            return $selected_task;
        }
    }

    public static function get_all_tasks($user_id)
    {
        $all_tasks = [];

        $conn = Connection::getConnection();
        if ($conn) {
            $sql = "SELECT * FROM tasks WHERE username_id = '$user_id'";
            $result = $conn->query($sql);
            

            $rows = [];
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($rows, $row);
                }
            }
            $conn->close();

            foreach ($rows as $row) {
                $task_obj = self::select_task($row['id']);
                $all_tasks[] = $task_obj;
            }

            return $all_tasks;
        }
    }

    public function save()
    {
        $conn = Connection::getConnection();

        if ($conn) {
            if ($this->id) { //update
                $sql = "UPDATE tasks SET task='$this->task', task_done='$this->task_done', deadline='$this->deadline' WHERE id='$this->id'";
            } else { //create
                $sql = "INSERT INTO tasks (`id`, `username_id`, `task`, `task_done`, `deadline`) VALUES (NULL, '$this->username_id', '$this->task', '$this->task_done', '$this->deadline');";
            }

            $result_return = false;

            if ($conn->multi_query($sql) === TRUE) {
                $result_return = true; //no errors
            }
            $conn->close();
            return $result_return;
        }
    }

    public function delete()
    {
        $conn =  Connection::getConnection();
        if ($conn) {
            $sql = "DELETE FROM tasks WHERE id='$this->id'";
            if ($conn->query($sql) === TRUE) {
                $deleted = true;
            } else {
                echo "Error deleting record: " . $conn->error;
                $deleted = false;
            }
            $conn->close();
            return $deleted;
        }
    }
}
