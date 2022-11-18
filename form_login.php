

<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" href="css/login.css">
    </head>
   
    <body>
    <?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
    
        <div class="container">
          <h1>Login</h1>
            <form action="Menu/cek_login.php" method="POST">
                <label>email</label><br>
                <input type="email" placeholder="Email" name="email" required><br>
                <label>Password</label><br>
                <input type="password" placeholder="password" name="password" required>
                <button name="submit" class="btn">Log in</button><br>
                <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
            </form>
        </div>     
    </body>
</html>