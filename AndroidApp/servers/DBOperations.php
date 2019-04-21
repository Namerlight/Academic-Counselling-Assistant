<?php

class DBOperations {

    private $connection;

    function __construct()
    {

        require_once 'DBConnect.php';

        $db = new DbConnect();

        $this->connection = $db->connect();

    }

    public function userLogin($username, $pass)
    {
        $password = md5($pass);
        $stmt = $this->connection->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;

    }

    public function getUserByUsername($username){
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}


?>