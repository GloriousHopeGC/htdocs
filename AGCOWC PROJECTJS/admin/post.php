<?php
include('dbcon.php');

$action = 'alldata';

if (isset($_GET['post'])) {
    $action = $_GET['post'];
}

if ($action == 'alldata') {
    $sql = "SELECT * FROM post INNER JOIN admin2 ON post.id = admin2.id";
    $query = $conn->query($sql);
    $users = array();

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        array_push($users, $row);
    }

    $out['users'] = $users;
}

if ($action == 'register') {
    function check_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $post_title = check_input($_POST['title']);
    $post = check_input($_POST['post']);
    $post_date = date('Y-m-d H:i:s');

    $post_options = $_POST['option'];

    if (isset($_POST['option']) && is_array($_POST['option'])) {
        if (in_array('public', $_POST['option']) && in_array('private', $_POST['option'])) {
            $post_options = 3;
        } elseif (in_array('public', $_POST['option'])) {
            $post_options = 1;
        } elseif (in_array('private', $_POST['option'])) {
            $post_options = 2;
        }
        
    }
   
    $admin_id = $_POST['adminid'];

    if ($post_title == '') 
    {
        $out['error'] = true;
        $out['message'] = "Title is required";
    } 
    elseif ($post == '') 
    {
        $out['error'] = true;
        $out['message'] = "Post is required"; 
    }
    else if ($post_options == '0'){
        $out['error'] = true;
        $out['message'] = "Post is required"; 
    }
    else {
        try {
            $stmt = $conn->prepare("CALL sp_post(:post_title, :post, :post_date, :post_options, :admin_id)");
    
            $stmt->bindParam(':post_title', $post_title);
            $stmt->bindParam(':post', $post);
            $stmt->bindParam(':post_date', $post_date);
            $stmt->bindParam(':post_options', $post_options);
            $stmt->bindParam(':admin_id', $admin_id);
        

            if ($stmt->execute()) {
                $out['message'] = "Post Added Successfully";
				
            } else {
                $out['error'] = true;
                $out['message'] = "Could not add post";
            }
        } catch (PDOException $e) {
            $out['error'] = true;
            $out['message'] = "Database Error: " . $e->getMessage();
        }
    }
}

if ($action == 'delete') {
    $del = $_GET['id'];
    $sqldel = "DELETE FROM user WHERE user_id = :del";
    $stmt = $conn->prepare($sqldel);
    $stmt->bindParam(':del', $del);

    if ($stmt->execute()) {
        $out['message'] = "Deleted $del";
    } else {
        $out['error'] = true;
        $out['message'] = "Could not delete record";
    }
}

$conn = null; // Close the PDO connection

header("Content-type: application/json");
echo json_encode($out);
die();
?>
