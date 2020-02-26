<?php
//Dapetin Session Data
session_start();
$cekmeja=$_SESSION['Meja'];
if($cekmeja!=null)
{
header("Location: Pesan.php");
die();
}
    if(!empty($_POST)){
        session_start();
        $no_meja=$_POST['Meja'];
        $pemesan=$_POST['pemesan'];
    ?>
        <script language="javascript">document.location.href="Pesan.php";</script>
<?php
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/Registration-Form-with-Photo.css">
</head> 

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Keefe</a><button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" data-toogle="collapse" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto text-uppercase">
                <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php?#portfolio">Menu</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php?#about">Tentang kami</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php?#contact">Lokasi</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="#">Pesan</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div></br></br></br></div>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form role="form" action="session_pesan.php" method="post">
                <h2 class="text-center">Meja</h2>
                <div class="form-group"><input class="form-control" type="number" name="Meja" placeholder="Nomor Meja" required></div>
                <div class="form-group"><input class="form-control" type="text" name="pemesan" placeholder="Nama Pemesan"></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required>Pastikan Telah Terisi Dengan Benar.</label></div>
                </div>
                <div class="form-group"><input class="btn btn-primary btn-block" type="submit" value="Simpan"></div><a href="#" class="already">Anda Dapat Mengosongkan Nama Jika Tidak Menginginkannya</a>
            </form>
                
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4"><span class="copyright">Copyright&nbsp;© Brand 2019</span></div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../assets/js/agency.js"></script>
    <script src="../assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>

</html>