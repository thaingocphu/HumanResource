<?php
require_once('db/db.php');
session_start();
if(!isset($_SESSION["username"])){
    header('location: login.php');
}
$username = $_SESSION["username"];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskID=$_POST["taskID"];

    $slqi = "SELECT th.*, a.fname FROM task_record th left join 
     account a on a.username = th.username
     WHERE th.taskid = $taskID 
     ORDER BY th.id desc
      ";
    $result = $conn->query($slqi);

    $data=array();
  
    for($i =1 ; $i <= $result-> num_rows; $i++ ){
      $row = $result -> fetch_assoc();
      $data[] = $row;
      //return;
    }

    $dataRow = [];
    if (isset($data)){
        $dataRow = $data[0];
      }

    header('Content-type: application/json');
    echo json_encode($dataRow);
    exit();
}