<?php 
    include("../../Config/connect.php")
?>
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <table id="CategoryTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th style="width: 150px">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
                </th>
                <th>ID</th>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php 
                $sql = "SELECT * FROM category";
                $result = $con->query($sql);
                while($row = $result->fetch_assoc()){
            ?>
                <tr>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#UpDate" class="btn btn-primary editBtn" 
                                data-name="<?php echo htmlspecialchars($row['name_category']); ?>" 
                                data-title="<?php echo htmlspecialchars($row['title_catagory']); ?>" 
                                data-status="<?php echo htmlspecialchars($row['status']); ?>" 
                                data-cateid="<?php echo $row['catagory_id']; ?>"
                                data-id="<?php echo $row["id"]; ?>">Edit</button>
                        <button class="btn btn-danger deleteBtn" data-id="<?php echo $row["id"]; ?>">Delete</button>
                    </td>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row['catagory_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name_category']); ?></td>
                    <td><?php echo htmlspecialchars($row['title_catagory']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add Data -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD CATEGORY</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data" id="myForm">
            <div class="mb-3">
                <label class="form-label">Category ID</label>
                <input type="text" class="form-control" id="catagory_id" name="catagory_id">
            </div>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name_category" name="name_category">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="title_catagory" name="title_catagory">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status">
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


<!-- Update Category Modal -->
<div class="modal fade" id="UpDate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">UPDATE CATEGORY</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="idEdit" name="idEdit">
            <div class="mb-3">
                <label class="form-label">Category ID</label>
                <input type="text" class="form-control" id="catagory_id_up" name="catagory_id_up">
            </div>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name_category_up" name="name_category_up">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" id="title_catagory_up" name="title_catagory_up">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" class="form-control" id="status_up" name="status_up">
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
    var table = $('#CategoryTable').DataTable({
        lengthMenu: [5, 10, 25, 50],
        pageLength: 10,
        order: [[1, 'asc']],
        columnDefs: [{ targets: 0, orderable: false, searchable: false }]
    });

    // Add category
    $('#SaveBtn').off('click').on('click', function(){
        $.ajax({
            url: 'AddCategory.php',
            type: 'POST',
            data: {
                type: 'addCategory',
                catagory_id: $('#catagory_id').val(),
                name_category: $('#name_category').val(),
                title_catagory: $('#title_catagory').val(),
                status: $('#status').val()
            },
            success: function(response){
                Swal.fire("Category added successfully!", "", "success").then(() => location.reload());
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
                    data: { type: 'DeleteCate', id: id },
                    success: function(response){
                        Swal.fire("Deleted!", "Category has been deleted.", "success").then(() => location.reload());
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
        $('#catagory_id_up').val(btn.data('cateid'));
        $('#name_category_up').val(btn.data('name'));
        $('#title_catagory_up').val(btn.data('title'));
        $('#status_up').val(btn.data('status'));
    });

    // Prevent duplicate clicks
    $(document).on('click', '#UpdateBtn', function(){
            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: { 
                    type: 'Update',
                    idEdit: $('#idEdit').val(),
                    catagory_id_up: $('#catagory_id_up').val(),
                    name_category_up: $('#name_category_up').val(),
                    title_catagory_up: $('#title_catagory_up').val(),
                    status_up: $('#status_up').val()
                },
                success: function(response){
                    Swal.fire("Updated!", "Category has been updated.", "success").then(() => location.reload());
                },
                error: function(xhr, status, error){
                    Swal.fire("Error!", "Failed to update: " + error, "error");
                }
            });
            
        });
});
</script>
