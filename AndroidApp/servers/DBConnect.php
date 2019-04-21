<?php

class DBConnect {

    private $connection;
    function __construct(){

    }


    function connect(){
        echo "Connecting";
        $connection = new mysqli('localhost', 'root', '', 'aca');

        if(mysqli_connect_errno()){
            echo "Failed to connect with database".mysqli_connect_err();
        } else {
            echo "Successfully Connected";
        }

        return $connection;
    }
}