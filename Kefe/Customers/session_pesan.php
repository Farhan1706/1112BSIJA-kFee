<?php
session_start();

?>
<?php

include("../!admin/database.php");

if(isset($_POST['Meja']))
{
    $no_meja=$_POST['Meja'];
    $pemesan=$_POST['pemesan'];
 
         
$_SESSION['Meja']=$no_meja;
$_SESSION['pemesan']=$pemesan;
 echo "<script>window.open('Pesan.php','_self')</script>";
  
}
    else{
        echo "<script>alert('Mohon Untuk Mengisi Nomor Meja')</script>";
		  echo "<script>window.open('Meja.php','_self')</script>";
		
		 exit();
		
    }
?>