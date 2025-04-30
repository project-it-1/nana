<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit();
}
$conn = new mysqli("localhost", "root", "", "projek_akhir");

$cari = "";
if (isset($_GET["cari"])) {
  $cari = $conn->real_escape_string($_GET["cari"]);
  $result = $conn->query("SELECT * FROM tajuk WHERE nama_tajuk LIKE '%$cari%' ORDER BY id ASC");
} else {
  $result = $conn->query("SELECT * FROM tajuk ORDER BY id ASC");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tajuk"])) {
  $tajuk = $conn->real_escape_string($_POST["tajuk"]);
  $conn->query("INSERT INTO tajuk (nama_tajuk) VALUES ('$tajuk')");
}

if (isset($_GET["padam"])) {
  $id = (int)$_GET["padam"];
  $conn->query("DELETE FROM tajuk WHERE id=$id");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Senarai Tajuk Projek Akhir</h2>
    <form method="post">
      <input type="text" name="tajuk" placeholder="Masukkan tajuk baru" required>
      <button type="submit">Tambah</button>
    </form>
    <form method="get">
      <input type="text" name="cari" placeholder="Cari tajuk..." value="<?= htmlspecialchars($cari) ?>">
      <button type="submit">Cari</button>
      <a href="dashboard.php"><button type="button">Reset</button></a>
    </form>
    <a href="muat_turun.php"><button>Muat Turun Semua Tajuk (CSV)</button></a>
    <ul>
      <?php $i = 1; while($row = $result->fetch_assoc()): ?>
        <li>
          <?= $i++ ?>. <?= htmlspecialchars($row["nama_tajuk"]) ?>
          <small>(<?= $row["tarikh_ditambah"] ?>)</small>
          <a href="?padam=<?= $row["id"] ?>" onclick="return confirm('Padam tajuk ini?')">[Padam]</a>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>
</body>
</html>
