<?php
session_start();
include '../utils/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already exists!'); window.location.href='login.html';</script>";
        } else {
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

            if ($stmt->execute()) {
                echo "<script>alert('Registration Successful! Please login.'); window.location.href='login.html';</script>";
            } else {
                echo "<script>alert('Error: Unable to register.'); window.location.href='login.html';</script>";
            }
        }
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if ($password == $user['password']) {
                $_SESSION['user'] = $user['email'];
                echo "<script>alert('Login Successful!'); window.location.href='../../index.php';</script>";
            } else {
                echo "<script>alert('Incorrect Password'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('User Not Found'); window.location.href='login.html';</script>";
        }
    }
}
?>
