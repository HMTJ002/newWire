<?php
session_start();
include "..\utils\database.php";


if (isset($_GET['action']) && $_GET['action'] == "logout") {
    session_destroy();
   header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

        if (isset($_FILES['image'])) {
            $image = $_FILES['image'];
            $imageName = $image['name'];
            $imageTmpName = $image['tmp_name'];
            $imageError = $image['error'];
            $imageType = $image['type'];
    
            if ($imageError === 0) {
                $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
                $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
    
                if (in_array(strtolower($imageExt), $allowedExt)) {
                    $newImageName = uniqid('', true) . '.' . $imageExt;
                    $uploadDir = '../static/images/uploads/';  

                    if (move_uploaded_file($imageTmpName, $uploadDir . $newImageName)) {

                        $sql = "INSERT INTO news (category, title, summury, content, image) VALUES ('$category', '$title', '$summary', '$content', '$newImageName')";
                        if ($conn->query($sql) === TRUE) {
                            header("Location: dashboard.php?message=News added successfully");
                            exit();
                        } else {
                            header("Location: dashboard.php?message=Error storing image in database: {$conn->erro}r");
                            exit();
                        }
                    } else {
                        header("Location: dashboard.php?message=Failed to upload the image.");
                        exit();
                    }
                } else {
                    header("Location: dashboard.php?message=Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed");
                    exit();
                }
            } else {
                header("Location: dashboard.php?message=Error uploading the image.");
                exit();
            }
        }
    }
    echo "hello2";

}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM news WHERE id=$id");
    header("Location: dashboard.php?message=Record Deleted");
    exit();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../static/images/uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $conn->query("UPDATE news SET category='$category', title='$title', summury='$summary', content='$content', image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE news SET category='$category', title='$title', summury='$summary', content='$content' WHERE id=$id");
    }

    header("Location: dashboard.php?message=News updated successfully");
    exit();
}
?>