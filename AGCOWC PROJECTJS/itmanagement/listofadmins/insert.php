<?php 
    if (isset($_POST['fname']) && isset($_POST['email'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $username= $_POST['username'];
        $password = $_POST['password'];
 
        include 'model.php';
 
        $model = new Model();
 
        if ($model->store($fname, $lname, $number, $email, $username, $password)) {
            $data = array('res' => 'success');
        }else{
            $data = array('res' => 'error');
        }
 
        echo json_encode($data);
    }