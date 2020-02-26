<?php
session_start();
if(!$_SESSION['Meja'])
{
    header("location:destroy.php");
    die();
}

$no_meja=$_SESSION['Meja'];
$pemesan=$_SESSION['pemesan'];

?>

<!-- Menambahkan Ke Keranjang -->
 <!-- End Keranjang -->

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
    <link href="../assets/bootstrap/css/simple-sidebar.css" rel="stylesheet">
</head>
<body id="page-top">

    <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Menu </div>
            <div class="list-group list-group-flush mt-5">
              <a href="#" class="list-group-item list-group-item-action bg-light">Pesan Makanan</a>
              <a href="Daftar-Pesanan.php" class="list-group-item list-group-item-action bg-light">Keranjang Pesanan</a>
              <a href="Terpesan.php" class="list-group-item list-group-item-action bg-light">Barang Yang Dipesan</a>
            </div>
    </div>
<div id="page-content-wrapper">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" id="menu-toggle" href="">Keefe</a><button class="navbar-toggler navbar-toggler-right" id="menu-toggle" data-toggle="collapse" data-target="#navbarResponsive" type="button" data-toogle="collapse" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto text-uppercase">
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php">Halaman Awal</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php?#about">Tentang kami</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="index.php?#contact">Lokasi</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link js-scroll-trigger" href="#">Pesan</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <section data-aos="fade" id="portfolio" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="text-uppercase section-heading">Menu</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
            <!-- LIST BARANG -->
            <?php            
            $query1=mysql_connect("localhost","root","");
            mysql_select_db("kefe",$query1);

            $start=0;
            $limit=8;

            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $start=($id-1)*$limit;
            }
            $query=mysql_query("select * from items LIMIT $start, $limit");
            while($query2=mysql_fetch_array($query))
            {
            echo"
            <div class='col-sm-6 col-md-4 portfolio-item'><a href='#portfolioModal".$query2['item_id']."' class='portfolio-link'><img class='img-fluid' src='../!admin/item_images/".$query2['item_image']."'></a>
                <div class='portfolio-caption'>
                    <h4>".$query2['item_name']."</h4><a class='btn btn-primary portfolio-link' role='button' href='#portfolioModal".$query2['item_id']."' target='_parent' style='width: 256px;margin-top: 13px;' data-toggle='modal'>Pesan</a>
                    <p class='text-muted'></p>
                </div>
            </div>"; 
            }?>
            <!-- END BARANG -->
            </div>
        </div>
    </section>
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
    <?php
    $query1=mysql_connect("localhost","root","");
    mysql_select_db("kefe",$query1);
    $start=0;
    $limit=8;
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $start=($id-1)*$limit;
    }
    $query=mysql_query("select * from items LIMIT $start, $limit");
    while($query2=mysql_fetch_array($query))
    
    {
    echo "
    <div class='modal fade portfolio-modal text-center' role='dialog' tabindex='-1' id='portfolioModal".$query2['item_id']."'>
        <div class='modal-dialog modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-body'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-lg-8 mx-auto'>
                                <div class='modal-body'>
                                    <h2 class='text-uppercase'>".$query2['item_name']."</h2>
                                    <p class='item-intro text-muted'>".$query2['item_explain'].".</p><img src='../!admin/item_images/".$query2['item_image']."' class='img-fluid d-block mx-auto'>
                                    <ul class='list-unstyled'>
                                    <center>
                                        <form role='form' method='post' action='save_order.php'>
                                        <div class='input-group col-sm-5'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='basic-addon1'>Harga</span>
                                        </div>
                                        <input type='text' class='form-control disabled' value=".$query2['item_price']." name='order_price' placeholder='Rp ".$query2['item_price']."' aria-label='Username' aria-describedby='basic-addon1' readonly>
                                        <input type='hidden' value=".$query2['item_name']." name='order_name' class='hidden'>
                                        </div>

                                        <div class='input-group col-sm-5'>
                                        <input type='number' name='order_quantity' class='form-control' placeholder='Kuantitas' min='0' aria-label='Recipient's username' aria-describedby='basic-addon2'>
                                        <div class='input-group-append'>
                                            <button class='btn btn-outline-danger' name='order_save' type='submit'>Beli</button>
                                        </div>
                                        </div>
                                        </form>
                                    </center>
                                    </ul><button class='btn btn-primary' type='button' data-dismiss='modal'><i class='fa fa-times'></i><span>&nbsp;Close Project</span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    }?>
    </div>
    </div>
	<!-- Modal START -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			...
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- END Modal -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="../assets/js/agency.js"></script>
    <script src="../assets/js/bs-animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
    <script>
            $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
            });
          </script>
		  <?php 
    if (isset($_GET['msg'])){
        if($_GET['msg']=="error"){
    echo('<script type="text/javascript">');
    echo('$(window).on("load",function(){');
    echo('    $("#keranjang").modal("show");');
    echo('});');
    echo('</script>');
        }
    }
    ?>
</body>

</html>