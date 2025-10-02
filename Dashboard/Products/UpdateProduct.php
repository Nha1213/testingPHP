<?php 
include("../../Config/connect.php");
if(isset($_POST["type"]) && $_POST["type"] === "UpdateProduct"){
    $update_id                   = $_POST["update_id"];
    $update_product_id           = $_POST["update_Products_id"];
    $update_product_name         = $_POST["update_Products_name"];
    $update_product_title        = $_POST["update_Products_title"];
    $update_product_price        = $_POST["update_Products_price"];
    $update_product_brand       = $_POST["update_Products_brand"];
    $update_products_Date_Create = $_POST["update_Products_Date_Create"];
    $update_products_category_id = $_POST["update_Products_category_name"];


    // Handle image upload
    $imageName = ""; // Default to existing image
    if (!empty($_FILES["Update_Image_file"]["name"])) {
        $file     = $_FILES["Update_Image_file"];
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $imageName = rand(100000, 999999) . "_" . date("Ymd_His") . "." . $ext;
        $uploadPath = __DIR__ . "./image/" . $imageName;
        move_uploaded_file($file["tmp_name"], $uploadPath);
    }
    // Update DB
    $sql = "UPDATE products SET 
                product_id = '$update_product_id',
                product_name = '$update_product_name',
                image = '$imageName',
                title_detail = '$update_product_title',
                price = '$update_product_price',
                brand_id = '$update_product_brand',
                create_at = '$update_products_Date_Create',
                cate_id = '$update_products_category_id'
            WHERE id = '$update_id'";

    if($con->query($sql) === TRUE){
        echo "success";
    } else {
        echo "Error: " . $con->error;
    }
}

?>