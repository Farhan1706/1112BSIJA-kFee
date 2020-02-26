<?php
session_start();
if(!$_SESSION['Meja'])
{
    header("location:destroy.php");
    die();
}
// $user_email = '';
#$user_id = '';
$user_id=$_SESSION['Meja'];
?>
<?php
 include("../!admin/DB_con.php");
		// $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		// $stmt_edit->execute(array(':user_email'=>$user_email));
        // $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		// extract($edit_row);
		?>
		
 		<?php
 include("../!admin/DB_con.php");
        $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
        // $stmt_edit->bind_param("s",$user_id);
	    $stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
        // $edit_row = mysqli_fetch_assoc($stmt_edit);
        // $sql = "select sum(order_total) as total from orderdetails where user_id='$user_id' and order_status='Ordered'";
        // $result = mysqli_query($DB_con,$sql);
        // $row = mysqli_fetch_assoc($result);
        // extract($row);
		?>
		
 		<?php

	require_once '../!admin/DB_con.php';
	
	if(isset($_GET['delete_id']))
	{
		$stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
		$stmt_delete->bindParam(':order_id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: cart_items.php");
	}

?>
 <?php

	require_once '../!admin/DB_con.php';
	
	if(isset($_GET['update_id']))
	{
		$stmt_delete = $DB_con->prepare('update orderdetails set order_status="Ordered" WHERE order_status="Pending" and user_id =:user_id');
		$stmt_delete->bindParam(':user_id',$_GET['update_id']);
		$stmt_delete->execute();
		echo "<script>alert('Item/s successfully ordered!')</script>";	
		
		header("Location: orders.php");
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
    <link href="../assets/bootstrap/css/simple-sidebar.css" rel="stylesheet">
</head>
<body id="page-top">

    <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"> MENU</div>
            <div class="list-group list-group-flush mt-5">
              <a href="Pesan.php" class="list-group-item list-group-item-action bg-light">Pesan Makanan</a>
              <a href="#" class="list-group-item list-group-item-action bg-light">Keranjang Pesanan</a>
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
                    <h2 class="text-uppercase section-heading">Keranjang</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
            <!-- LIST BARANG -->
            <table class="table table-hover table-bordered">
            <thead align="center">
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Total</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include("../!admin/DB_con.php");
                $stmt = $DB_con->prepare("SELECT * FROM orderdetails where order_status='Pending' and user_id='$user_id'");
                $stmt->execute();
                
                if($stmt->rowCount() > 0)
                {
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($row);            
            ?>
                <tr>
                <th scope="row"><?php echo $order_name; ?></th>
                <td><?php echo $order_price; ?></td>
                <td><?php echo $order_quantity; ?></td>
                <td><?php echo $order_total; ?></td>
                <td><button type="button"  class="btn btn-outline-danger col-md" href="?delete_id=<?php echo $row['order_id']; ?>" onclick="return confirm('Apakah anda yakin?')" >Hapus</button></td>
                </tr>
                <?php
                    }
                include("../!admin/DB_con.php");
                $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Pending'");
                $stmt_edit->execute(array(':user_id'=>$user_id));
                $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
                extract($edit_row);
                // $q_showtbl = "select sum(order_total) as totalx from orderdetails where user_id='$user_id' and order_status='Pending'";
                // $showtbl = mysqli_qury($DB_con,$q_showtbl);
                // $list_table = mysqli_fetch_assoc($showtbl);
                // extract($list_table);
                echo "<tr>";
                echo "<td colspan='3' align='right'>Total Harga:";
                echo "</td>";
                echo "<td>Rp ".$totalx;
                echo "</td>";
                
                echo "<td>";
                echo "<a class='btn btn-block btn-success' href='?update_id=".$user_id."' ><span class='glyphicon glyphicon-shopping-cart'></span> Order Now!</a>";
                echo "</td>";

                echo "</tr>";
            echo "</tbody>";
            echo "</table>";
                }
                else{
                    ?>
                <div class="col-xs-12">
                    <div class="alert alert-warning">
                        <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Keranjang Kosong
                    </div>
                </div>
                <?php
            
                }
                ?>
            </table>
            <!-- END TENGAH-->
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
    </div>
    </div>
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
</body>

</html>