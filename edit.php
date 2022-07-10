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


/* Mengedit data ke dalam database */

if(isset($_GET['kode'])){
$idcek = $_GET['kode'];
$sqlget = mysqli_query($koneksi,"select * from produktb where id ='$idcek'");
$data = mysqli_fetch_array($sqlget);
$nama = $data['nama'];
$deskripsi = $data['deskripsi'];
$harga = $data['harga'];
}else{
  $nama = "";
  $deskripsi = "";
   $harga = "";
}




/* Update data ke dalam database */
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if($nama && $deskripsi && $harga){
        $sql1 = "update produktb set nama = '$nama',deskripsi = '$deskripsi',harga = '$harga' where id = '$idcek'";
        $q1 = mysqli_query($koneksi, $sql1);

        if($q1){
          header("Location: index.php");
        }else{
            $error ="Gagal mengedit data";
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

<!-- Untuk Memasukan Data -->

<!-- Class Card Start -->
<div class="card">
  <div class="card-header">
    Edit Data Produk
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

<a href="index.php"><button type="button" class="btn btn-danger">Batal</button></a>


    </form>
<!--Form End-->

  </div>
<!-- Class Card Body End -->

</div>
<!-- Class Card End -->





</div>
<!--Container End-->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>