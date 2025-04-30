<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["username"] === "admin" && $_POST["password"] === "12345") {
    $_SESSION["login"] = true;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Login gagal!";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Login Admin</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Nama Pengguna" required><br>
      <input type="password" name="password" placeholder="Katalaluan" required><br>
      <button type="submit">Log Masuk</button>
    </form>
  </div>
</body>
</html>
