
<?php

include("./root/Header.php");
include("./Config/connect.php");
session_start();

//Login user
if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password']; // use raw password

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
            // check for password that compare with password password_hash 
        if($email  == "admin@gmail.com" && $password == "admin"){
            $_SESSION['successAdmin'] = 'login successful';

        }
        elseif (condition) {
            # code...
        }if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id']; // optional
            sleep(0.5);
            header('Location: login.php');
            $_SESSION['success'] = 'login successful';
            $_POST["email"] = "";
            $_POST["password"] = "";
            exit;
        } else {
            $_SESSION['error'] = 'Incorrect password!';
            header('Location: login.php');
            exit;
        }
    }

    

}


//Register
if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date = $_POST['date'] ?: NULL; // allow null
    $createDate = date('Y-m-d H:i:s');
    $status = 'active';

    $checkSql = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    
    if($checkResult->num_rows > 0){
        $_SESSION['errorRegister'] = 'Email already exists!';
        header('Location: register.php');
        exit;
    }

    $sql = "INSERT INTO users (id, email, username, password, create_at, deleted_at, status) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssss", $email, $username, $password, $date, $createDate, $status);
    $result = $stmt->get_result();

    if($stmt->execute()){
        $_SESSION['successRegister'] = 'Registration successful. Please log in.';
        // $_POST[""]
        exit;
    } else {
        $_SESSION['errorRegister'] = 'Registration failed. Please try again.';
        header('Location: register.php');
        exit;
    }
}
?>
