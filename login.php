<?php  
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <?php include("root/Header.php"); // Make sure Header.php loads Bootstrap CSS ?>
  <style>
    .background {
        background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="background">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4 text-primary">Login</h2>

      <?php
      // Display error or success messages
      if (isset($_SESSION['error'])) {
          $error = $_SESSION['error'];
          unset($_SESSION['error']);
          echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Please try again!',
                text: 'Email or Password Failed. Please login again',
                timer: 2000,
                showConfirmButton: false
            });
          </script>";
      }

      if (isset($_SESSION['success'])) {
          $success = $_SESSION['success'];
          unset($_SESSION['success']);
          echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'login successful',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = './View/index.php';
            });
          </script>";
      }

      if(isset($_SESSION["successAdmin"])){
        $successAdmin = $_SESSION["successAdmin"];
        unset($_SESSION["successAdmin"]);
        echo"<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'login successful',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'index.php';
            });
          </script>";
      }

      ?>

      <form action="Loginaction.php" method="post" enctype="multipart/form-data">
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100" name="login">Login</button>

        <!-- Optional links -->
        <p class="text-center mt-3 mb-0 d-flex justify-content-between align-items-center">
          <a href="register.php" class="text-decoration-none">Create an account</a>
          <a href="#" class="text-decoration-none">Forgot your password?</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
