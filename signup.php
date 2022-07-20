<?php
$host = "localhost";
$port = 3306;
$database = "db_kokocar";
$user = "root";
$pw = "";
$connection = new PDO("mysql:host=$host:$port;dbname=$database", $user, $pw);
$name = "";
$username = "";
$email = "";
$password = "";
$password2 = "";
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    if($name == ""){
    ?>
    <script>alert('Nama tidak boleh kosong!!!');</script>
    <?php
    }else if($username == ""){
    ?>
    <script>alert("Username tidak boleh kosong!!!");</script>
    <?php
    }else if($email == ""){
    ?>
    <script>alert("Email tidak boleh kosong!!!");</script>
    <?php
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    ?>
    <script>alert("Email tidak ditemukan!!!");</script>
    <?php
    }else if($password == ""){
    ?>
    <script>alert("Password tidak boleh kosong!!!");</script>
    <?php
    }else if($password2 == ""){
    ?>
    <script>alert("Konfirmasi password tidak boleh kosong!!!");</script>
    <?php
    }else if($password != $password2){
    ?>
    <script>alert("Password tidak cocok!!!");</script>
    <?php
    }else{
        $sql = "insert into akun (nama, username, password, email) values (?, ?, ?, ?)";
        $result = $connection->prepare($sql);
        $result->execute([$name, $username, $password, $email]);
        session_start();
        $_SESSION['username'] = $username;
        setcookie('username', $username, time() + 60 * 60 * 7);
        setcookie('password', $password, time() + 60 * 60 * 7);
        header("location: index.php");
        ?>
        <script>alert("Berhasil mendaftarkan akun!!!");</script>
    <?php
    }
}
$connection = null;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baumans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Edu+QLD+Beginner:wght@500&display=swap" rel="stylesheet">
    <title>KokoCar Sign Up</title>
</head>
<body>
    <section class="login vh-100" id="login">
        <div class="container-lg" style="padding-top: 25px;">
            <div class="row justify-content-center text-center">
                <div class="col-lg-4 bg-light rounded pt-5 px-3">
                    <form name="login" method="POST">
                        <h1 class="mb-4"><a href="index.php" class="text-black text-decoration-none">Koko<span class="logo-car">Car</span></a></h1>
                        <label class="text-start mb-1" style="display: block;">Name</label>
                        <input class="w-100 form-control mb-2" name="name" type="text" value="<?= $name ?>">
                        <label class="text-start mb-1" style="display: block;">Username</label>
                        <input class="w-100 form-control mb-2" name="username" type="text" value="<?= $username ?>">
                        <label class="text-start mb-1" style="display: block;">Email</label>
                        <input class="w-100 form-control mb-2" name="email" type="text" value="<?= $email ?>">
                        <label class="text-start mb-1" style="display: block;">Password</label>
                        <input class="w-100 form-control mb-2" name="password" type="password" value="<?= $password ?>">
                        <label class="text-start mb-1" style="display: block;">Confirm Password</label>
                        <input class="w-100 form-control mb-3" name="password2" type="password" value="<?= $password2 ?>">
                        <input class="w-100 btn btn-warning mb-3 py-2 fw-bold sbmt" name="submit" type="submit">
                        <p class="mb-4">Sudah punya akun? <a href="login.php" class="text-decoration-none text-warning fw-bold">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>