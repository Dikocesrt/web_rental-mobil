<?php
    session_start();
    $host = "localhost";
    $port = 3306;
    $database = "db_kokocar";
    $user = "root";
    $pw = "";
    $connection = new PDO("mysql:host=$host:$port;dbname=$database", $user, $pw);
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "select * from mobil where id = ?";
        $result = $connection->prepare($sql);
        $result->execute([$id]);
        foreach($result as $mobil){
            $namaMobil = $mobil["nama"];
            $harga24 = $mobil["harga_24"];
            $harga12 = $mobil["harga_12"];
            $rating = $mobil["rating"];
            $kapasitas = $mobil["kapasitas"];
            $gambar = $mobil["gambar"];
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
    <title>KokoCar Pesan</title>
</head>
<body>
    <section class="pesan vh-100">
        <div class="container-lg" style="padding-top: 25px;">
            <div class="row justify-content-center text-center">
                <div class="col-lg-5">
                    <div class="product-list pt-5 px-3 bg-white shadow-sm rounded px-3 bg-white me-5 h-100">
                        <img class="w-75 mb-5" src="<?= $gambar; ?>" alt="calya img">
                        <h6 class="text-start mb-4">  <?= $namaMobil; ?></h6>
                        <p class="text-start text-warning fw-bold"> Kapasitas <?= $kapasitas; ?> Penumpang</p>
                        <p class="text-start hrg text-muted">Rp. <?= number_format($harga24, 2, ".", ","); ?> Per 24 jam</p>
                        <p class="text-start hrg text-muted">Rp. <?= number_format($harga12, 2, ".", ","); ?> Per 12 jam</p>
                        <p class="text-start mb-4"> <?php for($i = 0 ; $i<$rating; $i++) { echo '⭐';}; ?> </p>
                        <a href="index.php#product" class="w-100 btn btn-warning mb-1 py-2 fw-bold sbmt">Ubah Pilihan</a>
                    </div>
                </div>
                <div class="col-lg-4 bg-light rounded pt-5 px-3">
                    <form name="login" method="POST" action="proses.php?id=<?= $id ?>">
                        <h1 class="mb-5"><a href="index.php" class="text-black text-decoration-none">Koko<span class="logo-car">Car</span></a></h1>
                        <label class="text-start mb-1" style="display: block;">Nama</label>
                        <input class="w-100 form-control mb-2" name="name" type="text">
                        <label class="text-start mb-1" style="display: block;">Alamat</label>
                        <input class="w-100 form-control mb-2" name="address" type="text">
                        <label class="text-start mb-1" style="display: block;">No KTP / SIM</label>
                        <input class="w-100 form-control mb-2" name="ktp" type="text">
                        <label class="text-start mb-1" style="display: block;">No Telp</label>
                        <input class="w-100 form-control mb-2" name="call" type="text">
                        <label class="text-start mb-1" style="display: block;">Pilihan Jam</label>
                        <select class="form-select mb-3" id="jam" name="jam" aria-label="Default select example">
                            <option selected></option>
                            <option value="12">12 Jam</option>
                            <option value="24">24 Jam</option>
                        </select>
                        <input class="w-100 btn btn-warning mb-4 py-2 fw-bold sbmt" name="submit" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>