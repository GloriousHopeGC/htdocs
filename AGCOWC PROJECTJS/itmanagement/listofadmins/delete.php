<?php 
 
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
 
        include 'model.php';
 
        $model = new Model();
 
        if ($model->destroy($id)) {
            $data = array('res' => 'success');
        }else{
            $data = array('res' => 'error');
        }
 
        echo json_encode($data);
    }