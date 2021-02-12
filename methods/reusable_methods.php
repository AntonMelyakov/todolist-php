<?php
//fetch from db
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

//if session is expired
function session_expired()
{
    if ((time() - $_SESSION['started']) > (60 * 30)) {
        return true;
    };
    return false;
}

//email validate
function isvalidemail($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
