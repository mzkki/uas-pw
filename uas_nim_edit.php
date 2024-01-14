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
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $nim = $_POST['nim'];
  $email = $_POST['email'];
  $prodi = $_POST['prodi'];

  $query = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', nim='$nim', email='$email', prodi='$prodi' WHERE id='$id'");

  if ($query) {
    echo "<script>alert('Data Berhasil Diubah');</script>";
  } else {
    echo "<script>alert('Data Gagal Diubah');</script>";
  }

  echo "<script>location.href='uas_nim.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Mahasiswa</title>
</head>

<body>
  <h1>Edit Mahasiswa</h1>
  <br>
  <form method="POST">
    <table>
      <tr>
        <td><label for="nama">Nama</label></td>
        <td><input type="text" name="nama" id="nama" required value="<?php echo $data['nama'] ?>"></td>
      </tr>
      <tr>
        <td><label for="nim">NIM</label></td>
        <td><input type="text" name="nim" id="nim" value="<?php echo $data['nim'] ?>" required></td>
      </tr>
      <tr>
        <td><label for="email">Email</label></td>
        <td><input type="email" name="email" id="email" value="<?php echo $data['email'] ?>" required></td>
      </tr>
      <tr>
        <td><label for="prodi">Prodi</label></td>
        <td><input type="text" name="prodi" id="prodi" value="<?php echo $data['prodi'] ?>" required></td>
      </tr>
      <tr>
        <td colspan="2"><input style="width:100%" type="submit" name="submit" value="Edit Data"></td>
      </tr>
    </table>
  </form>
</body>

</html>