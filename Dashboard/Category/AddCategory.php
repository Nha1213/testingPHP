<?php 

    include("../../Config/connect.php");

    if ($_POST['type'] == 'addCategory') {
        $catagory_id = $_POST['catagory_id'];
        $name_category = $_POST['name_category'];
        $title_catagory = $_POST['title_catagory'];
        $status = $_POST['status'];

        $sql = "INSERT INTO category (catagory_id, name_category, title_catagory, status) VALUES ('$catagory_id', '$name_category', '$title_catagory', '$status')";
        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

?>