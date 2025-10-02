<!DOCTYPE html>
<html>

<head>
    <?php
    include("Header.php");
    ?>
    <!-- Google Fonts - Professional font combination -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Noto+Sans+Khmer:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./Style/sidemen.css">
</head>

<body>
    <div class="menu">
        <div class="menu-search">
            <input type="text" placeholder="Search menu..." class="form-control">
        </div>
        <ul class="list-unstyled components">
           <li>
                    <a href="../Dashboard/indnex.php" target="content">
                        <i class="fa fa-home"></i>Dasborad
                    </a>
                </li>

                <!-- Master Set up -->
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cog"></i><span lang="km">Type Of Category</span>
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="../Dashboard/Category/index.php" target="content">Category</a>
                        </li>
                        <li>
                            <a href="../Dashboard/Brand/index.php" target="content">Brand</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#product" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cog"></i><span lang="km">Type Of Products</span>
                    </a>
                    <ul class="collapse list-unstyled" id="product">
                        <li>
                            <a href="../Dashboard/Products/index.php" target="content">Products</a>
                        </li>
                        <li>
                            <a href="../Dashboard/ViewProductsBrand/index.php" target="content">View Products Brand</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#stock" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-cog"></i><span lang="km">Type Of Stock</span>
                    </a>
                    <ul class="collapse list-unstyled" id="stock">
                        <li>
                            <a href="../Dashboard/Stock/index.php" target="content">Stock</a>
                        </li>
                        <li>
                            <a href="../Dashboard/OrderStock/index.php" target="content">Order Stock</a>
                        </li>
                    </ul>
                </li>


        </ul>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>