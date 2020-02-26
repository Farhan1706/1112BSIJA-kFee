<?php
session_start();

include("../!admin/db_conection.php");

$no_meja=$_SESSION['Meja'];
$pemesan=$_SESSION['pemesan'];

if(isset($_POST['order_save'])){

$no_meja = $_SESSION['Meja'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$order_total=$order_price * $order_quantity;
$order_status='Pending';

$save_order_details="insert into orderdetails (order_id,user_id,order_name,order_price,order_quantity,order_total,order_status,order_date) VALUE ('','$no_meja','$order_name', $order_price, $order_quantity , $order_total,'$order_status',CURDATE())";
mysqli_query($dbcon,$save_order_details);

echo "<script>alert('Item successfully added to cart!')</script>";				
echo("$no_meja");
echo("$order_name");
echo("$order_price");
echo("$order_quantity");
echo("$order_total");
header("Location:Pesan.php");

}

?>
