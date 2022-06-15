<?php
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'test');
    function create_connection(){
        $conn = new mysqli(HOST, USER, PASS, DB);
        if ($conn->connect_error) {
            die('Connect failed with message: ' . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }

    $conn = create_connection();

?>