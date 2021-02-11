<?php

class Connection
{
    public static $servername = "localhost";
    public static $dbname = "todo_list";
    public static $username = "root";
    public static $password = "";
    public static $conn;

    // get connection
    public static function getConnection()
    {
        // Create connection
        self::$conn = new mysqli(self::$servername, self::$username, self::$password, self::$dbname);
        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        } else {
            return self::$conn;
        }
    }

    public function closeConnection()
    {
        self::$conn->close();
    }
}
