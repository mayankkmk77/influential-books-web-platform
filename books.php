<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Influential Books</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;background:#f8fafc;margin:0;}
header{background:linear-gradient(90deg,#1e3a8a,#1d4ed8);color:#fff;padding:20px;text-align:center;font-size:22px;font-weight:600;}
.container{width:90%;max-width:1100px;margin:30px auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;}
.card{background:#fff;border-radius:12px;box-shadow:0 4px 10px rgba(0,0,0,0.1);padding:15px;text-align:center;}
.card img{width:100%;height:250px;object-fit:cover;border-radius:10px;}
.card h3{color:#1e3a8a;margin:10px 0 5px;}
.card p{color:#333;font-size:14px;margin:5px 0;}
.footer{text-align:center;padding:15px;background:#1e3a8a;color:white;margin-top:30px;}
</style>
</head>
<body>

<header>📚 Influential Books Collection</header>

<div class="container">
<?php
$result = mysqli_query($con, "SELECT * FROM books ORDER BY id DESC");
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <div class='card'>
      <img src='{$row['image']}' alt='Book Cover'>
      <h3>{$row['title']}</h3>
      <p><b>Author:</b> {$row['author']}</p>
      <p><b>Year:</b> {$row['year']}</p>
      <p><b>Country:</b> {$row['country']}</p>
      <p>{$row['description']}</p>
    </div>";
  }
} else {
  echo "<p style='text-align:center;'>No books available. Please add from admin panel.</p>";
}
?>
</div>

<div class="footer">© 2025 Influential Books | Designed by Akshay</div>
</body>
</html>
