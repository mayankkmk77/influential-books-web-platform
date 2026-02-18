<?php
include 'db_connect.php';
$msg = "";


if (isset($_POST['add'])) {
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $author = mysqli_real_escape_string($con, $_POST['author']);
  $year = mysqli_real_escape_string($con, $_POST['year']);
  $country = mysqli_real_escape_string($con, $_POST['country']);
  $desc = mysqli_real_escape_string($con, $_POST['description']);
  $image = mysqli_real_escape_string($con, $_POST['image']);

  $sql = "INSERT INTO books (title, author, year, country, description, image)
          VALUES ('$title', '$author', '$year', '$country', '$desc', '$image')";
  
  if (mysqli_query($con, $sql)) {
    $msg = "✅ Book added successfully!";
  } else {
    $msg = "❌ Error adding book: " . mysqli_error($con);
  }
}


if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $author = mysqli_real_escape_string($con, $_POST['author']);
  $year = mysqli_real_escape_string($con, $_POST['year']);
  $country = mysqli_real_escape_string($con, $_POST['country']);
  $desc = mysqli_real_escape_string($con, $_POST['description']);
  $image = mysqli_real_escape_string($con, $_POST['image']);

  $sql = "UPDATE books SET 
          title='$title', 
          author='$author', 
          year='$year',
          country='$country', 
          description='$desc', 
          image='$image' 
          WHERE id=$id";

  if (mysqli_query($con, $sql)) {
    $msg = "✅ Book updated successfully!";
  } else {
    $msg = "❌ Error updating book: " . mysqli_error($con);
  }
}


if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM books WHERE id=$id";
  if (mysqli_query($con, $sql)) {
    $msg = "🗑️ Book deleted!";
  } else {
    $msg = "❌ Error deleting book: " . mysqli_error($con);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Panel - Books</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;background:#f8fafc;margin:0;}
header{background:linear-gradient(90deg,#1e3a8a,#1d4ed8);color:#fff;padding:15px;text-align:center;}
.container{width:90%;max-width:1000px;margin:40px auto;}
form{background:#fff;padding:20px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,0.1);margin-bottom:30px;}
input,textarea{width:100%;padding:10px;margin:8px 0;border:1px solid #ddd;border-radius:8px;}
button{background:#1e3a8a;color:#fff;border:none;padding:10px 15px;border-radius:6px;cursor:pointer;}
button:hover{opacity:.9;}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden;}
th,td{padding:10px;text-align:left;border-bottom:1px solid #ddd;}
th{background:#1e3a8a;color:white;}
a{color:#1e3a8a;text-decoration:none;}
a:hover{text-decoration:underline;}
.msg{text-align:center;font-weight:600;margin-bottom:15px;color:#1e3a8a;}
img{width:60px;height:80px;object-fit:cover;border-radius:4px;}
</style>
</head>
<body>

<header>📚 Admin Panel - Manage Books</header>

<div class="container">
  <?php if($msg) echo "<p class='msg'>$msg</p>"; ?>

  <form method="POST">
    <h3>Add or Update Book</h3>
    <input type="number" name="id" placeholder="Book ID (for update only)">
    <input type="text" name="title" placeholder="Book Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <input type="text" name="year" placeholder="Year">
    <input type="text" name="country" placeholder="Country">
    <textarea name="description" placeholder="Short Description"></textarea>
    <input type="text" name="image" placeholder="Image URL">
    <button type="submit" name="add">Add Book</button>
    <button type="submit" name="update">Update Book</button>
  </form>

  <h3>📖 All Books</h3>
  <table>
    <tr><th>ID</th><th>Image</th><th>Title</th><th>Author</th><th>Year</th><th>Action</th></tr>
    <?php
    $result = mysqli_query($con, "SELECT * FROM books ORDER BY id DESC");
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='{$row['image']}' alt=''></td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['year']}</td>
                <td>
                  <a href='?delete={$row['id']}' onclick='return confirm(\"Delete this book?\")'>🗑️ Delete</a>
                </td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='6' style='text-align:center;'>No books found.</td></tr>";
    }
    ?>
  </table>
</div>

</body>
</html>
