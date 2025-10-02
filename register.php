<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <?php 
    include("root/Header.php"); // Make sure Header.php loads Bootstrap CSS
  ?>
  <style>
    .background {
        background: radial-gradient(circle,rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
    }
  </style>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="background">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4 text-primary">Register</h2>

      <?php

      // Display error or success messages
      if (isset($_SESSION['errorRegister'])) {
          $error = $_SESSION['errorRegister'];
          unset($_SESSION['errorRegister']);
          echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Exsist!',
                text: 'Register failed. Please try again.',
                timer: 1500,
                showConfirmButton: false
            });
          </script>"; 
      } 
      if (isset($_SESSION['successRegister'])) {
          $success = $_SESSION['successRegister'];
          unset($_SESSION['successRegister']);
          echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Register successful. Please log in.',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'login.php';
            });
          </script>";
      }
      ?>

      <form action="Loginaction.php" method="post" enctype="multipart/form-data">
        
        <!-- email -->
        <div class="mb-3">
          <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
        </div>

        <!-- username -->
        <div class="mb-3">
          <label for="username" class="form-label fw-semibold">username <span class="text-danger">*</span></label>
          <input type="username" class="form-control" id="username" name="username" required placeholder="Enter your username">
        </div>

        
        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>

        <div class="mb-3">
          <label for="date" class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control" id="date" name="date" required placeholder="Enter your password">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
        
        <!-- Optional link -->
        <p class="text-center mt-3 mb-0 d-flex justify-content-between align-items-center">
          <a href="<?php  echo "login.php"?>" class="text-decoration-none">Already registered</a>
          <a href="#" class="text-decoration-none">Forgot password?</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>