<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Input data</title>
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

            $nama=input($_POST["namaBarang"]);
            $harga=input($_POST["hargaBarang"]);
            $stok=input($_POST["stokBarang"]);

            //Query input menginput data kedalam tabel anggota
            $sql="insert into barang (nama,harga,stok) values
        ('$nama','$harga','$barang')";

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

        <br>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group wb-5">
                <label>Nama:</label>
                <input type="text" name="namaBarang" class="form-control" placeholder="Nama barang" required/>

            </div>
            <div class="form-group wb-5">
                <label>Harga:</label>
                <input type="number" name="hargaBarang" class="form-control"  placeholder="0" required />

            </div> 
            <div class="form-group wb-5">
                <label>Stok:</label>
                <input type="number" name="stokBarang" class="form-control" placeholder="0" required/>
            </div>
            <hr>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </body>
</html>
