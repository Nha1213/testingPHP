<?php 
    include("../../Config/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="styleproduct.css">
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
                <th>Category ID</th>
                <th>Type</th>
                <th>Date Create</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php 
                $sql = "SELECT * FROM products";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#UpDate" class="btn btn-primary editBtn">Edit</button>
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
                    <td><?php echo $row['cate_id']; ?></td>
                    <td><?php echo $row['product_type']; ?></td>
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
                    <label class="form-label">Category ID</label>
                    <input type="text" class="form-control" id="Products_category_id" name="Products_category_id">
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Product Type</label>
                    <input type="text" class="form-control" id="Products_type" name="Products_type">
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
});
</script>
</body>
</html>