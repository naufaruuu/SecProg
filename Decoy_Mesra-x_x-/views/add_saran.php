<?php
session_start();

if (!isset($_SESSION['ID_Siswa'])) {
    header("Location: login.php");
}
include('connection.php');

$catatan_guru = $_POST['catatan_guru'];
$ID_Siswa = $_SESSION['ID_Siswa'];
$ID_guru_query = "SELECT Guru.ID_guru FROM Siswa 
                  JOIN Kelas ON Siswa.ID_Kelas = Kelas.ID_Kelas
                  JOIN Guru ON Kelas.ID_Guru = Guru.ID_Guru
                  WHERE Siswa.ID_Siswa = '$ID_Siswa'";
$result_guru_query = $connection->query($ID_guru_query);
$row_guru = $result_guru_query->fetch_assoc();
$id_guru = $row_guru['ID_guru'];

$query = "INSERT INTO SaranGuru (ID_Siswa, ID_Guru, Saran)
          VALUE ('$ID_Siswa', '$id_guru', '$catatan_guru')";
if ($connection->query($query)) {
  echo "wow";
    header("location: Mapel.php");
} else {
    echo "Data gagal disimpan!";
}

?>
