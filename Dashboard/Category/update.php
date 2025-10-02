<?php
    include("../../Config/connect.php");
if(isset($_POST["type"]) && $_POST["type"] == "Update"){
    if(isset($_POST["idEdit"]) && $_POST["catagory_id_up"] && $_POST["name_category_up"] && 
             $_POST["title_catagory_up"] && $_POST["status_up"]){

        $idEdit= $_POST["idEdit"];
        $catagory_id= $_POST["catagory_id_up"];
        $name_category= $_POST["name_category_up"];
        $title_catagory= $_POST["title_catagory_up"];
        $status= $_POST["status_up"];

        $sql = "UPDATE category SET 
                    name_category = '$name_category', 
                    catagory_id = '$catagory_id', 
                    title_catagory = '$title_catagory', 
                    status = '$status' 
                WHERE id = $idEdit";

        if($con->query($sql) === TRUE){
            echo "Category updated successfully";
        } else {
            echo "Error updating record: " . $con->error;
        }
    } else {
        echo "Missing required fields.";
    }
    $con->close();
}
?>
