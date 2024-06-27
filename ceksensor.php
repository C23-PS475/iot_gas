<?php 

$konek = mysqli_connect("localhost", "root", "", "iot_gas");
$sql = mysqli_query($konek, "SELECT * FROM sensor ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($sql);
$mq4 = $data["ppm_mq4"];
$mq7 = $data["ppm_mq7"];
$mq136 = $data["ppm_mq136"];
$mq135 = $data["ppm_mq135"];
$tinggiair = $data["tinggiair"];
$status = $data["status"];

// Tambahkan logika untuk mengubah status menjadi teks dengan warna yang sesuai
if ($status == 1) {
    $statusText = '<span class="status-badge status-on">ON</span>';
} else {
    $statusText = '<span class="status-badge status-off">OFF</span>';
}

echo '<span id="ppm_mq4">' . $mq4 . '</span>';
echo '<span id="ppm_mq7">' . $mq7 . '</span>';
echo '<span id="ppm_mq136">' . $mq136 . '</span>';
echo '<span id="ppm_mq135">' . $mq135 . '</span>';
echo '<span id="tinggiair">' . $tinggiair . '</span>';
echo '<span id="status">' . $statusText . '</span>';
?>
