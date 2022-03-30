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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_ikan
    if (isset($_GET['id_ikan'])) {
        $id_ikan=input($_GET["id_ikan"]);

        $sql="select * from ikan where id_ikan=$id_ikan";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_ikan=htmlspecialchars($_POST["id_ikan"]);
        $nama_ikan=input($_POST["nama_ikan"]);
        $nama_ikan_latin=input($_POST["nama_ikan_latin"]);
        $nama_ikan_internasional=input($_POST["nama_ikan_internasional"]);
        $habitat=input($_POST["habitat"]);
        $golongan=input($_POST["golongan"]);
        
        //Query update data pada tabel ikan
        $sql="update ikan set
            nama_ikan='$nama_ikan',
			nama_ikan_latin='$nama_ikan_latin',
			nama_ikan_internasional='$nama_ikan_internasional',
			habitat='$habitat',
			golongan='$golongan'
            where id_ikan=$id_ikan";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama Ikan :</label>
            <input type="text" name="nama_ikan" class="form-control" value="<?php echo $data['nama_ikan']; ?>" placeholder="Masukan Nama Ikan" required />

        </div>
        <div class="form-group">
            <label>Nama Latin :</label>
            <input type="text" name="nama_ikan_latin" class="form-control" value="<?php echo $data['nama_ikan_latin']; ?>" placeholder="Masukan Nama Latin Ikan" required/>

        </div>
        <div class="form-group">
            <label>Nama Internasional :</label>
            <input type="text" name="nama_ikan_internasional" class="form-control" value="<?php echo $data['nama_ikan_internasional']; ?>" placeholder="Masukan Nama Internasional Ikan" required/>

        </div>
        <div class="form-group">
            <label>Habitat :</label>
            <input type="text" name="habitat" class="form-control" value="<?php echo $data['habitat']; ?>" placeholder="Masukan Habitat Ikan" required/>
        </div>
        <div class="form-group">
            <label>Golongan Hewan :</label>
            <input type="text" name="golongan" class="form-control" value="<?php echo $data['golongan']; ?>" placeholder="Masukan Jenis Golongan Hewan Berdasarkan Makanan" required/>
        </div>
        <input type="hidden" name="id_ikan" value="<?php echo $data['id_ikan']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>