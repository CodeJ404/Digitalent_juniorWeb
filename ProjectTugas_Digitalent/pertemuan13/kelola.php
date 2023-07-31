<!DOCTYPE html>
<?php
    include 'koneksi.php';

    // agar ketika menambah data tidak ada isinya, kosongkan value [tombol tambah]
    $id_siswa = '';
    $nisn = '';
    $nama_siswa = '';
    $jenis_kelamin = '';
    $alamat = '';

    if(isset($_GET['id'])){

        // mengambil page yang memiliki id sesuai data yang di edit [tombol edit]
        $id_siswa = $_GET['id'];
        $query = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
        $sql = mysqli_query($conn,$query);
        $result = mysqli_fetch_assoc($sql);
        
        $nisn = $result['nisn'];
        $nama_siswa = $result['nama_siswa'];
        $jenis_kelamin = $result['jenis_kelamin'];
        $alamat = $result['alamat'];
    }
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
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
    <div class="container-lg">
        <!-- semua aksi yang dilakukan berada di proses.php -->
        <!-- enctype digunakan untuk mengambil data yang memiliki banyak nilai didalamnya cth : foto -->
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <input value="<?php echo $id_siswa ?>" type="hidden" name="id_siswa" id="id_siswa">
            <!-- form nisn -->
            <div class="mb-3 row">
                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-8">
                    <input type="text" name="nisn" class="form-control" id="nisn" placeholder="cth:112233" value="<?php echo $nisn ?>" required>
                </div>
            </div>
            <!-- form nama -->
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" name="nama_siswa" class="form-control" id="nama" placeholder="cth:alexander" name="namas" value="<?php echo $nama_siswa ?>" required>
                </div>
            </div>
            <!-- form jenis kelamin -->
            <div class="mb-3 row">
                <label for="jkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-8">
                    <select id="jkel" name="jenis_kelamin" class="form-select">
                        <option <?php if($jenis_kelamin == "Laki-laki"){ echo "selected"; } ?> value="Laki-laki">Laki-laki</option>
                        <option <?php if($jenis_kelamin == "Perempuan"){ echo "selected"; } ?> value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <!-- form foto siswa -->
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
                <div class="col-sm-8">
                    <input   class="form-control" type="file" id="foto" name="foto" accept="image/*" <?php if(!isset($_GET['id'])){ echo "required"; } ?>>
                </div>
            </div>
            <!-- form alamat -->
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="JL. Timur" <?php if(!isset($_GET['id'])){ echo "required"; } ?>><?php echo $alamat ?></textarea>
                </div>
            </div>
            <div class="mb-3 row mt-4">
                <div class="col">
                    <!-- memisahkan antara tambah data dan edit data dengan menggunakan variable GET -->
                    <?php
                        if(isset($_GET["id"])){
                    ?>
                        <button type="submit" name="aksi" value="edit" value=""; class="btn btn-primary mb-2">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php
                        } else{
                    ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary mb-2">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Simpan
                        </button>
                    <?php } ?>
                    <a type="submit" class="btn btn-danger mb-2" href="index.php">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>