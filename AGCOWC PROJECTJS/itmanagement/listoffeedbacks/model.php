<?php
class Model
{
    private $server = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'db_agcowc';
    private $conn;
 
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function findAll()
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM feedback INNER JOIN users ON feedback.user_id = users.user_id");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
 
        return $data;
    }
 
    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `feedback` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findOne($id)
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `feedback` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
 
        return $data;
    }
}