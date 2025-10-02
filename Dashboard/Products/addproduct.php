<?php 
include("../../Config/connect.php");

if (isset($_POST["type"]) && $_POST["type"] === "addProduct") {
    $product_id           = $_POST["Products_id"];
    $product_name         = $_POST["Products_name"];
    $product_title        = $_POST["Products_title"];
    $product_price        = $_POST["Products_price"];
    $product_brand       = $_POST["Products_brand"];
    $products_Date_Create = $_POST["Products_Date_Create"];
    $products_category_id = $_POST["Products_category"];

    // Handle image upload
    $imageName = "";
    if (!empty($_FILES["Image_file"]["name"])) {
        $file     = $_FILES["Image_file"];
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $imageName = rand(100000, 999999) . "_" . date("Ymd_His") . "." . $ext;
        $uploadPath = __DIR__ . "/image/" . $imageName;
        move_uploaded_file($file["tmp_name"], $uploadPath);
    }

    // Insert into DB
    $sql = "INSERT INTO products (
                product_id, product_name, image, title_detail,
                price, brand_id, create_at, 
                cate_id
            ) VALUES (
                '$product_id', '$product_name', '$imageName', '$product_title',
                '$product_price', '$product_brand', '$products_Date_Create',
                '$products_category_id'
            )";

    if ($con->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $con->error;
    }
}
?>
