<?php
require_once('db/db.php');
session_start();
if(!isset($_SESSION["username"])){
    header('location: login.php');
}
$username = $_SESSION["username"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskID=$_POST["taskID"];

    $slqi = "SELECT th.*, a.fname FROM task_history th left join 
     account a on a.username = th.username
     WHERE th.taskid = $taskID 
     ORDER BY th.dateupdate desc
      ";
    $result = $conn->query($slqi);

    $data=array();
  
    for($i =1 ; $i <= $result-> num_rows; $i++ ){
      $row = $result -> fetch_assoc();
      $data[] = $row;
    }
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}