<?php
session_start();

if(!$_SESSION['admin_username'])
{

    #header("Location: ../index.php");
}

?>

<?php

	require_once 'config.php';
	
	if(isset($_GET['delete_id']))
	{
		
		$stmt_select = $DB_con->prepare('SELECT item_image FROM items WHERE item_id =:item_id');
		$stmt_select->execute(array(':item_id'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("item_images/".$imgRow['item_image']);
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM items WHERE item_id =:item_id');
		$stmt_delete->bindParam(':item_id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: items.php");
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
			    <a class="nav-link text-white" href="ondex.php">Dashboard</a><hr class="bg-secondary">
			  </li>
			  <li class="nav-item">
			    <a class="nav-link text-white" data-toggle="modal" href="#portfolioModal1">Tambah Item</a><hr class="bg-secondary">
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

        <!-- Mediul Modal -->
        <div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal1">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-body">
	                    <div class="container">
	                        <div class="row">
	                            <div class="col-lg-8 mx-auto">
	                                <div class="modal-body">
	                                    <form enctype="multipart/form-data" method="post" action="additem.php">
	                                       <fieldset>
	                                        
	                                            
	                                                <p>Name of Item:</p>
	                                                <div class="form-group">
	                                                
	                                                    <input class="form-control" placeholder="Name of Item" name="item_name" type="text" required>
	                                               
	                                                 
	                                                </div>
	                                            
	                                                
	                                                <p>Price:</p>
	                                                <div class="form-group">
	                                                
	                                                    <input id="priceinput" class="form-control" placeholder="Price" name="item_price" type="text" required>
	                                               
	                                                 
	                                                </div>
	                                                
	                                                
	                                                <p>Choose Image:</p>
	                                                <div class="form-group">     
	                                                    <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
	                                               
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
	                </div>
	            </div>
	        </div>
    	</div>


       	<!-- End Modal -->

    	<div class="col-md-10 p-3 pt-5 ">
    	<div id="page-wrapper">	
			 <div class="alert alert-danger">
                        
                          <center> <h3><strong>Item Management</strong> </h3></center>
						  
						  </div>
						  
						  <br />
						  
						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name of Item</th>
				  <th>Price</th>
				  <th>Explain</th>
				  <th>Date Added</th>
                  <th>Actions</th>
                 
                </tr>
              </thead>
              <tbody>
				  <?php
	include("config.php");
		$stmt = $DB_con->prepare('SELECT * FROM items');
		$stmt->execute();
		
		if($stmt->rowCount() > 0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				extract($row);
				
				
				?>
                <tr>
                  <td>
				<center> <img src="item_images/<?php echo $item_image; ?>" class="img img-rounded"  width="50" height="50" /></center>
				 </td>
                 <td><?php echo $item_name; ?></td>
				 <td>&#8369; <?php echo $item_price; ?></td>
				 <td><?php echo $item_explain; ?></td>
				 <td><?php echo $item_date; ?></td>
				 
				 <td>
				
				 
				
				 <a class="btn btn-info" href="edititem.php?edit_id=<?php echo $row['item_id']; ?>" title="click for edit" onclick="return confirm('Are you sure edit this item?')"><span class='glyphicon glyphicon-pencil'></span> Edit Item</a> 
				
                  <a class="btn btn-danger" href="?delete_id=<?php echo $row['item_id']; ?>" title="click for delete" onclick="return confirm('Are you sure to remove this item?')"><span class='glyphicon glyphicon-trash'></span> Remove Item</a>
				
                  </td>
                </tr>
               
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";	
		echo '<div class="alert alert-default" style="background-color:black;">
                       <p style="color:white;text-align:center;">
                       &copy 2020 Keefe | All Rights Reserved |  Design by : NakEdgy Team

						</p>
                        
                    </div>
            
        </div>';
        		echo "</div>";
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
	
	<!-- Mediul Modal -->
			<div class="modal fade portfolio-modal text-center" role="dialog" tabindex="-1" id="portfolioModal1">
			        <div class="modal-dialog modal-lg" role="document">
			            <div class="modal-content">
			                <div class="modal-body">
			                    <div class="container">
			                        <div class="row">
			                            <div class="col-lg-8 mx-auto">
			                                <div class="modal-body">
			                                    <h2 class="text-uppercase">Project Name</h2>
			                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p><img src="assets/img/portfolio/1-full.jpg" class="img-fluid d-block mx-auto">
			                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae
			                                        cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
			                                    <ul class="list-unstyled">
			                                        <li>Date: January 2017</li>
			                                        <li>Client: Threads</li>
			                                        <li>Category: Illustration</li>
			                                    </ul><button class="btn btn-primary" type="button" data-dismiss="modal"><i class="fa fa-times"></i><span>&nbsp;Close Project</span></button></div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
     </body>
	              
        <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#example').dataTable();
    });
    </script>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</html>
