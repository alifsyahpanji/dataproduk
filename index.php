<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "produkdb";

$koneksi    = mysqli_connect($host,$user,$pass,$db);

/* Cek Koneksi Database */

if(!$koneksi){ 
    die("Tidak Bisa Terkoneksi ke Database");
}

/* Membuat Variabel Data Kosong Agar Tidak Muncul Error */

$id = "";
$nama = "";
$deskripsi = "";
$harga = "";
$error = "";
$sukses = "";


/* Menghapus Data */
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql1 = "delete from produktb where id = '$id'";
  $q1 = mysqli_query($koneksi, $sql1);

  if($q1){
    header("Location: index.php");
  }else{
    $error = "Gagal menghapus data";
  }

}



/* Memasukan data ke dalam database */
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if($nama && $deskripsi && $harga){
        $sql1 = "insert into produktb (nama,deskripsi,harga) values ('$nama', '$deskripsi', '$harga')";
        $q1 = mysqli_query($koneksi, $sql1);

        if($q1){
          header("Location: index.php");
        }else{
            $error ="Gagal memasukan data";
        }
    }else{
        $error = "Silahkan masukan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alifsyah Panji</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <style>

        body {
        background-image: linear-gradient(to bottom right, yellow, purple);
        background-repeat: no-repeat;
        background-attachment: fixed;
        }
        .card {
            margin-top: 10px;
            margin-bottom: 10px;
            color: white;
        }

        .card-header {
             background-color: purple;
            
        }

        .form-label {
            color: black;
        }
    </style>
</head>
<body>

<!--Container Start-->
<div class="container-fluid">

<!-- Untuk Memasukan Data Form -->

<!-- Class Card Start-->
<div class="card">
  <div class="card-header">
    Memasukan Data Baru
  </div>

<!-- Class Card Body Start -->
  <div class="card-body">

<!-- Pesan Error-->
      <?php
      if($error){
          ?>
        <div class="alert alert-danger" role="alert">
       <?php echo $error ?>
      </div>

      <?php
          
      }
      ?>



  <!--Form Start-->
    <form action="" method="POST">
    <div class="mb-3">
  <label for="nama" class="form-label">Nama Produk:</label>
  <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
</div>

<div class="mb-3">
  <label for="deskripsi" class="form-label">Deskripsi:</label>
  <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi ?>">
</div>

<div class="mb-3">
  <label for="harga" class="form-label">Harga:</label>
  <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
</div>

<button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>


    </form>
<!--Form End-->

  </div>
<!-- Class Card Body End -->

</div>
<!-- Calss Card End -->

<!-- Untuk Mengeluarkan Data -->

<!-- Class Card Start -->
<div class="card">
  <div class="card-header">
    Data Produk
  </div>

<!-- Class Card Body Start -->
  <div class="card-body">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>

  <tbody>
  <?php
    $sql2 = "select * from produktb order by id desc";
    $q2 = mysqli_query($koneksi,$sql2);

    while($r2 = mysqli_fetch_array($q2)){
      $id = $r2['id'];
      $nama = $r2['nama'];
      $harga = $r2['harga'];
      $deskripsi = $r2['deskripsi'];

      ?>
    <tr>
      <td><?php echo $nama ?></td>
      <td><?php echo $harga ?></td>
      <td><?php echo $deskripsi ?></td>
      <td>
        <a href="edit.php?kode=<?php echo $id ?>">
      <button type="button" class="btn btn-warning">Edit</button></a>

      <a href="index.php?delete=<?php echo $id ?>" onclick="return confirm('Yakin ingin menghapus data ?')">
      <button type="button" class="btn btn-danger">Delete</button></a>
    </td>
    </tr>
    
    <?php

    }

    ?>
      
      


    </tbody>


    </table>

  </div>
  <!-- Class Card Body End -->

</div>
<!-- Class Card End -->




</div>
<!--Container End-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>