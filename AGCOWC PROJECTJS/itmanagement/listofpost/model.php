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
 
        $stmt = $this->conn->prepare("SELECT * FROM post LEFT JOIN admin2 ON post.id = admin2.id ORDER BY post.post_date DESC;");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
 
        return $data;
    }
 
    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `post` WHERE `post_id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findOne($id)
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `post` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
 
        return $data;
    }
}