<?php 
    include("../../Config/connect.php")
?>
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <table id="BrandTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropBrand">Add</button>
                </th>
                <th>ID</th>
                <th>Brand ID</th>
                <th>Brand Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php 
                $sql = "SELECT * FROM brand";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#UpDate" class="btn btn-primary editBtn" 
                            data-id="<?php echo $row["id"]; ?>" 
                            data-Brand_id="<?php echo $row['brand_id']; ?>" 
                            data-Brand_name="<?php echo $row['name_brand']; ?>" 
                            data-Description="<?php echo $row['Description']; ?>"
                        >Edit</button>
                        <button class="btn btn-danger deleteBtn" data-id="<?php echo $row["id"]; ?>">Delete</button>
                    </td>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row['brand_id']; ?></td>
                    <td><?php echo ($row['name_brand']); ?></td>
                    <td>
                        <div style="width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php echo ($row['Description']); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add Data -->
<div class="modal fade" id="staticBackdropBrand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD BRAND</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data" id="myForm">
            <div class="mb-3">
                <label class="form-label">Brand ID</label>
                <input type="text" class="form-control" id="brand_id" name="brand_id">
            </div>
            <div class="mb-3">
                <label class="form-label">Brand Name</label>
                <input type="text" class="form-control" id="name_brand" name="name_brand">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="Description" name="Description">
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

<!-- Update Brand Modal -->
<div class="modal fade" id="UpDate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">UPDATE BRAND</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="idEdit" name="idEdit">
            <div class="mb-3">
                <label class="form-label">Brand ID</label>
                <input type="text" class="form-control" id="brand_id_up" name="brand_id_up">
            </div>
            <div class="mb-3">
                <label class="form-label">Brand Name</label>
                <input type="text" class="form-control" id="name_brand_up" name="name_brand_up">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="description_brand_up" name="description_brand_up">
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

<?php include("../../root/DataTable.php") ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    // table for bootstrap data table
    var table = $('#BrandTable').DataTable({
        lengthMenu: [5, 10, 25, 50],
        pageLength: 10,
        order: [[1, 'asc']],
        columnDefs: [{ targets: 0, orderable: false, searchable: false }]
    });

    // Add category
    $('#SaveBtn').off('click').on('click', function(){
        $.ajax({
            url: 'AddBrand.php',
            type: 'POST',
            data: {
                type: 'addBrand',
                brand_id: $('#brand_id').val(),
                name_brand: $('#name_brand').val(),
                Description: $('#Description').val(),
            },
            success: function(response){
                Swal.fire("Brand added successfully!", "", "success").then(() => location.reload());
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
                    url: 'Delete.php',
                    type: 'POST',
                    data: { type: 'DeleteBrand', id: id },
                    success: function(response){
                        Swal.fire("Deleted!", "Brand has been deleted.", "success").then(() => location.reload());
                    },
                    error: function(xhr, status, error){
                        Swal.fire("Error!", "Failed to delete: " + error, "error");
                    }
                });
            }
        });
    });

    // Edit category (populate modal)
    $(document).on("click", ".editBtn", function(){
        var btn = $(this);
        $('#idEdit').val(btn.data('id'));
        $('#brand_id_up').val(btn.data('brand_id'));
        $('#name_brand_up').val(btn.data('brand_name'));
        $('#description_brand_up').val(btn.data('description'));
    });

    // Prevent duplicate clicks
    $(document).on('click', '#UpdateBtn', function(){
    
        $.ajax({
            url: 'update.php',
            type: 'POST',
            data: { 
                type: 'UpdateBrand',
                idEdit: $('#idEdit').val(),
                brand_id_up: $('#brand_id_up').val(),
                name_brand_up: $('#name_brand_up').val(),
                description_brand_up: $('#description_brand_up').val()
            },
            success: function(response){
                Swal.fire("Updated!", "Brand has been updated.", "success").then(() => location.reload());
            },
            error: function(xhr, status, error){
                Swal.fire("Error!", "Failed to update: " + error, "error");
            }
        });
    });
});
</script>
