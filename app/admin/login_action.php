<?php
session_start();
include '../utils/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin WHERE name = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        
        if($password== $admin['password']) {
            $_SESSION['admin'] = $admin['name'];
          
            header("Location: dashboard.php"); 
          exit();
        } else {
            echo "<script>alert('Incorrect Password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Admin Not Found'); window.location.href='login.html';</script>";
    }
}
?>
