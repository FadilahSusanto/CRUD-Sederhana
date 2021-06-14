<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Update</title>

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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
    if (isset($_GET['idBarang'])) {
        $id_barang=input($_GET["idBarang"]);

        $sql="select * from barang where idBarang=$id_barang";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_barang=htmlspecialchars($_POST["idBarang"]);
        $nama=input($_POST["namaBarang"]);
        $harga=input($_POST["hargaBarang"]);
        $stok=input($_POST["stokBarang"]);


        //Query update data pada tabel barang
        $sql="update barang set
			nama='$nama',
			harga='$harga',
			stok='$stok'
            where idBarang=$id_barang";

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
    <h2>Update Data Barang</h2>

    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group wb-5">
            <label>Nama:</label>
            <input type="text" name="namaBarang" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="nama Barang" required />

        </div>
        <div class="form-group wb-5">
            <label>harga:</label>
            <input type="number" name="hargaBarang" class="form-control" value="<?php echo $data['harga']; ?>" placeholder="0" required/>

        </div>
        <div class="form-group wb-5">
            <label>Stok:</label>
            <input name="stokBarang" type="number"class="form-control" value="<?php echo $data['stok']; ?>" placeholder="0" required/>
        </div>

        <input type="hidden" name="idBarang" value="<?php echo $data['idBarang']; ?>" />
        <hr>
        <button  type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>