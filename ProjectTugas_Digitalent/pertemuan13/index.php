<?php
    include 'koneksi.php';

    session_start();
    //mengambil data table dari database
    $query = "SELECT * FROM tb_siswa;";
    $sql = mysqli_query($conn, $query);

    $no = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="datatables/datatables.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="datatables/datatables.min.js"></script>

    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
</head>


<body>
    <script>
        new DataTable('#dt');
    </script>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Latihan CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Daftar Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola.php">Tambah Siswa</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-xl mt-3">
        <h1>Data Siswa</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Berisi data yang disimpan di database</p>
            </blockquote>
        </figure>
        <!-- [tombol tambah] -->
        <a type="button" class="btn btn-success mb-2" href="kelola.php">
            <i class="fa fa-plus" aria-hidden="true"></i>
            Tambah Data
        </a>
        <!-- notification -->
        <?php
        if(isset($_SESSION['eksekusi'])){
        ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo $_SESSION['eksekusi']; ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            } 
            session_destroy(); 
        ?>

        <!-- Table Data -->
        <table class="table table-striped table-hover table-bordered" id="dt">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Foto Siswa</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <!-- melakukan perulangan table untuk mengambil seluruh data dari database -->
                <!-- dengan mengubah data table menjadi array -->
                <?php
                    while($result = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                    <td>
                        <center>
                            <?php echo ++$no; ?>
                        </center>
                    </td>

                    <td>
                        <?php echo $result['nisn']; ?>
                    </td>
                    <td>
                        <?php echo $result['nama_siswa']; ?>
                    </td>
                    <td>
                        <?php echo $result['jenis_kelamin']; ?>
                    </td>
                    <td class="">
                        <img src="img/<?php echo $result['foto_siswa']; ?>" alt="img1" style="width: 70px; height:70px; border-radius: 50%;">
                    </td>
                    <td>
                        <?php echo $result['alamat']; ?>
                    </td>
                    <td>
                        <!-- [tombol edit] -->
                        <a type="submit" class="btn btn-primary btn-sm" href="kelola.php?id=<?php echo $result['id_siswa'] ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <!-- [tombol hapus] -->
                        <a type="submit" class="btn btn-danger btn-sm" href="proses.php?hapus=<?php echo $result['id_siswa'] ?>" onClick="return confirm('Apakah yakin ingin menghapus');">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>