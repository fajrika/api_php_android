<?php

require_once('connection.php');

class achievement{
    public $connection;
    public $response; 

    public function __construct($response)
    {
        $this->response = $response;
        $this->connection = (new connection)->create();
        if($this->connection === false)
            return 'connnection to db : error';
    }
    public function __destruct()
    {
        $this->connection->close();
    }
    public function grade($tingkatan,$peringkat){
        switch ($tingkatan) {
            case 'provinsi':
                switch ($peringkat) {
                    case '1': $grade = "B";break;
                    case '2': $grade = "B";break;
                    case '3': $grade = "C";break;                    
                    default : $grade = "C";break;
                }
                break;
            case 'nasional':
                switch ($peringkat) {
                    case '1': $grade = "A";break;
                    case '2': $grade = "B";break;
                    case '3': $grade = "B";break;                    
                    default : $grade = "B";break;
                }
                break;
            case 'internasional':
                switch ($peringkat) {
                    case '1': $grade = "A";break;
                    case '2': $grade = "A";break;
                    case '3': $grade = "A";break;                    
                    default : $grade = "A";break;
                }
                break;
            default : $grade = "D";break;
        }
        return $grade;
    }

    public function create($nisn,$nama,$nama_lomba,$tgl_lomba,$penyelenggara,$tingkatan,$peringkat,$pembimbing,$keterangan = null){
        $grade = $this->grade($tingkatan,$peringkat);
        $sql = "INSERT INTO achievements (nisn,nama,nama_lomba,tgl_lomba,penyelenggara,tingkatan,peringkat,grade,pembimbing,keterangan)
                VALUES ('$nisn','$nama','$nama_lomba','$tgl_lomba','$penyelenggara','$tingkatan','$peringkat','$grade','$pembimbing','$keterangan')";
        if ($this->connection->query($sql) === TRUE) {
            $this->response->message = "Database created successfully";
            $this->response->code = 200;
        } else {
            $this->response->message = "Database created failed, ".$this->connection->error;
            $this->response->code = 500;
        }
        return $this->response;
    }

    public function read()
    {
        $result = $this->connection->query('SELECT * FROM achievements');    
        while($row = $result->fetch_assoc())
            $rows[] = $row;
        $this->response->data = $rows;
        return $this->response;
    }

    public function update($id,$nisn,$nama,$nama_lomba,$tgl_lomba,$penyelenggara,$tingkatan,$peringkat,$pembimbing,$keterangan = null){
        $grade = $this->grade($tingkatan,$peringkat);
        $sql = 
        "UPDATE achievements 
            SET 
                nisn = '$nisn',
                nama = '$nama',
                nama_lomba = '$nama_lomba',
                tgl_lomba = '$tgl_lomba',
                penyelenggara = '$penyelenggara',
                tingkatan = '$tingkatan',
                peringkat = '$peringkat',
                grade = '$grade',
                pembimbing = '$pembimbing',
                keterangan = '$keterangan'
        WHERE id = '$id'";
        if ($this->connection->query($sql) === TRUE) {
            $this->response->message = "Database updated successfully";
            $this->response->code = 200;
        } else {
            $this->response->message = "Database updated failed, ".$this->connection->error;
            $this->response->code = 500;
        }
        return $this->response;
    }

    public function delete($id){
        $sql = "DELETE FROM achievements WHERE id = '$id'";
        if ($this->connection->query($sql) === TRUE) {
            $this->response->message = "Database deleted successfully, with id : '$id'";
            $this->response->code = 200;
        } else {
            $this->response->message = "Database deleted failed, ".$this->connection->error;
            $this->response->code = 500;
        }
        return $this->response;

    }
}