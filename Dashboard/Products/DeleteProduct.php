<?php 

include("../../Config/connect.php");    

if(isset($_POST["type"]) && $_POST["type"] === "DeleteProduct"){
    $id = $_POST["id"];

    $sql = "DELETE FROM products WHERE id = '$id'";

    if($con->query($sql) === TRUE){
        echo "success";
    } else {
        echo "Error: " . $con->error;
    }
}


?>