<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
    include("../../root/Header.php");
    ?>
    <link rel="stylesheet" href="../../Style/style.css">
</head>
<body>
        <div class="container-fluid mt-3" style="max-width: 1400px;">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    Category
                </button>
                <!-- <button class="nav-link" id="nav-Dept-tab" data-bs-toggle="tab" data-bs-target="#nav-Dept" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Department</button> -->
                <!-- <button class="nav-link" id="nav-division-tab" data-bs-toggle="tab" data-bs-target="#nav-division" type="button" role="tab" aria-controls="nav-division" aria-selected="false">Division</button>
                <button class="nav-link" id="nav-level-tab" data-bs-toggle="tab" data-bs-target="#nav-level" type="button" role="tab" aria-controls="nav-level" aria-selected="false">Level</button>
                <button class="nav-link" id="nav-position-tab" data-bs-toggle="tab" data-bs-target="#nav-position" type="button" role="tab" aria-controls="nav-position" aria-selected="false">Position</button> -->
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <?php include("pushCategory.php"); ?>
            </div>
            <!-- <div class="tab-pane fade" id="nav-Dept" role="tabpanel" aria-labelledby="nav-Dept-tab">
                 <?php include("TapDepartment.php"); ?> 
            </div>
            <div class="tab-pane fade" id="nav-division" role="tabpanel" aria-labelledby="nav-division-tab">
                 <?php include("TapDivision.php"); ?> 
            </div>
            <div class="tab-pane fade" id="nav-level" role="tabpanel" aria-labelledby="nav-level-tab">
                 <?php include("TapLevel.php"); ?> 
            </div>
            <div class="tab-pane fade" id="nav-position" role="tabpanel" aria-labelledby="nav-position-tab">
                 <?php include("TabPosition.php"); ?>     
            </div> -->
        </div>
    </div>
</body>
</html>