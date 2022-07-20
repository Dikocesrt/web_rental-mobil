<?php
if(isset($_POST['submit'])){
    $username = $_COOKIE['username'] . "\n";
    $nama = $_POST['name'] . "\n";
    $alamat = $_POST['address'] . "\n";
    $ktp = $_POST['ktp'] . "\n";
    $telp = $_POST['call'] . "\n";
    $jam = $_POST['jam'] . " jam\n";
    $temp = "harga_" . $_POST['jam'];

    $host = "localhost";
    $port = 3306;
    $database = "db_kokocar";
    $user = "root";
    $pw = "";
    $connection = new PDO("mysql:host=$host:$port;dbname=$database", $user, $pw);
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "select " . $temp . " from mobil where id = ?";
        $result = $connection->prepare($sql);
        $result->execute([$id]);
        foreach($result as $mobil){
            $harga = $mobil["$temp"];
        }
    }
    $connection = null;

    $fp = fopen('data-pesanan.txt', 'w');
    fwrite($fp, $username);
    fwrite($fp, $nama);
    fwrite($fp, $alamat);
    fwrite($fp, $ktp);
    fwrite($fp, $telp);
    fwrite($fp, $jam);
    fwrite($fp, $harga);
    fclose($fp);
    header("location: index.php?berhasilmelakukanpesanan");
}