<?php
$servername = "localhost";
$username = "root";
$password = "root@1234";
$dbname = "news_wire_db.mwb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reaction = $_POST['reaction'];
    $sql = "INSERT INTO reactions (reaction_type) VALUES ('$reaction')";
    if ($conn->query($sql) === TRUE) {
        echo "Reaction recorded successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reactionType = $_POST['reaction_type'];
    $newsCategory = $_POST['news_category'];
    
    $query = "INSERT INTO reactions (reaction_type, news_category) VALUES ('$reactionType', '$newsCategory')";
    mysqli_query($conn, $query);
}
?>
