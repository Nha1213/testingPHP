<?php 
include("../../Config/connect.php");

if(isset($_POST['type']) && $_POST['type'] == 'UpdateBrand'){
    $id = $_POST['idEdit'];
    $brand_id = $_POST['brand_id_up'];
    $name_brand = $_POST['name_brand_up'];
    $Description = $_POST['description_brand_up'];

    $sql = "UPDATE brand SET brand_id='$brand_id', name_brand='$name_brand', Description='$Description' WHERE id=$id";
    if($con->query($sql) === TRUE){
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
}


?>