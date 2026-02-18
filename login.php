<?php
session_start();
include 'db_connect.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = mysqli_real_escape_string($con, $_POST['username']);
    $p = mysqli_real_escape_string($con, $_POST['password']);
    $res = mysqli_query($con, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($res) == 1) {
        $r = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $r['id'];
        $_SESSION['username'] = $r['username'];
        header("Location: index.php");
        exit;
    } else $msg = "❌ Invalid username or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Login</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: Poppins, sans-serif;
  background: linear-gradient(120deg, #dbeafe, #fff);
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}
.container {
  background: #fff;
  padding: 35px;
  border-radius: 12px;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 350px;
  text-align: center;
}
h2 {
  color: #1e3a8a;
  margin-bottom: 20px;
}
input, button {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border-radius: 8px;
  border: 1px solid #ddd;
  outline: none;
}
input:focus {
  border-color: #1e3a8a;
}
button {
  background: linear-gradient(90deg, #1e3a8a, #1d4ed8);
  color: #fff;
  font-weight: 600;
  border: none;
  cursor: pointer;
}
button:hover {
  opacity: .9;
}
a {
  color: #1e3a8a;
  text-decoration: none;
}
.message {
  color: #1d4ed8;
}
</style>
</head>
<body>
<div class="container">
<h2>Login 🔑</h2>
<?php if($msg) echo "<p class='message'>$msg</p>"; ?>
<form method="POST">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="signup.php">Sign up</a></p>
<p><a href="index.php">← Home</a></p>
</div>
</body>
</html>
