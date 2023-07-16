<?php

    require "dbconfig/config.php";

?>

<!doctype html>
<html>
    <head>
        <title>Registrasi</title>
        <link rel="stylesheet" href="css/register.css">
    </head>
    <body>
            <div class="form">
                <center>
                <h1>Registrasi Data</h1>
                </center>
                <form action="register.php" method="post">
                        <input type="text" id="fullname" name="fullname" placeholder="fullname" required>
                        <input type="text" id="username" name="username" placeholder="username" required>
                        <input type="email" id="email" name="email" placeholder="email" required>
                        <input type="password" id="password" name="password" placeholder="password" required>
                        <input type="password" id="cfpassword" name="cfpassword" placeholder="confirm password" required>
                    <div class="button">
                        <button type="submit" id="btn_submit" name="registrasi">Registrasi</button>
                        <hr>
                        <a href="login.php"><button type="button" id="btn">Kembali ke Login</button></a>
                    </div>
                </form>

                <?php
                if(isset($_POST['registrasi']))
                {
                    
                    $fullname = $_POST['fullname'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cfpassword'];
                    
                    
                    if($password==$cpassword){
                        $query= "select * from userinformation WHERE username='$username'";
                        $query_run = mysqli_query($db,$query);
                        
                        if(mysqli_num_rows($query_run)>0){                            
                            echo '<script type="text/javascript"> alert("Username telah tersedia.. coba ganti username") </script>';
                        } else {
                            $query= "insert into userinformation values('','$username','$password','$fullname', '$email')";
                            $query_run = mysqli_query($db,$query);
                            
                            if($query_run){
                                echo '<script type="text/javascript"> alert("Berhasil registrasi... silahkan kembali ke halaman login") </script>';
                            } else {
                                echo '<script type="text/javascript"> alert("Error!") </script>';
                            }
                        }	
                    } else {
                        echo '<script type="text/javascript"> alert("Password and confirm password does not match!")</script>';	
                    }
                }
            ?>
            </div>
    </body>
</html>