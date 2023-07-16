<?php
    session_start();
    require "dbconfig/config.php";

?>
<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>

        <div class="container">
            <div class="form">
                <form action="login.php" method="post">
                    <div class="login">
                        <input type="text" id="username" name="username" placeholder="username" required>
                    </div>
                    <div class="password">
                        <input type="password" id="password" name="password" placeholder="password" required>
                    </div>
                    <div class="button">
                        <button type="submit" id="btn_submit" name="login">Masuk</button>
                        <hr>
                        <a href="register.php"><button type="button" id="btn" name="register">Buat Akun Baru</button></a>
                    </div>
                </form>
            </div>
            <div class="sidebar">
                <h1>HAI</h1>
                <h1>SELAMAT DATANG</h1>
                <h2>silahkan melakukan login....</h2>
                <p style="font-size:12px;">Website ini dibuat oleh <u>JiarJ</u></p>
            </div>
        </div>

        <?php

		if(isset($_POST['login'])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="select * from userinformation WHERE username='$username' AND password='$password'";
			$query_run = mysqli_query($db,$query);
			
			if(mysqli_num_rows($query_run)>0){
				$row = mysqli_fetch_assoc($query_run);
				$_SESSION['username']= $row['username'];
				header('location:homepage.php');
			} else {
				echo '<script type="text/javascript"> alert("Password atau username salah!") </script>';
			}
		}
		
		?>
    </body>
</html>