<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Daftar Barang</title>
  </head>
  <body>
    <div class="container">
        <br>
        <h1>Daftar Barang</h1>
        
        <?php

        include "koneksi.php";

        //Cek apakah ada nilai dari method GET dengan nama id_barang
        if (isset($_GET['idBarang'])) {
            $id_barang=htmlspecialchars($_GET["idBarang"]);

            $sql="delete from barang where idBarang='$id_barang' ";
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak
                if ($hasil) {
                  echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
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
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th class="col-3">Aksi</th>

            </tr>
            </thead>
            <?php
            include "koneksi.php";
            $sql="select * from barang order by idBarang desc";

            $hasil=mysqli_query($kon,$sql);
            $no=0;
            while ($data = mysqli_fetch_array($hasil)) {
                $no++;

                ?>
                <tbody>
                <tr>
                    <td><?php echo $no;?></td>
                    <td><?php echo $data["nama"];   ?></td>
                    <td><?php echo $data["harga"];   ?></td>
                    <td><?php echo $data["stok"];   ?></td>
                    <td>
                        <a href="update.php?idBarang=<?php echo htmlspecialchars($data['idBarang']); ?>" class="btn btn-warning" role="button">Update</a>
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?idBarang=<?php echo $data['idBarang']; ?>" class="btn btn-danger" role="button">Delete</a>
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
