<?php
session_start();

if(!$_SESSION['admin_username'])
{

    #header("Location: ../index.php");
}

?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM items WHERE item_id =:item_id');
		$stmt_edit->execute(array(':item_id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: items.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$item_name = $_POST['item_name'];
		$item_price = $_POST['item_price'];		
			
		$imgFile = $_FILES['item_image']['name'];
		$tmp_dir = $_FILES['item_image']['tmp_name'];
		$imgSize = $_FILES['item_image']['size'];
		$item_explain = $_POST['item_explain'];

		if($imgFile)
		{
			$upload_dir = 'item_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$itempic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['item_image']);
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
					echo "<script>alert('Sorry, your file is too large it should be less then 5MB')</script>";				
					 
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";	
              echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";					
			}	
		}
		else
		{
		
			$itempic = $edit_row['item_image']; 
		}	
						
		

		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE items
									     SET item_name=:item_name, 
											 item_price=:item_price, 
										     item_image=:item_image,
										     item_explain=:item_explain 
								       WHERE item_id=:item_id');
			$stmt->bindParam(':item_name',$item_name);
			$stmt->bindParam(':item_price',$item_price);
			$stmt->bindParam(':item_image',$itempic);
			$stmt->bindParam(':item_explain',$item_explain);
			$stmt->bindParam(':item_id',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='items.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
				 echo "<script>alert('Sorry Data Could Not Updated !')</script>";				
			}
		
		}
		
						
	}
	
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
</head>

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-dark" id="mainNav">
        <div class="container"><a class="navbar-brand" href="#page-top">Keefe</a><button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbarResponsive" type="button" data-toogle="collapse" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto mt-0 p-1 text-uppercase">
				    	<form class="form-inline ml-1 mt-1">
				      		<input class="form-control mr-sm-1" type="search" placeholder="Search" aria-label="Search">
				      		<button class="btn btn-outline-success my-2 my-sm-0 mr-3" type="submit">Search</button>
				    	</form>
				    <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          ADMIN
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Edit</a>
			          <a class="dropdown-item" href="#">Another action</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="#">log out</a>
			        </div>
			        </li>
                </ul>
            </div>
        </div>
	</div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/header-bg.jpg');">
        <div class="container"></div>
    </header>
    <body>
        <div class="row mt-5 pt-5 mr-5">
        <div class="col-md-2 bg-dark op-4 p-5 pt-5">
			<ul class="nav flex-column ml-1 mb-5 md-3">
			  
			  <li class="nav-item">
			    <a class="nav-link text-white" href="index.php">Dashboard</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" href="items.php">Tambah Item</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" href="items.php">Kelola Item</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" href="customers.php">Customers</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" href="orderdetails.php">Detail Pemesanan</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" href="logout.php">Logout</a><hr class="bg-secondary">
			  </li>
			</ul>
        </div>
    	<div class="col-md-10 p-2 pt-5 ">
        <div id="page-wrapper">

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
       
        <?php
	}
	?>
			 <div class="alert alert-info ml-4">
                        
                          <center> <h3><strong>Update Item</strong> </h3></center>
						  
						  </div>
	<table class="table table-bordered table-responsive col-md p-5 ml-3">
	 
    <tr>
    	<td><label class="control-label">Nama Produk.</label></td>
        <td><input class="form-control" type="text" name="item_name" value="<?php echo $item_name; ?>" required /></td>
    </tr>
	
	 <tr>
    	<td><label class="control-label">Harga.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="item_price" value="<?php echo $item_price; ?>" required /></td>
    </tr>
	

    <tr>
    	<td><label class="control-label">Gambar.</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="item_images/<?php echo $item_image; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="item_image" accept="image/*" />
        </td>
    </tr>

    <tr>
    	<td><label class="control-label">Keterangan.</label></td>
        <td>
        	<div class="form-group">
				<textarea class="form-control" id="exampleFormControlTextarea1" type="text" name="item_explain" value="<?php echo $item_explain; ?>" rows="3"></textarea>
			</div>
        </td>
    </tr>

    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-danger" href="items.php"> <span class="glyphicon glyphicon-backward"></span> Cancel </a>
        
        </td>
    </tr>
    
    </table>					  
	
    
</form>
	 
	 <div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2016 EDGE Skateshop| All Rights Reserved |  Design by : EDGE Team

						</p>
                        
                    </div>		  
						  
						  
			
			
            
                </div>
            </div>

           

           
        </div>
		
		
		
    </div>
    <!-- /#wrapper -->

	
	<!-- Mediul Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Upload Items</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="additems.php">
                   <fieldset>
					
						
                            <p>Nama produk:</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Name of Item" name="item_name" type="text" required>
                           
							 
							</div>
							
							
							
							
							
							
							
							
							<p>Harga:</p>
                            <div class="form-group">
							
                                <input id="priceinput" class="form-control" placeholder="Price" name="item_price" type="text" required>
                           
							 
							</div>
							
							
							<p>Pilih Gambar:</p>
							<div class="form-group">
						
							 
                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
                           
							</div>
				   
							<p>:</p>
                            <div class="form-group">
							
                                <input id="priceinput" class="form-control" placeholder="Price" name="item_price" type="text" required>
                           
							 
							</div>
							
							
							<p>Keterangan:</p>
							<div class="form-group">
						
							 
                                <input id="item_explain" class="form-control"  type="text" required/>
                           
							</div>						   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-success btn-md" name="item_save">Save</button>
				
				 <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>
		
		
		
	  	  <script>
   
    $(document).ready(function() {
        $('#priceinput').keypress(function (event) {
            return isNumber(event, this)
        });
    });
  
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }    
</script>
</body>
</html>
