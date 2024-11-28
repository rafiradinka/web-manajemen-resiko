<?php
include("../inc/koneksi.php");

session_start(); // pembatasan
if(isset($_SESSION['admin_username'])!=''){
    header("location:index.php");
    exit();
}

$username   = "";
$password   = "";
$err        = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username =='' or $password==''){
        $err    = "Silahkan lengkapi data";
    } else {
        $sql1   = "select * from admin where username = '$username'";
        $q1     = mysqli_query($koneksi,$sql1);
        $r1     = mysqli_fetch_array($q1);
        $n1     = mysqli_num_rows($q1);

        if($n1<1){
            $err = "username tidak ditemmukan";
        } elseif($r1['password'] != MD5($password)){
            $err = "password salah";
        } else {
            $_SESSION['admin_username'] = $username;
            header("location:index.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css" />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />
    <title>Login Page</title>
</head>
<body>
    <div class="container" id="container">
        <div class="sign-up">
            <form>
                <h1>Create Account</h1>
                <span>or use email for registeration</span>
                <input type="text" placeholder="Nama" />
                <input type="text" placeholder="Instansi" />
                <input type="text" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <button>Daftar</button>
            </form>
        </div>

        <!-- SIGN IN -->
        <div class="sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <?php 
                if($err){
                ?>
                <div class="alert alert-danger">
                    <?php echo $err ?>
                </div>
                <?php
                }
                ?>
                <!-- icon login sosmed -->
                <div class="icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                </div>
                <span>or use username password</span>
                <input type="text" id="username" name="username" placeholder="Username"/>
                <input  type="password" id="password" name="password" placeholder="Password"/>
                <button type="submit" class="btn btn-primary" name="login">SUBMIT</button>
            </form>
        </div>

        <!-- JS -->
        <div class="toogle-container">
            <div class="toogle">
                <div class="toogle-panel toogle-left">
                    <h1>halo pantek!</h1>
                    <p>Jika anda sudah memiliki akun</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toogle-panel toogle-right">
                    <h1>Hallo, GANTENG!</h1>
                    <p>Jika Anda tidak memiliki akun</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
