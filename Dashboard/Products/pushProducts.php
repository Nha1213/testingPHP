<?php 
    include("../../Config/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- <link rel="stylesheet" href="styleproduct.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styleproduct.css">
</head>
<body>

<div class="container mt-4">
    <h2>Product List</h2>
    <table id="ProductsTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropBrand">Add</button>
                </th>
                <th>ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Date Create</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php 
               $sql = "
                    SELECT 
                        p.id as id,
                        p.product_id as product_id,
                        p.product_name as product_name,
                        p.price as price,
                        c.name_category as category_name,
                        b.name_brand as brand_name,
                        p.image as image,
                        p.title_detail as title_detail,
                        p.create_at as create_at,
                        b.brand_id as brand_id,
                        c.catagory_id as category_id
                    FROM products p
                    INNER JOIN category c ON p.cate_id = c.catagory_id
                    INNER JOIN brand b ON p.brand_id = b.brand_id
                ";

                $result = $con->query($sql);
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#UpDate" class="btn btn-primary editBtn"
                            data-id="<?php echo $row["id"]; ?>"
                            data-product_id="<?php echo $row["product_id"]; ?>"
                            data-product_name="<?php echo $row["product_name"]; ?>"
                            data-image="<?php echo $row["image"]; ?>"
                            data-title_detail="<?php echo htmlspecialchars($row["title_detail"], ENT_QUOTES); ?>"
                            data-price="<?php echo $row["price"]; ?>"
                            data-category_name="<?php echo $row["category_name"]; ?>"
                            data-product_brand="<?php echo $row["brand_name"]; ?>"
                            data-brand_id="<?php echo $row["brand_id"]; ?>"
                            data-category_id="<?php echo $row["category_id"]; ?>"
                            data-create_at="<?php echo $row["create_at"]; ?>"
                        >Edit</button>
                        <button class="btn btn-danger deleteBtn" data-id="<?php echo $row["id"]; ?>">Delete</button>
                    </td>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>
                        <?php if(!empty($row['image'])) { ?>
                            <img src="./image/<?php echo $row['image']; ?>" width="60" height="60">
                        <?php } ?>
                    </td>
                    <td >
                        <div style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo $row['title_detail']; ?>
                        </div>
                    </td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo $row['brand_name']; ?></td>
                    <td><?php echo $row['create_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add Product -->
<div class="modal fade" id="staticBackdropBrand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">ADD PRODUCT</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="myForm">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="Products_id" name="Products_id">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="Products_name" name="Products_name">
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="Products_title" name="Products_title">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" id="Products_price" name="Products_price">
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" id="Products_category" name="Products_category">
                        <option value="" selected disabled>Select Category</option>
                        <?php 
                            $catSql = "SELECT * FROM category";
                            $catResult = $con->query($catSql);
                            while($catRow = $catResult->fetch_assoc()){
                                echo '<option value="'.$catRow['catagory_id'].'">'.$catRow['name_category'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Brand</label>
                    <select class="form-select" id="Products_brand" name="Products_brand">
                        <option value="" selected disabled>Select Brand</option>
                        <?php 
                            $brandSql = "SELECT * FROM brand";
                            $brandResult = $con->query($brandSql);
                            while($brandRow = $brandResult->fetch_assoc()){
                                echo '<option value="'.$brandRow['brand_id'].'">'.$brandRow['name_brand'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Create At</label>
                    <input type="date" class="form-control" id="Products_Date_Create" name="Products_Date_Create">
                </div>
                <div class="col-6 mb-3" >
                    <label class="form-label">Image</label>
                    <div class="file_path">
                        <input type="file" class="form-control Image_file" id="Image_file" name="Image_file">
                        <input type="text" class="w-100" id="Image_file_path" name="Image_file_path" >
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="SaveBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Update Product -->
<div class="modal fade" id="UpDate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">UPDATE PRODUCT</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="UpdateForm">
            <input type="hidden" id="update_id" name="update_id">
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Product ID</label>
                    <input type="text" class="form-control" id="update_Products_id" name="update_Products_id">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="update_Products_name" name="update_Products_name">
                </div>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" id="update_Products_title" name="update_Products_title">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" class="form-control" id="update_Products_price" name="update_Products_price">
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Category Name</label>
                    <select name="update_Products_category_name" id="update_Products_category_name" class="form-select">
                        <option value="" selected>Select Category</option>
                        <?php 
                            $categorySql = "SELECT c.catagory_id as catagory_id, 
                                c.name_category as name_category,
                                p.cate_id as cate_id FROM category c
                              inner join products p on c.catagory_id = p.cate_id
                            ";
                            $categoryResult = $con->query($categorySql);
                            
                            while($categoryRow = $categoryResult->fetch_assoc()){
                                if($categoryRow['catagory_id'] == $categoryRow['cate_id']){
                                    echo '<option value="'.$categoryRow['catagory_id'].'" selected>'.$categoryRow['name_category'].'</option>';
                                    continue;
                                }
                                echo '<option value="'.$categoryRow['catagory_id'].'">'.$categoryRow['name_category'].'</option>';
                            }
                        ?>
                    </select>

                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Product Brand</label>
                    <select name="update_Products_brand" id="update_Products_brand" class="form-select">
                        <option value="" selected>Select Brand</option>
                        <?php 
                            $brandSql = "SELECT b.brand_id as brand_id,
                                b.name_brand as name_brand,
                                 p.brand_id as brand_id FROM brand b
                                inner join products p on b.brand_id = p.brand_id
                            ";
                            $brandResult = $con->query($brandSql);
                            while($brandRow = $brandResult->fetch_assoc()){
                                if($brandRow['brand_id'] == $brandRow['brand_id']){
                                    echo '<option value="'.$brandRow['brand_id'].'" selected>'.$brandRow['name_brand'].'</option>';
                                    continue;
                                }
                                echo '<option value="'.$brandRow['brand_id'].'">'.$brandRow['name_brand'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Create At</label>
                    <input type="date" class="form-control" id="update_Products_Date_Create" name="update_Products_Date_Create">
                </div>
                <div class="col-6 mb-3" >
                    <label class="form-label">Image</label>
                    <div class="file_path" id="Update_file_path">
                        <input type="file" class="form-control Image_file" id="Update_Image_file" name="Update_Image_file" required>
                        <input type="text" class="w-100 Image_file_path" id="Update_Image_file_path" name="Update_Image_file_path" >
                    </div>
                </div>  
            </div>
        </form>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="UpdateBtn">Update</button>
        </div>
    </div>
    </div>
</div>


<script>
    let imageInput = document.getElementById('Image_file');
    let imagePathInput = document.getElementById('Image_file_path');
    let file_path = document.querySelector('.file_path');
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
    imageInput.addEventListener("change", function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const base64String = e.target.result;
                console.log("Base64:", base64String);
                document.querySelector(".file_path").style.backgroundImage = "url("+base64String+")";
                imagePathInput.value = "Have Image";
            };
            reader.readAsDataURL(file); // Converts file to base64
        });
</script>
<script>
    let Update_imageInput = document.getElementById('Update_Image_file');
    let Update_imagePathInput = document.getElementById('Update_Image_file_path');
    let Update_file_path = document.querySelector('#Update_file_path');
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }
    Update_imageInput.addEventListener("change", function () {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const base64String = e.target.result;
                console.log("Base64:", base64String);
                Update_file_path.style.backgroundImage = "url("+base64String+")";
                Update_imagePathInput.value = "Have Image";
            };
            reader.readAsDataURL(file); // Converts file to base64
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    $('#ProductsTable').DataTable({
        lengthMenu: [5, 10, 25, 50],
        pageLength: 10,
        order: [[1, 'asc']],
        columnDefs: [{ targets: 0, orderable: false, searchable: false }]
    });

    // Save product and add products 
    $('#SaveBtn').off('click').on('click', function(){
        let formData = new FormData($("#myForm")[0]);
        formData.append("type", "addProduct");

        $.ajax({
            url: 'addproduct.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.trim() === "success"){
                    Swal.fire("Product added successfully!", "", "success").then(() => location.reload());
                } else {
                    Swal.fire("Error!", response, "error");
                }
            },
            error: function(xhr, status, error){
                Swal.fire("Error!", "Failed to save data: " + error, "error");
            }
        });
    });

    // Delete category
    $(document).on('click', '.deleteBtn', function(){
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won’t be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: 'DeleteProduct.php',
                    type: 'POST',
                    data: { type: 'DeleteProduct', id: id },
                    success: function(response){
                        Swal.fire("Deleted!", "Product has been deleted.", "success").then(() => location.reload());
                    },
                    error: function(xhr, status, error){
                        Swal.fire("Error!", "Failed to delete: " + error, "error");
                    }
                });
            }
        });
    });

    // Update onclick edit product
    $(document).on('click', '.editBtn', function(){
        var id = $(this).data('id');
        var product_id = $(this).data('product_id');
        var product_name = $(this).data('product_name');
        var image = $(this).data('image');
        var title_detail = $(this).data('title_detail');
        var price = $(this).data('price');
        var category_id = $(this).data('category_id');
        var brand_id = $(this).data('brand_id');
        var create_at = $(this).data('create_at');

        $('#update_id').val(id);
        $('#update_Products_id').val(product_id);
        $('#update_Products_name').val(product_name);
        $('#update_Products_title').val(title_detail);
        $('#update_Products_price').val(price);
        $('#update_Products_category_name').val(category_id);   
        $('#update_Products_brand').val(brand_id);
        $('#update_Products_Date_Create').val(create_at);
        $('#Update_Image_file_path').val(image ? "Have Image" : "");
        if(document.querySelector("#Update_Image_file_path").value !== ""){
            document.querySelector("#Update_file_path").style.backgroundImage = "url(./image/" + image + ")";
            $('#Update_Image_file').val("./image/" + image);
        } else {
            document.querySelector("#Update_file_path").style.backgroundImage = "none";
        }
    });

    // Update product
    $('#UpdateBtn').off('click').on('click', function(){
        let formData = new FormData($("#UpdateForm")[0]);
        formData.append("type", "UpdateProduct");
        $.ajax({
            url: 'UpdateProduct.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                if(response.trim() === "success"){
                    Swal.fire("Product updated successfully!", "", "success").then(() => location.reload());
                } else {
                    Swal.fire("Error!", response, "error");
                }
            },
            error: function(xhr, status, error){
                Swal.fire("Error!", "Failed to update data: " + error, "error");
            }
        });
    });


});
</script>
</body>
</html>