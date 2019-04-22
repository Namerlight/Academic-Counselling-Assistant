<?php

//require_once '../ACADEMIC_COUNSELLING_ASSISTANT/AndroidApp/includes/DbOperations.php';

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/nsu.spring2019.cse327.1.t4/AndroidApplication/AndroidServer/includes/DbOperations.php');

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['username']) and
        isset($_POST['name']) and
        isset($_POST['email']) and
        isset($_POST['password'])) {
        //operate the data further

        $db = new DbOperations();

        $result = $db->createUser(
            $_POST['username'],
            $_POST['name'],
            $_POST['email'],
            $_POST['password']
        );
        if ($result == 1) {
            $response['error'] = false;
            $response['message'] = "User registered successfully";
        } elseif ($result == 2) {
            $response['error'] = true;
            $response['message'] = "Some error occurred please try again";
        } elseif ($result == 0) {
            $response['error'] = true;
            $response['message'] = "It seems you are already registered, please choose a different email and username";
        }

    } else {
        $response['error'] = true;
        $response['message'] = "Required fields are missing";
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid Request";
}

echo json_encode($response);
