<?php
require_once("db.php");

class Database
{
    public $connection;
    public $db;


    function __construct()
    {
       $this->db= $this->open_db_connection();
    }

    public function open_db_connection()
    {
        // $this->connection = mysqli_connect(db_host, db_user, db_pass, db_name);
        $this->connection =new mysqli(db_host, db_user, db_pass, db_name);
        if($this->connection->connect_errno){
            die("database connection failed".$this->connection->connect_error);
        }
        return $this->connection;
    }
    public function query($sql)
    {
        $result= $this->db->query($sql);
        $this->confirmQuery($result);
        return $result;
    }
    private function confirmQuery($result)
    {
        if(!$result)
        {
            die("Query failed".$this->db->error);
        }
    }
    public function escape_string($string)
    {
        return $this->db->real_escape_string($string);
    }
    public function insertId()
    {
        return $this->db->insert_id;
    }
    public function the_insert_id()
    {
        return mysqli_insert_id($this->db);
    }

}

$database= new Database();
