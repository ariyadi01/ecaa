<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    
<div class="container">
    <br>
    <h4>Data Ikan Di Perairan Indonesia</h4>
<?php


    include "koneksi.php";

    //Cek apakah ada nilai dari method GET dengan nama id_ikan
    if (isset($_GET['id_ikan'])) {
        $id_ikan=htmlspecialchars($_GET["id_ikan"]);

        $sql="delete from ikan where id_ikan='$id_ikan' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>



    <table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Ikan</th>
            <th>Nama Latin</th>
            <th>Nama Internasional</th>
            <th>Habitat</th>
            <th>Penggolongan Hewan</th>
            <th colspan='2'>Aksi</th>
        </tr>
        </thead>
        <?php
        include "koneksi.php";
        $sql="select * from ikan order by id_ikan desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;
            

            ?>

            <tbody>
            <tr>
                <td><?php echo $no?></td>
                <td><?php echo $data["nama_ikan"]; ?></td>
                <td><?php echo $data["nama_ikan_latin"];  ?></td>
                <td><?php echo $data["nama_ikan_internasional"];  ?></td>
                <td><?php echo $data["habitat"];   ?></td>
                <td><?php echo $data["golongan"];   ?></td>
                <td>
                    <a href="update.php?id_ikan=<?php echo htmlspecialchars($data['id_ikan']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_ikan=<?php echo $data['id_ikan']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>

</div>
</body>
</html>