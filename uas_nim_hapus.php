<?php

$database_hostname = "localhost";
$database_username = "root";
$database_password = "";
$database_name = "uas";

$koneksi = mysqli_connect($database_hostname, $database_username, $database_password, $database_name);

if (!mysqli_connect_errno()) {
  echo "<script>console.log('Koneksi Database Berhasil');</script>";
} else {
  echo "<script>console.log('Koneksi Database Gagal');</script>";
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");

if ($query) {
  echo "<script>alert('Data Berhasil Dihapus');</script>";
} else {
  echo "<script>alert('Data Gagal Dihapus');</script>";
}

echo "<script>location.href='uas_nim.php';</script>";
