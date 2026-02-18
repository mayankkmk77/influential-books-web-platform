<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Influential Books</title>
<style>
body {
  font-family: sans-serif;
  margin: 0;
  background: #f8f9fa;
  color: #333;
}
header, footer {
  background: #002244;
  color: #fff;
  text-align: center;
  padding: 15px 0;
}
header img {
  width: 80px;
  height: 80px;
  object-fit: contain;
  margin-bottom: 8px;
}
nav a {
  color: #fff;
  text-decoration: none;
  margin: 0 10px;
  font-weight: 500;
}
nav a:hover {
  text-decoration: underline;
}
.hero {
  text-align: center;
  padding: 70px 20px;
  background: #eef3ff;
}
.btn {
  background: #002244;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  margin: 5px;
}
.btn:hover {
  opacity: 0.9;
}
.books {
  width: 90%;
  max-width: 1000px;
  margin: 30px auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
}
.book {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.book h3 {
  margin: 0;
  color: #002244;
}
.meta {
  font-size: 0.9rem;
  color: #666;
  margin-bottom: 8px;
}
.country {
  background: #002244;
  color: #fff;
  padding: 2px 6px;
  border-radius: 3px;
  font-size: 0.8rem;
}
</style>
</head>
<body>

<header>
  <!-- ✅ Added Book Image -->
  <img src="https://cdn-icons-png.flaticon.com/512/29/29302.png" alt="Book Icon">
  <h2>📚 Influential Books</h2>
  <nav>
    <a href="index.php">Home</a>
    <?php if(isset($_SESSION['user_id'])): ?>
      <a href="books.php">Books</a>
      <a href="logout.php">Logout (<?= $_SESSION['username'] ?>)</a>
    <?php else: ?>
      <a href="login.php">Login</a>
      <a href="signup.php">Sign Up</a>
    <?php endif; ?>
    <a href="admin.php">Admin</a>
  </nav>
</header>

<div class="hero">
  <?php if(!isset($_SESSION['user_id'])): ?>
    <h1>Welcome to Influential Books</h1>
    <p>Discover the world’s most inspiring and influential books.</p>
    <a href="signup.php"><button class="btn">Sign Up</button></a>
    <a href="login.php"><button class="btn">Login</button></a>
  <?php else: ?>
    <h1>Hello, <?= $_SESSION['username'] ?> 👋</h1>
    <p>Explore top influential books below.</p>
  <?php endif; ?>
</div>

<?php if(isset($_SESSION['user_id'])): ?>
<div class="books">
  <?php
  $res = mysqli_query($con, "SELECT * FROM books ORDER BY id DESC LIMIT 3");
  while($r = mysqli_fetch_assoc($res)){
    echo "<div class='book'>
      <h3>{$r['title']}</h3>
      <div class='meta'>By {$r['author']} • {$r['year']} • <span class='country'>{$r['country']}</span></div>
      <p>".substr($r['description'],0,100)."...</p>
      <p><b>Readers:</b> {$r['readers']} million</p>
      <a href='books.php'><button class='btn'>View</button></a>
    </div>";
  }
  ?>
</div>
<?php endif; ?>

<footer>© 2025 Influential Books</footer>
</body>
</html>
