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
 
    public function store($fname, $lname, $number, $email, $username, $password)
    {
        $hpassword = md5($password);
        $stmt = $this->conn->prepare("INSERT INTO `admin2` (`admin_fname`, `admin_lname` , `admin_contactnum` , `admin_email` , `admin_username` , `admin_password`) VALUES ('$fname', '$lname', '$number', '$email', '$username', '$hpassword')");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findAll()
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `admin2` ORDER BY `id` ASC");
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
        }
 
        return $data;
    }
 
    public function destroy($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `admin2` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
 
    public function findOne($id)
    {
        $data = [];
 
        $stmt = $this->conn->prepare("SELECT * FROM `admin2` WHERE `id` = '$id'");
        if ($stmt->execute()) {
            $data = $stmt->fetch();
        }
 
        return $data;
    }
 
    public function update($id, $fname, $lname, $number, $email, $username, $password)
    {
        $hpassword = md5($password);
        $stmt = $this->conn->prepare("UPDATE `admin2` SET `admin_fname` = '$fname', `admin_lname` = '$lname', `admin_contactnum` = '$number', `admin_email` = '$email',  `admin_username` = '$username' , `admin_password` = '$hpassword' WHERE `id` = '$id'");
        if ($stmt->execute()) {
            return true;
        } else {
            return;
        }
    }
}