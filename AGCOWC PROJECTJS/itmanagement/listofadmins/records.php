<?php 
    include 'model.php';
 
    $model = new Model();
 
    $rows = $model->findAll();
 
    $data = array('rows' => $rows);
 
    echo json_encode($data);
    ?>