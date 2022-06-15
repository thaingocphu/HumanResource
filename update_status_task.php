<?php

require_once('db/db.php');
session_start();
if(!isset($_SESSION["username"])){
    header('location: login.php');
}
$username = $_SESSION["username"];


$result = "";
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $taskID = $_POST["taskID"];
    $status = $_POST["status"];
    $reason = $_POST["reason"];
    //var_dump($taskID);

    $slqi = "SELECT * FROM task WHERE id = $taskID ";
    $result = $conn->query($slqi);
    if($result->num_rows <= 0){
        $message = 'Task was not found!';

        return;
    }  

    //$stateName = "cancel";

    $sql = "UPDATE task SET progress = '$status' where id = $taskID ";

    $datenow = date("Y-m-d H:i:s", time());

    //var_dump($datenow); die;

    if ($conn->query($sql) === TRUE) {

        $sql = "INSERT INTO task_history (username, taskid ,`status`, dateupdate, detail, reason) VALUES ('$username', '$taskID', '$status', '$datenow', '' ,'$reason')";
    

        
        try {
            if ($conn->query($sql) === TRUE) {

                if ($status == "accept" || $status = "reject"){

                    $taskRecordID = $_POST["taskRecordID"];
                    $assessment = $_POST["assessment"];
                    $assessmentTime = $_POST["assessmentTime"];
                    $note = $_POST["note"];

                    $sqlUpdate = "UPDATE task_record SET 
                    assessment = '$assessment',
                    assessmentTime  = '$assessmentTime',
                    note = '$note',
                    assessmentstatus = '$status'
                    WHERE ID = $taskRecordID
                    ";

                    if ($conn->query($sqlUpdate) === TRUE) {}
                }
            }

        } catch(Exception $e) {

        }

        $message = 'Update task successful!';
        $result = "OK";
    } else {
        $message = "Update task failed!";
        $result = "ERROR";
    }
    $conn->close();


    $data = array(
        'result'=> $result,
        'message'=> $message
    );
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}