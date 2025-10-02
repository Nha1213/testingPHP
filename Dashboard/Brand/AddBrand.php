<?php 

    include("../../Config/connect.php");

    if ($_POST['type'] == 'addBrand') {
        $brand_id = $_POST['brand_id'];
        $name_brand = $_POST['name_brand'];
        $Description = $_POST['Description'];

        $sql = "INSERT INTO brand (brand_id, name_brand, Description)
            VALUES ('$brand_id', '$name_brand', '$Description')"
        ;
        if ($con->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

?>