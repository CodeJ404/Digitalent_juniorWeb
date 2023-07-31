<?php
    include 'koneksi.php';

    // [tombol tambah]
    function tambah_data($data, $files){
            $nisn = $data['nisn'];
            $nama_siswa = $data['nama_siswa'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $alamat = $data['alamat'];

            // menyimpan file foto dengan nama foto sesuai nisn
            // memisahkan nama foto yang diinput dan ekstensinya menjadi sebuah array
            $split = explode('.', $files['foto']['name']);
            // mengambil index ekstensi foto
            $ext = $split[count($split)-1];
            // menyimpan nilai nisn dan digabungkan dengan ekstensi file untuk mengubah nama foto yang dikirimkan
            $foto = $nisn.'.'.$ext;

            // membuat variable directory/lokasi tempat kita menyimpan foto
            $dir = 'img/';
            // mengambil lokasi temporary file
            $tmpfile = $files['foto']['tmp_name'];
            // memindahkan foto yang sebelumnya terletak pada "C:\xampp\tmp\phpDD17.tmp"
            move_uploaded_file($tmpfile, $dir.$foto);

            
            
            // menginput data ke database
            $query = "INSERT INTO tb_siswa VALUES(null,'$nisn','$nama_siswa','$jenis_kelamin','$foto','$alamat')";
            $sql = mysqli_query($GLOBALS['conn'], $query);

            return true;
    }

    // [tombol edit]
    function edit_data($data, $files){
            $id_siswa = $data['id_siswa'];
            $nisn = $data['nisn'];
            $nama_siswa = $data['nama_siswa'];
            $jenis_kelamin = $data['jenis_kelamin'];
            $alamat = $data['alamat'];

            // mengambil page yang memiliki id sesuai data yang di edit
            $qshow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'";
            $sqlshow = mysqli_query($GLOBALS['conn'], $qshow);
            // menampilkan data sesuai array dari table form yang sudah disimpan
            $result = mysqli_fetch_assoc($sqlshow);

            if($files['foto']['name'] == ''){
                $foto_siswa = $result['foto_siswa'];
            }else{
                // menyimpan file foto dengan nama foto sesuai nisn
                // memisahkan nama foto yang diinput dan ekstensinya menjadi sebuah array
                $split = explode('.', $files['foto']['name']);
                // mengambil index ekstensi foto
                $ext = $split[count($split)-1];
                // membuat variable directory/lokasi tempat kita menyimpan foto
                $dir = 'img/';
                // mengambil lokasi temporary file
                $tmpfile = $files['foto']['tmp_name'];

                $foto_siswa = $result['nisn'].'.'.$ext;

                unlink($dir.$result['foto_siswa']);
                // membuat variable untuk memindahkan directory/lokasi ke tempat kita menyimpan foto
                move_uploaded_file($tmpfile, $dir.$foto_siswa );
            }

            // mengupdate data 
            $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto_siswa='$foto_siswa' WHERE id_siswa='$id_siswa'";
            $sql = mysqli_query($GLOBALS['conn'],$query);

            return true;
    }

    // [tombol hapus]
    function hapus_data($data){
        $id_siswa = $data['hapus'];

        // mengambil page yang memiliki id sesuai data yang di edit
        $qshow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'";
        $sqlshow = mysqli_query($GLOBALS['conn'], $qshow);
        // menampilkan data sesuai array dari table form yang sudah disimpan
        $result = mysqli_fetch_assoc($sqlshow);

        unlink("img/".$result['foto_siswa']);

        // menghapus data dari database dimana ID merupakan Primary Key
        $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa';";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

?>