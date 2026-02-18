<?php
session_start();
include 'db_connect.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = mysqli_real_escape_string($con, $_POST['username']);
    $p = mysqli_real_escape_string($con, $_POST['password']);

    // check if user exists
    $check = mysqli_query($con, "SELECT * FROM users WHERE username='$u'");
    if (mysqli_num_rows($check) > 0) {
        $msg = "⚠️ Username already exists!";
    } else {
        $sql = "INSERT INTO users(username, password) VALUES('$u','$p')";
        if (mysqli_query($con, $sql)) {
            $msg = "✅ Account created successfully! Please login.";
        } else {
            $msg = "❌ Error: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Sign Up</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body{
  font-family:Poppins,sans-serif;
  background:linear-gradient(120deg,#e6ecff,#fff);
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}
.container{
  background:#fff;
  padding:35px;
  border-radius:12px;
  box-shadow:0 5px 20px rgba(0,0,0,0.1);
  width:90%;
  max-width:350px;
  text-align:center;
}
h2{
  color:#002244;
  margin-bottom:20px;
}
input,button{
  width:100%;
  padding:10px;
  margin:8px 0;
  border-radius:8px;
  border:1px solid #ddd;
  outline:none;
}
input:focus{
  border-color:#002244;
}
button{
  background:#002244;
  color:#fff;
  font-weight:600;
  border:none;
  cursor:pointer;
}
button:hover{
  opacity:.9;
}
a{
  color:#002244;
  text-decoration:none;
}
.message{
  color:#002244;
  font-weight:500;
}
</style>
</head>
<body>
<div class="container">
<h2>Sign Up 📝</h2>
<?php if($msg) echo "<p class='message'>$msg</p>"; ?>
<form method="POST">
  <input type="text" name="username" placeholder="Enter username" required>
  <input type="password" name="password" placeholder="Enter password" required>
  <button type="submit">Create Account</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>
<p><a href="index.php">← Home</a></p>
</div>
</body>
</html>
