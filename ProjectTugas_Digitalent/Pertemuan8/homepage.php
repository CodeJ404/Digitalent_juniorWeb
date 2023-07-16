<?php
    session_start()
?>
<!doctype html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body style="background-color:#404258;">
        <center>
        <h1 style="color:#eee;">Selamat Datang
        <?php echo $_SESSION['username'] ?>
        </h1>
        <form action="homepage.php" method="post">
        <button style="border-radius: 5px;border: none;color: #eee;padding: 10px 32px;text-decoration: none;cursor: pointer;background-color: #6B728E;margin-top: 20px;" name="logout" id="logout">Logout</button></a>
        </form>        
        </center>
        
        <?php
        if(isset($_POST['logout'])){
            session_destroy();
            header('location:login.php');
        }
        ?>
    </body>
</html>