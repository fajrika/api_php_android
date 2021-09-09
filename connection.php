<?php

class connection{
    public $conn;
    public function __construct(){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "abc123??";
        $db = "dennis";
        $this->conn = new mysqli($servername, $username, $password,$db);
    }

    public function create(){
        if ($this->conn->connect_error)
            return false;
        return $this->conn;
    }
    public function close(){
        if($this->conn)
            $this->conn->close();
    }
}