<?php
    require_once('db.php');
    session_start();

    function login($username, $password){
        $conn = create_connection();
        $sql = " SELECT * FROM account WHERE username = ? and password = ? ";

        

        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$username, $password);

        if(!$stm->execute()) return false;

        $result = $stm->get_result();
        if($result->num_rows !== 1) return false;
        $data = $result->fetch_assoc();

        $_SESSION['permisson'] = $data['role'];
        $_SESSION['position'] = $data['position'];
         
        return $data;
        
    }
?>  