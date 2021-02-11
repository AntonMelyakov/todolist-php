<?php

class User
{
    public $id;
    public $username;
    public $email;
    public $pass;
    public $reg_date;

    public function __construct($id, $username, $email, $pass, $reg_date)
    {
        $this->id = $id;
        $this->task = $username;
        $this->username_id = $email;
        $this->task_done = $pass;
        $this->deadline = $reg_date;
    }

    public static function create($username, $email, $pass)
    {
        $conn =  Connection::getConnection();
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

    public static function verify_user_not_exist($username, $email)
    {
        $conn = Connection::getConnection();

        if ($conn) {
            $sql = "SELECT * FROM users WHERE email = '$email' OR username = $username";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $not_exist = false;
            } else {
                $not_exist = true;
            }
            $conn->close();
            return $not_exist;
        }
    }

    public static function check_user_and_pass($username,  $password)
    {
        $conn = Connection::getConnection();

        if ($conn) {
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $user = mysqli_fetch_assoc($result);
                if(password_verify($password, $user['pass'])){
                    session_start();
                    $_SESSION["user"]['id'] = $user['id'];
                    $_SESSION["started"] = time();
                    $conn->close();
                    return true;
                }else{
                    $conn->close();
                    return false;   
                }      
            }else{
                $conn->close();
                return false;
            }           
        }
    }
}
