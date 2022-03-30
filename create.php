<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_ikan=input($_POST["nama_ikan"]);
        $nama_ikan_latin=input($_POST["nama_ikan_latin"]);
        $nama_ikan_internasional=input($_POST["nama_ikan_internasional"]);
        $habitat=input($_POST["habitat"]);
        $golongan=input($_POST["golongan"]);
       //Query input menginput data kedalam tabel ikan
        $sql="insert into ikan (nama_ikan,nama_ikan_latin,nama_ikan_internasional,habitat,golongan) values
		('$nama_ikan','$nama_ikan_latin','$nama_ikan_internasional','$habitat','$golongan')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama Ikan :</label>
            <input type="text" name="nama_ikan" class="form-control" placeholder="Masukan Nama Ikan" required />

        </div>
        <div class="form-group">
            <label>Nama Latin :</label>
            <input type="text" name="nama_ikan_latin" class="form-control" placeholder="Masukan Nama Latin Ikan" required/>

        </div>
        <div class="form-group">
            <label>Nama Internasional :</label>
            <input type="text" name="nama_ikan_internasional" class="form-control" placeholder="Masukan Nama Internasional Ikan" required/>
        </div>
        <div class="form-group">
            <label>Habitat :</label>
            <input type="text" name="habitat" class="form-control" placeholder="Masukan Jenis Habitat Ikan" required/>
        </div>
        <div class="form-group">
            <label>Golongan Hewan :</label>
            <input type="text" name="golongan" class="form-control" placeholder="Masukkan Golongan Hewan Berdasarkan Jenis Makanan" required/>
        </div>      

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>