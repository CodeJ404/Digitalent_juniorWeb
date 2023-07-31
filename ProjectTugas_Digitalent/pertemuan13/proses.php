<?php
    include 'fungsi.php';

    session_start();

    if(isset($_POST['aksi'])){
        if($_POST['aksi'] == "add"){
            
            $run = tambah_data($_POST,$_FILES);

            if($run){
                $_SESSION['eksekusi'] = "Data Berhasil Disimpan";
                header("location: index.php");
            }else{
                echo "Input Tidak Berhasil <a href='index.php'>[HOME]</a>";
            }
            
        }elseif($_POST['aksi'] == "edit"){

            $run = edit_data($_POST,$_FILES);
            
            if($run){
                $_SESSION['eksekusi'] = "Data Berhasil Diedit";
                header('location: index.php');
            }else{
                echo $query;
            }
        }
    }

    if(isset($_GET['hapus'])){

        $run = hapus_data($_GET);

        if($run){
            $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
            header("location: index.php");
        } else{
            echo $query;
        }
    }

?>