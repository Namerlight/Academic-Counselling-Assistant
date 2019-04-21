<?php

require_once 'DBOperations.php';

$response = array();

$us = 'mizan@gmail.com';
$ps = 'mizan1995';

echo $us, $ps;

#if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['username']) and isset($_POST['password'])){
        $db = new DbOperations();

        if($db->userLogin($_POST['username'], $_POST['password'])){
            $user = $db->getUserByUsername($_POST['username']);
            $response['error'] = false;
            $response['id'] = $user['id'];
            $response['email'] = $user['email'];
            $response['username'] = $user['username'];
            echo "logged in";
        }else{
            $response['error'] = true;
            $response['message'] = "Invalid username or password";
            echo "false";
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    #}
}

echo json_encode($response);