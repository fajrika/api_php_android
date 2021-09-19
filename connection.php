<?php

class connection{
    public $conn;
    public function __construct(){
        $servername = "151.106.117.102";
        $username = "u210473105_dennis";
        $password = "Antihack22.";
        $db = "u210473105_dennis";
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