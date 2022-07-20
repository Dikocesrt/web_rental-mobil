<?php
    session_start();
    $host = "localhost";
    $port = 3306;
    $database = "db_kokocar";
    $user = "root";
    $pw = "";
    $connection = new PDO("mysql:host=$host:$port;dbname=$database", $user, $pw);
    $sql = "select * from mobil";
    $result = $connection->prepare($sql);
    $result->execute();
    $connection = null;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baumans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Edu+QLD+Beginner:wght@500&display=swap" rel="stylesheet">
    <title>Rental Mobil KokoCar</title>
</head>
<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
        <div class="container-lg">
            <a href="index.php" class="navbar-brand fs-3 text-white fw-bold">Koko<span class="logo-car">Car</span></a>
            <button class="navbar-toggler bg-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pe-0">
                    <?php
                        if(isset($_SESSION['username'])){
                            $username = $_COOKIE['username'];
                            $password = $_COOKIE['password'];
                            echo '
                            <li class="nav-item">
                                <a href="#home" class="nav-link text-white fw-bold ms-2">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="#product" class="nav-link text-white ms-2">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a href="#service" class="nav-link text-white ms-2">Layanan</a>
                            </li>
                            <li class="nav-item">
                                <a href="#testimonials" class="nav-link text-white ms-2">Testimoni</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact" class="nav-link text-white ms-2">Kontak</a>
                            </li>
                            <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle ms-2 fw-bold" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">';
                                echo $username;
                            echo '</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </li>
                            </ul>
                            </div>
                            ';
                        }else{
                            echo '
                            <li class="nav-item">
                                <a href="#home" class="nav-link text-white fw-bold ms-2">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="#product" class="nav-link text-white ms-2">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a href="#service" class="nav-link text-white ms-2">Layanan</a>
                            </li>
                            <li class="nav-item">
                                <a href="#testimonials" class="nav-link text-white ms-2">Testimoni</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contact" class="nav-link text-white ms-2">Kontak</a>
                            </li>
                            <li class="nav-item">
                                <a href="login.php" class="nav-link btn text-black ms-2 fw-bold px-3">Login</a>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- home start -->
    <section class="home" id="home">
        <div class="container-lg py-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="text-white">Persewaan Mobil <span style="color: #fabd02;">Yogyakarta</span></h1>
                    <p class="text-white">Temukan Mobil Terbaikmu</p>
                    <?php
                    if(isset($_SESSION['username'])){
                        echo '<a href="#product" class="btn fw-bold pt-2">Booking Sekarang</a>';
                    }else{
                        echo '<a href="signup.php" class="btn fw-bold pt-2">Daftar Sekarang</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- home end -->

    <!-- product section start -->
    <section class="product py-5 bg-light" id="product">
        <div class="container-lg py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 class="fw-bold mb-5">Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    foreach($result as $mobil){
                        $idMobil = $mobil["id"];
                        $namaMobil = $mobil["nama"];
                        $harga24 = $mobil["harga_24"];
                        $harga12 = $mobil["harga_12"];
                        $rating = $mobil["rating"];
                        $kapasitas = $mobil["kapasitas"];
                        $gambar = $mobil["gambar"];
                        
                        echo '<div class="col-md-4 col-sm-12 text-center">
                        <div class="product-list py-5 px-3 bg-white mb-5 shadow-sm rounded px-3 bg-white">
                            <img class="w-75" src="'; echo $gambar; echo '" alt="calya img">
                            <h6 class="text-start">'; echo $namaMobil; echo '</h6>
                            <p class="text-start text-warning fw-bold">Kapasitas '; echo $kapasitas; echo ' Penumpang</p>
                            <p class="text-start hrg">Rp. '; echo number_format($harga24, 2, ".", ","); echo ' Per 24 jam</p>
                            <p class="text-start hrg">Rp. '; echo number_format($harga12, 2, ".", ","); echo ' Per 12 jam</p>
                            <p class="text-start">'; for($i = 0 ; $i<$rating; $i++) { echo '⭐';}; echo '</p>';
                            if(isset($_SESSION['username'])){
                                echo '<button class="btn fw-bold"><a href="pesan.php?id=';echo $idMobil; echo '" class="btn fw-bold">PESAN SEKARANG</a></button>';
                            }else{
                                echo '<button class="btn fw-bold"><a href="login.php" class="btn fw-bold">PESAN SEKARANG</a></button>';
                            }
                        echo '</div>
                    </div>';
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- product section end -->

    <!-- service section start -->
    <section class="service py-5 bg-light" id="service">
        <div class="container-lg py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 class="fw-bold mb-5">Layanan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-car text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Kebersihan Mobil</h3>
                        <p class="text-muted">KokoCar rutin membersihkan mobil setelah pemakaian customer</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-cogs text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Kualitas Mobil</h3>
                        <p class="text-muted">KokoCar rutin melakukan servis kendaraan secara berkala demi keamanan customer</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-check text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Pengecekan</h3>
                        <p class="text-muted">KokoCar akan melakukan pengecekan sebelum kendaraan digunakan customer</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-user text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Driver</h3>
                        <p class="text-muted">Driver KokoCar merupakan driver terlatih dan selalu membawa surat surat lengkap</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-phone text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Layanan Cepat</h3>
                        <p class="text-muted">KokoCar memliki layanan cepat dan dapat melakukan pesanan secara online</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="service-list mb-5 text-center py-5 px-3 shadow-sm bg-white">
                        <i class="fas fa-star text-warning fs-3 mb-4"></i>
                        <h3 class="fs-6 fw-bold">Rating</h3>
                        <p class="text-muted">KokoCar memiliki rating 4.8/5<br>mengutamakan kenyamanan customer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service section end -->

    <!-- testimonials section start -->
    <section class="testimonials bg-light" id="testimonials">
        <div class="container-lg py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 class="fw-bold mb-5">Testimoni</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div id="carousel1" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carousel1" data-bs-slide-to="0" class="active bg-warning" aria-current="true" aria-label="Slide 1"></button>
                            <button class="bg-warning" type="button" data-bs-target="#carousel1" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button class="bg-warning" type="button" data-bs-target="#carousel1" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner shadow-sm">
                            <div class="carousel-item active testi-item bg-white shadow-sm rounded p-4">
                                <div class="testi-author d-flex align-items-center">
                                    <img class="img-thumbnail rounded-circle" style="width: 14%;" src="images/iqbal-ramadhan.jpg" alt="Testi img">
                                    <div class="author ms-3">
                                        <h3 class="fs-6 mb-1">Iqbal Ramadhan</h3>
                                        <p class="m-0 text-warning fw-bold text-capitalize">Actor</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-muted desc">Liburan ke Yogyakarta terasa lebih menyenangkan bersama KokoCar</p>
                                <div class="rating text-warning mb-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="carousel-item testi-item bg-white shadow-sm rounded p-4">
                                <div class="testi-author d-flex align-items-center">
                                    <img class="img-thumbnail rounded-circle" style="width: 14%;" src="images/MrBeast.jpg" alt="Testi img">
                                    <div class="author ms-3">
                                        <h3 class="fs-6 mb-1">Mr Beast</h3>
                                        <p class="m-0 text-warning fw-bold text-capitalize">Youtuber</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-muted desc">because of KokoCar my holiday was amazing, Thankyou KokoCar</p>
                                <div class="rating text-warning mb-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="carousel-item testi-item bg-white shadow-sm rounded p-4">
                                <div class="testi-author d-flex align-items-center">
                                    <img class="img-thumbnail rounded-circle" style="width: 14%;" src="images/ginting.jpg" alt="Testi img">
                                    <div class="author ms-3">
                                        <h3 class="fs-6 mb-1">Anthony Ginting</h3>
                                        <p class="m-0 text-warning fw-bold">Atlet</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-muted desc">KokoCar memang terdebesttttt pokoknyaa!!!</p>
                                <div class="rating text-warning mb-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonials section end -->

    <!-- contact section start -->
    <section class="contact py-5" id="contact">
        <div class="container-lg py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 class="fw-bold mb-5">Kontak</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="contact-item d-flex">
                        <div class="icon fs-4 text-warning">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="text ms-3">
                            <h3 class="fs-5">Email</h3>
                            <p class="text-muted">dikocesrt@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex">
                        <div class="icon fs-4 text-warning">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="text ms-3">
                            <h3 class="fs-5">Telp</h3>
                            <p class="text-muted">(0274) 381169</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex">
                        <div class="icon fs-4 text-warning">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="text ms-3">
                            <h3 class="fs-5">Lokasi</h3>
                            <p class="text-muted">Jl. Sorosutan No.69, Umbulharjo, Yogyakarta</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="contact-form">
                        <form method="post" action="mail.php">
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <input type="text" placeholder="Your Name" name="your-name" class="form-control form-control-lg fs-6 shadow-sm">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <input type="text" placeholder="Your Email" name="your-mail"class="form-control form-control-lg fs-6 shadow-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <input type="text" placeholder="Subject" name="subject" class="form-control form-control-lg fs-6 shadow-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <textarea rows="5" placeholder="Your Message" name="message" class="form-control form-control-lg fs-6 shadow-sm"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" value="Send" name="submit" class="btn btn-warning px-4">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact section end -->
    <!-- footer start -->
    <footer class="footer border-top py-5 bg-black">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center align-content-center fw-bold text-warning">&copy; 2022 Diko Cesartista</p>
                </div>
            </div>
            <div class="row">
                <div class="social-links col-lg-12 text-center">
                    <a class="text-warning me-2" href="https://t.co/QPZLcEIGq8" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="text-warning me-2" href="https://wa.me/082231703509?text=Hello%20guys!!!%20it's%20Diko%20Cesartista%20here%3A)" target="_blank"><i class="fab fa-whatsapp" target="_blank"></i></a>
                    <a class="text-warning me-2" href="https://www.facebook.com/diko.cesartista/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-warning me-2" href="https://twitter.com/dikocesrt_" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a class="text-warning me-2" href="https://t.me/dikocesrt" target="_blank"><i class="fab fa-telegram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>