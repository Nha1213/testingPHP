<?php
    include("../../Config/connect.php");
    if($_POST["type"] == "DeleteCate") {
        $id = $_POST["id"];
        $sql = "DELETE FROM category WHERE id = $id";
        if($con->query($sql) === TRUE) {
            echo "Category deleted successfully";
        } else {
            echo "Error deleting category: " . $con->error;
        }
    }

?>