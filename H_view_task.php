<?php
require_once('db/db.php');
session_start();
if (!isset($_SESSION["username"])) {
    header('location: login.php');
}

function get_task_by_id($id)
{
    $sql = "SELECT * FROM task Where id = $id ";
    $conn = create_connection();
    $result = $conn->query($sql);
    $data = array();

    for ($i = 1; $i <= $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $data[] = $row;
    }
    return $data;
}

$dataRow = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $idtask = $_GET['id'];

    $data = get_task_by_id($idtask);


    if (isset($data)) {
        $dataRow = $data[0];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="manage_Task.php">Dashboard</a></li>
                    <li><a href="H_inf_user.php">Personal Information</a></li>
                    <li><a href="H_manage_leave.php">Leaves Management</a></li>
                    <li><a href="H_leave_history.php">Leaves History</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Hello, <?= $_SESSION['username'] ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Internal Website</h1>
                </div>
            </div>
        </div>
    </header>

    <section id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="manage_Task.php">Dashboard</a></li>
                <li class="active">View Task</li>
            </ol>
        </div>
    </section>

    <section id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group">
                        <a href="manage_Task.php" class="list-group-item active main-color-bg">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Control Panel
                        </a>
                        <a href="H_inf_user.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Personal Information</a>
                        <a href="H_manage_leave.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Leaves Management</a>
                        <a href="H_leave_history.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Leave History</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Task</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <h3 class="text-center text-primary"><?= $dataRow["tname"] ?></h3>
                                <tr>
                                    <th>Done by:</th>
                                    <td><?= $dataRow["ename"] ?></td>
                                </tr>
                                <tr>
                                    <th>Progress:</th>
                                    <td><?= $dataRow["progress"] ?></td>
                                </tr>
                                <tr>
                                    <th>Deadline:</th>
                                    <td><?= $dataRow["deadline"] ?></td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td><?= $dataRow["detail"] ?></td>
                                </tr>
                                <tr>
                                    <th>Employee's work:</th>
                                    <td><?= $dataRow["ework"] ?></td>
                                </tr>
                                <tr>
                                    <th>File:</th>
                                    <td></td>
                                </tr>
                            </table>

                            <input class="hidden" id="TaskID" value="<?= $dataRow["id"] ?>" />
                            <button class="btn btn-success btn-lg" id="btnCompleteTask">Complete</button>
                            <a href="resend_task.php"><button class="btn btn-info btn-lg">Resend</button>
                            <button class="btn btn-lg btn-warning" id="btnCancelTask">Cancel</button>
                                
                                <button class="btn btn-lg btn-link" id="btnViewTaskSubmit">View task submit</button>
                                <br>
                                <a class="btn btn-link" id="btnViewHistory">View history task</a>
                            </a>
                        </div>
                    </div>

                    <div class="panel panel-default hidden" id="divTaskSubmit">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Task submit</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="file">File submit:</label>
                                <div id="divFileSubmit"></div>
                            </div>

                            <div class="form-group">
                                <label for="Decription">Decription:</label>
                                <textarea readonly rows="4" type="text" class="form-control" id="description" name="description" placeholder="Enter Decription for your works"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="Decription">Datetime submit:</label>
                                <input id="dateupdate" class="form-control" readonly/>
                            </div>

                            <div class="form-group">
                                <label>Assessment</label>
                                <select id="Assessment" class="form-control selectpicker" >
                                    <option value="">Please select option</option>
                                    <option value="Good">Goood</option>
                                    <option value="Bad">Bad</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label>Assessment time</label>
                                <select id="AssessmentTime" class="form-control selectpicker" >
                                    <option value="">Please select option</option>
                                    <option value="Soon">Soon</option>
                                    <option value="On time">On time</option>
                                    <option value="Late">Late</option>
                                </select>
                            </div>

                            <div>
                            <label>Note</label>
                               <textarea id="Note" name="Note" class="form-control" rows="5"></textarea>
                            </div>

                            <input id="TaskRecordID" name="TaskRecordID" class="hidden"/>

                            <br>
                           
                            <button class="btn btn-lg btn-default" id="btnAcceptTask">Accept</button>
                            <button class="btn btn-lg btn-success" style="background-color: #bb4163;" id="btnRejectTask">Reject</button>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Task history</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Fullname</th>
                                        <th>Datetime</th>
                                        <th>status</th>
                                        <th>Content</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodytaskhistory">

                                </tbody>
                            </table>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer" class="col-md-12">
        <p>Copyright Software Engineering TDTU, &copy; 2021</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#btnCancelTask").click(function(e) {
                e.preventDefault();

                var confirmResult = confirm("Are you sure cancel task?");
                if (!confirmResult) {
                    return;
                }

                var reason = prompt("Please enter your reason!");

                var taskID = $("#TaskID").val();
                var status = "cancel";

                $.ajax({
                    type: "POST",
                    url: "update_status_task.php",
                    data: {
                        taskID: taskID,
                        status: status,
                        reason: reason
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.result == "OK") {

                        } else {

                        }

                        alert(resp.message);
                        window.location.reload();
                    },
                    error: function(resp) {

                    }
                });
            });


            $("#btnRejectTask").click(function(e) {
                e.preventDefault();

                var confirmResult = confirm("Are you sure reject task?");
                if (!confirmResult) {
                    return;
                }

                //var reason = prompt("Please enter your reason!");

                var taskID = $("#TaskID").val();
                var status = "reject";
                var taskRecordID =  $("#TaskRecordID").val();
                var note =  $("#Note").val();
                var assessment =  $("#Assessment").val();
                var assessmentTime =  $("#AssessmentTime").val();

                $.ajax({
                    type: "POST",
                    url: "update_status_task.php",
                    data: {
                        taskID: taskID,
                        status: status,
                        taskRecordID: taskRecordID,
                        assessment: assessment,
                        assessmentTime: assessmentTime,
                        note: note,
                        reason: note
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.result == "OK") {

                        } else {

                        }

                        alert(resp.message);
                        window.location.reload();
                    },
                    error: function(resp) {

                    }
                });
            });

            $("#btnCompleteTask").click(function(e) {
                e.preventDefault();

                var confirmResult = confirm("Are you sure complete task?");
                if (!confirmResult) {
                    return;
                }

                var reason = prompt("Please enter your note!");

                var taskID = $("#TaskID").val();
                var status = "complete";

                $.ajax({
                    type: "POST",
                    url: "update_status_task.php",
                    data: {
                        taskID: taskID,
                        status: status,
                        reason: reason
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.result == "OK") {

                        } else {

                        }

                        alert(resp.message);
                        window.location.reload();
                    },
                    error: function(resp) {}
                });
            });

            //btnAcceptTask
            $("#btnAcceptTask").click(function(e) {
                e.preventDefault();

                var confirmResult = confirm("Are you sure accept task?");
                if (!confirmResult) {
                    return;
                }

                //var reason = prompt("Please enter your note!");

                var taskID = $("#TaskID").val();
                var status = "accept";
                var taskRecordID =  $("#TaskRecordID").val();
                var note =  $("#Note").val();
                var assessment =  $("#Assessment").val();
                var assessmentTime =  $("#AssessmentTime").val();


                $.ajax({
                    type: "POST",
                    url: "update_status_task.php",
                    data: {
                        taskID: taskID,
                        status: status,
                        taskRecordID: taskRecordID,
                        assessment: assessment,
                        assessmentTime: assessmentTime,
                        note: note,
                        reason: note
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (resp.result == "OK") {

                        } else {

                        }

                        alert(resp.message);
                        window.location.reload();
                    },
                    error: function(resp) {

                    }
                });
            });

            $("#btnViewHistory").click(function(e) {
                e.preventDefault();
                var taskID = $("#TaskID").val();

                $.ajax({
                    type: "POST",
                    url: "get_task_history.php",
                    data: {
                        taskID: taskID,
                    },
                    success: function(resp) {
                        console.log(resp);
                        $("#tbodytaskhistory").empty();
                        if (resp != null) {
                            $.each(resp, function(index, value) {
                                var html = '<tr>'
                                html += '<td>' + (index + 1) + '</td>';
                                html += '<td>' + value.fname + '</td>';
                                html += '<td>' + value.dateupdate + '</td>';
                                html += '<td>' + value.status + '</td>';
                                html += '<td>' + value.reason + '</td>';
                                html += '</tr>';

                                $("#tbodytaskhistory").append(html);
                            });
                        }

                    },
                    error: function(resp) {

                    }
                });
            });

            $("#btnViewTaskSubmit").click(function(e) {
                e.preventDefault();
                var taskID = $("#TaskID").val();
                //alert("abc");

                $("#description").val("");
                $("#divFileSubmit").empty();
                $("#dateupdate").val("");
                $("#TaskRecordID").val("");

                $.ajax({
                    type: "POST",
                    url: "get_task_submit.php",
                    data: {
                        taskID: taskID,
                    },
                    success: function(resp) {
                        if (resp != null) {
                           console.log(resp);

                            $("#description").val(resp.description);
                            if (resp.prooffile != "" && resp.prooffile != null){
                                var html = '<a class="btn btn-link" href="'+resp.prooffile+'" target="_blank" >' + 'File submit' +  '</a>';
                                $("#divFileSubmit").append(html);
                            }

                            $("#dateupdate").val(resp.dateupdate);

                            $("#TaskRecordID").val(resp.id);
                            $("#divTaskSubmit").removeClass("hidden");
                        }
                    },
                    error: function(resp) {}
                });
            });



        });
    </script>
</body>

</html>