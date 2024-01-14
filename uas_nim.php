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


if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%$search%'");
} else {
  $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}

if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $nim = $_POST['nim'];
  $email = $_POST['email'];
  $prodi = $_POST['prodi'];

  $query = mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES ('','$nama','$nim','$email','$prodi')");

  if ($query) {
    echo "<script>alert('Data Berhasil Ditambahkan');</script>";
  } else {
    echo "<script>alert('Data Gagal Ditambahkan');</script>";
  }

  echo "<script>location.href='uas_nim.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <h1>Daftar Mahasiswa</h1>
  <br>
  <form method="POST">
    <table>
      <tr>
        <td><label for="nama">Nama</label></td>
        <td><input type="text" name="nama" id="nama" required></td>
      </tr>
      <tr>
        <td><label for="nim">Nim</label></td>
        <td><input type="text" name="nim" id="nim" required></td>
      </tr>
      <tr>
        <td><label for="email">Email</label></td>
        <td>
          <input type="email" name="email" id="email" required>
        </td>
      </tr>
      <tr>
        <td><label for="prodi">Jurusan</label></td>
        <td>
          <select name="prodi" id="prodi" style="width: 100%;" required>
            <option value disabled selected>Pilih Jurusan</option>
            <option value="Informatika">Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknologi Informasi">Teknologi Informasi</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="submit" value="Tambah Data" style="width: 100%;"></td>
      </tr>
    </table>
  </form>
  <br>
  <form method="GET" action="uas_nim.php">
    <table>
      <tr>
        <td><label for="search">Cari Mahasiswa</label></td>
        <td><input type="text" name="search" id="search" placeholder="Masukkan Nama Mahasiswa"></td>
        <td><input type="submit"></td>
        <?php
        if (isset($_GET['search'])) {
          echo "<td><a href='uas_nim.php'>Reset</a></td>";
        }
        ?>
      </tr>
    </table>
  </form>
  <br>
  <table border="1">
    <tr>
      <td>No</td>
      <td>Nama</td>
      <td>Nim</td>
      <td>Email</td>
      <td>Jurusan</td>
      <td>Aksi</td>
    </tr>
    <?php
    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['nim']; ?></td>
        <td><?php echo $data['email']; ?></td>
        <td><?php echo $data['prodi']; ?></td>
        <td>
          <a href="uas_nim_edit.php?id=<?php echo $data['id']; ?>">Edit</a>
          <a href="uas_nim_hapus.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ?')">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>