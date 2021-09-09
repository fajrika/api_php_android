<?php

require_once('connection.php');

class auth{
    public $connection;
    
    public function __construct()
    {
        $this->connection = (new connection)->create();
        if($this->connection === false)
            return 'connnection to db : error';
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function login($username,$password)
    {
        $result = $this->connection->query("SELECT * FROM users where username = '$username' and password = '$password'");
        return $result->num_rows;
    }
}