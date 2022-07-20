<?php

$host = "localhost";
$port = 3306;
$database = "db_kokocar";
$user = "root";
$pw = "";
$connection = new PDO("mysql:host=$host:$port;dbname=$database", $user, $pw);
if(isset($_POST["login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "select * from akun where username = ? and password = ?";
	$result = $connection->prepare($sql);
	$result->execute([$username, $password]);
	$success = false;
	$findUser = null;
	foreach($result as $value){
		$success = true;
		$findUser = $value["username"];
        $findPass = $value["password"];
	}
	if($success){
        if(isset($_POST["remember"])){
            session_start();
            $_SESSION['username'] = $findUser;
            setcookie('username', $findUser, time() + 60 * 60 * 7);
            setcookie('password', $findPass, time() + 60 * 60 * 7);
            setcookie('user', $findUser, time() + 60 * 60 * 7);
            setcookie('pw', $findPass, time() + 60 * 60 * 7);
            header("location: index.php");
        }else{
            session_start();
            $_SESSION['username'] = $findUser;
            setcookie('username', $findUser, time() + 60 * 60 * 7);
            setcookie('password', $findPass, time() + 60 * 60 * 7);
            setcookie('user', $findUser, time()-1);
            setcookie('pw', $findPass, time()-1);
            header("location: index.php");
            }
        
	}else{
?>
		<script>alert("Username atau Password salah!");</script>
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
    <title>KokoCar Login</title>
</head>
<body>
    <section class="login vh-100" id="login">
        <div class="container-lg" style="padding-top: 120px;">
            <div class="row justify-content-center text-center">
                <div class="col-lg-4 bg-light rounded pt-5 px-3">
                    <form name="login" method="POST">
                        <h1 class="mb-5"><a href="index.php" class="text-black text-decoration-none">Koko<span class="logo-car">Car</span></a></h1>
                        <label class="text-start mb-2" style="display: block;">Username</label>
                        <input class="w-100 form-control mb-2" name="username" id="username" type="text">
                        <label class="text-start mb-2" style="display: block;">Password</label>
                        <input class="w-100 form-control mb-2" name="password" id="password" type="password">
                        <div style="display: inline; padding-right: 220px;">
                            <input type="checkbox" name="remember" id="" class="mb-3 me-auto"> Remember me
                        </div>
                        <input class="w-100 btn btn-warning mb-3 py-2 fw-bold sbmt" name="login" type="submit">
                        <p class="mb-4">Belum punya akun? <a href="signup.php" class="text-decoration-none text-warning fw-bold">Sign up</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php
if(isset($_COOKIE['user']) && isset($_COOKIE['pw'])){
    $username = $_COOKIE['user'];
    $password = $_COOKIE['pw'];

    echo "<script>
    document.getElementById('username').value = '$username';
    document.getElementById('password').value = '$password';
    </script>";
}
?>