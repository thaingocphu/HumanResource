<?php
require_once ('db/db.php');
session_start();

if(!isset($_SESSION["username"])){
    header('location: login.php');
}

$username = $_SESSION["username"];
$result = "";
$message = "";

function insert_task_record($username, $taskID, $status, $datenow, $description, $prooffile){
    $sql = "INSERT INTO task_record (taskid, username ,`status`, dateupdate, `description`, prooffile) 
    VALUES ( '$taskID','$username', '$status', '$datenow', '$description' ,'$prooffile')";
    $conn = create_connection();

    $result = false;

    try {
        if ($conn->query($sql) === TRUE) {
            $result = true;
            } else {

            }
    } catch(Exception $e) {

    }

    return $result;
}


if (isset($_POST['taskID'])){
    $proofileName = time() . '-' . $_FILES["prooffile"]["name"];
    // For image upload

    $target_dir = "proofile/";

    if (!file_exists( $target_dir)) {
        mkdir( $target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($proofileName);

    $taskID = $_POST["taskID"];
    $status = "waiting";
    $description = $_POST["description"];


    if(file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }

    if (empty($error)) {
        if(move_uploaded_file($_FILES["prooffile"]["tmp_name"], $target_file)) {

            $datenow = date("Y-m-d H:i:s", time());

            $resultSQl = insert_task_record($username,$taskID,$status,$datenow,$description,$target_file);
            $reason = "submit task";

            if($resultSQl){

                $sql = "UPDATE task SET progress = '$status' where id = $taskID ";

                $datenow = date("Y-m-d H:i:s", time());

                if ($conn->query($sql) === TRUE) {

                    $sql = "INSERT INTO task_history (username, taskid ,`status`, dateupdate, detail, reason) VALUES ('$username', '$taskID', '$status', '$datenow', '' ,'$reason')";
                
                    try {
                        if ($conn->query($sql) === TRUE) {

                            } else {

                            }
                    } catch(Exception $e) {

                    }

                    
                } else {
       
                }


                $message = 'Send task successful!';
                $result = "OK";
            } else {
                $message = "Send task failed!";
                $result = "ERROR";
            }
        } else {
            $message = "Send task failed!";
            $result = "ERROR";
        }
    }


    $data = array(
        'result'=> $result,
        'message'=> $message
    );
    header('Content-type: application/json');
    echo json_encode($data);
    exit();
}