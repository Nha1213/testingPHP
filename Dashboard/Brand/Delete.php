<?php
    include("../../Config/connect.php");
    if(isset($_POST['type']) && $_POST['type'] == 'DeleteBrand'){
        $id = $_POST['id'];
        $sql = "DELETE FROM brand WHERE id = $id";
        if($con->query($sql) === TRUE){
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $con->error;
        }
    }
?>