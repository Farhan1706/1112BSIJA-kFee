<?php
session_start();

if(!$_SESSION['admin_username'])
{

}

?>

<?php
include("db_conection.php");
if(isset($_POST['item_save']))
{
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];

 
 $check_item="select * from items WHERE item_name='$item_name'";
    $run_query=mysql_query($dbcon,$check_item);

    if(mysql_num_rows($run_query)>0)
    {
echo "<script>alert('Item is already exist, Please try another one!')</script>";
 echo"<script>window.open('ondex.php','_self')</script>";
exit();
    }
 
$imgFile = $_FILES['item_image']['name'];
$tmp_dir = $_FILES['item_image']['tmp_name'];
$imgSize = $_FILES['item_image']['size'];

$upload_dir = 'item_images/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;


				
	
			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
					$saveitem="insert into items (item_name,item_price,item_image,item_date) VALUE ('$item_name','$item_price','$itempic',CURDATE())";
					mysqli_query($dbcon,$saveitem);
					 echo "<script>alert('Data successfully saved!')</script>";				
					 echo "<script>window.open('items.php')</script>";
				}
				else{
					
					 echo "<script>alert('Sorry, your file is too large.')</script>";				
					 echo "<script>window.open('items.php')</script>";
				}
			}
			else{
				
				 echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";				
					 echo "<script>window.open('items.php')</script>";
				
			}
		
	
		

}

?>