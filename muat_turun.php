<?php
$conn = new mysqli("localhost", "root", "", "projek_akhir");

header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=tajuk_projek.csv");

$output = fopen("php://output", "w");
fputcsv($output, ["Bil", "Tajuk", "Tarikh Ditambah"]);

$result = $conn->query("SELECT * FROM tajuk ORDER BY id ASC");
$i = 1;
while ($row = $result->fetch_assoc()) {
  fputcsv($output, [$i++, $row["nama_tajuk"], $row["tarikh_ditambah"]]);
}
fclose($output);
exit();
