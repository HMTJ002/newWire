<?php
include "..\utils\database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="..\static\css\admin_dashboard_css.css">
</head>
<body>

<header>
    <h1>News Dashboard</h1>
    <nav>
        <a href="dashboard.php">Home</a>
        <a href="dashboard_action.php?action=logout">Logout</a>
    </nav>
</header>

<main>
    <h2>Add News</h2>
    <?php
        if(isset($_GET['message'])){
            $msg = $_GET['message'];
            echo "<script>alert('$msg')</script>";
        }
        
    ?>
    </select>
    
    
    <form action="dashboard_action.php" method="POST" enctype="multipart/form-data">
        <lable for="category">Choose a category</lable>
        <select name="category" id="category">
            <option value="local news">Local News</option>
            <option value="international news">International News</option>
            <option value="sports">Sports</option>
            <option value="weather">Weather</option>
        </select>

        <label for="image">Choose an image to upload:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <input type="text" name="title" placeholder="News Title" required>
        <input type="text" name="summary" placeholder="Summury" required>
        <textarea name="content" placeholder="News Content" required></textarea>
        
        <button type="submit" name="submit">Add News</button>
    </form>

    <h2>View News</h2>
    <table border="1">
    <tr><th>Category</th><th>Title</th><th>Summary</th><th>Content</th><th>Image</th><th>Action</th></tr>
    <?php
   
    $result = $conn->query("SELECT * FROM news");

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['category']}</td>
                <td>{$row['title']}</td>
                <td>{$row['summury']}</td>
                <td>{$row['content']}</td>
                <td><img src='..\static\images\uploads/{$row['image']}' alt='Image' width='100'></td>
                <td>
                 <a href='dashboard.php?edit={$row['id']}'>Edit</a> | 
                <a href='dashboard_action.php?delete={$row['id']}'>Delete</a></td>
              </tr>";
    }
    $conn->close();
    ?>
</table>
<?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $res = $conn->query("SELECT * FROM news WHERE id=$id");
        $news = $res->fetch_assoc();
    ?>
    <h2>Update News</h2>
    <form action="dashboard_action.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>">

        <label for="category">Category:</label>
        <select name="category">
            <option value="local news" <?php if ($news['category'] == 'local news') echo 'selected'; ?>>Local News</option>
            <option value="international news" <?php if ($news['category'] == 'international news') echo 'selected'; ?>>International News</option>
            <option value="sports" <?php if ($news['category'] == 'sports') echo 'selected'; ?>>Sports</option>
            <option value="weather" <?php if ($news['category'] == 'weather') echo 'selected'; ?>>Weather</option>
        </select>

        <input type="text" name="title" value="<?php echo $news['title']; ?>" required>
        <input type="text" name="summary" value="<?php echo $news['summury']; ?>" required>
        <textarea name="content" required><?php echo $news['content']; ?></textarea>
        
        <label>Current Image:</label>
        <img src="../static/images/uploads/<?php echo $news['image']; ?>" width="100"><br>
        <label for="image">Change Image:</label>
        <input type="file" name="image">

        <button type="submit" name="update">Update News</button>
    </form>
    <?php } ?>
</main>

</body>
</html>