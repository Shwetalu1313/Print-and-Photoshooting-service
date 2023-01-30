<?php
session_start();
include('connect.php');
include ('Discount_functioin.php');
include ('nonesession_ID_response_functions.php');
noneIDrpo();
// include ('Shopping_Cart_functions.php');


$customer_id = $_SESSION['cid'];
$customer_name = $_SESSION['cname'];

// package session start
if (isset($_GET['packageID'])) 
{
	$packageID=$_REQUEST['packageID'];
	$Select="SELECT * FROM package WHERE packageID=$packageID";

			$ret=mysqli_query($connect,$Select);
			$row=mysqli_fetch_array($ret);

            $packageID2=$row['packageID'];
            $package_name=$row['package_name'];
            $package_price=$row['package_price'];
			$package_quantity=$row['Quantity'];
            $package_image=$row['package_image'];
            $package_des=$row['Description'];
            $cateID=$row['cateID'];
		
}



// feedback start
if (isset($_POST['btnfeedback'])) 
{
	$post_date = $_POST['txtdate'];
	$post_time = $_POST['txttime'];
	$comments = $_POST['fedbacks'];
	$CustomerID = $_POST['txtcustomerid'];
	$CustomerName = $_POST['txtname'];
	$packageName = $_POST['txtpackagename'];

    $insert = "INSERT INTO feedbacks 
    			(
    				Post_date, 
    				Post_time, 
    				Comments, 
    				CustomerID,
					CustomerName,
					packageName

    			)
    			VALUES 
    			(
    				'$post_date', 
    				'$post_time', 
    				'$comments', 
    				'$CustomerID',
					'$CustomerName',
					'$packageName'
				)";

    $data = mysqli_query($connect, $insert);


	if ($data) {
		echo "<script>window.alert('Giving Feedback Comlete')</script>";
		echo "<script>window.location='packages.php'</script>";
		}

}

// feedback end


// Change Diactory of Cart And Checkout (start)
function ExeCartCheck ($categoryID,$packageID) {

	if ($categoryID <> 1) {
		echo "<a href='checkoutPV.php?packageID=$packageID'><button class='tocart' type='submit' title='Make Checkout'>Make Checkout</button></a>";
	}

	elseif ($categoryID == 1) {
		echo "<a href='checkout.php?packageID=$packageID'><button class='tocart' type='submit' title='Add to Cart' name='btnAdd'>Make Checkout</button></a>";
	 } 

}
// Change Diactory of Cart And Checkout (end)


?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Package Details</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.PNG">
	<link rel="apple-touch-icon" href="images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="style.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="css/custom.css">



	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">

		<?php 

		include ('header.php'); 

		?>

		        <!-- Start Bradcaump area -->
				<div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Packages Details and Feedback</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Packages Details and Feedback</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 

        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-9 col-12">
        				<div class="wn__single__product">
        					<div class="row">
        						<div class="col-lg-6 col-12">
        							<div class="wn__fotorama__wrapper">
	        							<div class="fotorama wn__fotorama__action" data-nav="thumbs">
		        							  <a href="1.jpg"><img src="<?php echo $package_image;?>" alt=""></a>
		        							  <a href="1.jpg"><img src="<?php echo $package_image;?>" alt=""></a>
		        							  <a href="1.jpg"><img src="<?php echo $package_image;?>" alt=""></a>

	        							</div>
        							</div>
        						</div>
        						<div class="col-lg-6 col-12">
        							<div class="product__info__main">
        								<h1><?php echo $package_name;?></h1>


										<!--input hidden start -->
										<input type="hidden" name="txtpackageID" value="<?php echo $row['packageID']; ?>">
										<input type="hidden" name="txtBuyQuantity" value="1" size="3">
										<input type="hidden" name="txtprice" value="<?php discount($package_price); ?>">
										<!--input hidden start -->


        								<div class="price-box">
        									<span><?php discount($package_price);?> - MMK</span>
        									<span style="text-decoration: line-through; color: #7d6b57; font-size: 20px;"><?php echo $package_price;?> - MMK</span>
        									
        								</div>
										<div class="product__overview">
        									<p><?php echo $package_des;?></p>
        								</div>

                                        <?php
                                        $select = "SELECT * FROM category WHERE cateID='$cateID'";
                                        $query = mysqli_query($connect, $select);
                                        $row2 = mysqli_num_rows($query);
                                        if ($row2>0) {
                                            $catch = mysqli_fetch_array($query);
                                            $cateID2 = $catch['cateID'];
                                            $type = $catch['cateType'];   
                                        }
                                         

                                        ?>
										<div class="product_meta">
											<span class="posted_in">Categories: 
												<a href="#"><?php echo $type;?></a> 
											</span>
										</div>
										
										
										 <div class="box-tocart d-flex" style="margin-top:20px">
        									<div class="addtocart__actions">
        										<?php 
        										ExeCartCheck($cateID2,$packageID2);
												?>

        									</div>
											<div class="product-addto-links clearfix">
												<a class="wishlist" href="#"></a>
										</div>
        								</div>
										<div class="product-share">
											<ul>
												<li class="categories-title">Share :</li>
												<li>
													<a href="#">
														<i class="icon-social-twitter icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-tumblr icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-facebook icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-linkedin icons"></i>
													</a>
												</li>
											</ul>
										</div>
        							</div>
        						</div>
        					</div>
        				</div>

        				<div class="product__info__detailed">
							<div class="pro_details_nav nav justify-content-start" role="tablist">
                                <a class="nav-item nav-link  active" data-toggle="tab" href="#nav-details" role="tab">Descriptions</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Form information</a>	                           
	                        </div>
	                        <div class="tab__container">
	                        	<!-- Start Single Tab Content -->
	                        	<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
									<div class="description__attribute">
										<p><?php echo $package_des;?></p>

									</div>
	                        	</div>
	                        	<!-- End Single Tab Content -->

	                        	<!-- Start Single Tab Content -->
	                        	<form action="single_product.php" method="POST">
	                        	<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
		                        	<div class="review__attribute">

										<div class="review-content">
											<p><?php echo $customer_name;?></p>
											<p name="txttime">post time - <?php date_default_timezone_set("Asia/Yangon"); echo date("h:i:sa");?></p>
											<p name="txtdate">post date - <?php echo date('Y-m-d'); ?></p>
										</div>
									</div>

								</div>

									<div class="account__form">
									<div class="review-fieldset">
									<h2>Feedback section:</h2>
									<h3><?php echo $package_name;?></h3>
									<div class="review_form_field">
										<div class="input__box">
											<input type="text" name="txtname" value="<?php echo $customer_name;?>" hidden>
											<input type="text" name="txtcustomerid" value="<?php echo $customer_id;?>"hidden>
											<input type="text" name="txttime" value="<?php date_default_timezone_set("Asia/Yangon"); echo date("h:i:sa")?>"hidden>
											<input type="text" name="txtdate" value="<?php echo date('Y-m-d');?>"hidden>
											<input type="text" name="txtpackagename" value="<?php echo $package_name;?>"hidden>


										</div>
										<div class="input__box">
											<span>Feedbacks</span>
											<textarea name="fedbacks"></textarea>
										</div>
											<div class="review-form-actions">
												<button type="submit" name="btnfeedback">Submit</button>
											</div>

									</div>
									</div>
		                        	</div>
		                        	</form>
	                        	<!-- End Single Tab Content -->
	                        </div>
        				</div>
        			</div>
        			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        				<div class="shop__sidebar">
        					<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">These Days are <div style="color: red;"> not valid </div> to get Photoshooting services></h3>
								<ul style="overflow-y:scroll; height:230px;">
								<ul>
									<form action="packages.php" method="get">
									<?php
										$current_date = date('Y-m-d');

										$select = "SELECT DISTINCT un.UnDate FROM undate un
												WHERE un.UnDate >= '$current_date'
												UNION
												SELECT DISTINCT ord.ShootingDate FROM orders ord
												WHERE ord.ShootingDate >= '$current_date'
												ORDER BY UnDate ASC";

										$query = mysqli_query($connect, $select);
										$row = mysqli_num_rows($query);

										for ($b=0; $b < $row; $b++) { 
											$catch = mysqli_fetch_array($query);
											$UnDate = $catch['UnDate'];


										echo "<li>Year - Month - Day ( $UnDate )</li>";
									}

									?>
									</form>
								</ul>
								</ul>
        					</aside>
							<!-- Start Single Widget -->
        					<aside class="widget comment_widget">
        						<h3 class="widget-title" style="margin: bottom 30px;">Feedbacks</h3>
        						<ul style="overflow-y:scroll; height:250px;">
									<?php
										$selectF = "SELECT * FROM feedbacks WHERE packageName='$package_name'";
										$queryF = mysqli_query($connect, $selectF);

										while ($rowF = mysqli_fetch_array($queryF)) { 
											$CustomerName = $rowF['CustomerName'];
											$Comments = $rowF['Comments'];
											?>
											<li>
												<div class="post-wrapper">
													<div class="content">
														<p><?php echo "<b>". $CustomerName . "</b>" ." "."says:";?></p>
														<p><?php echo $Comments;?></p>
													</div>
												</div>
											</li>
											<?php
										}
									?>
        						</ul>
        					</aside>
        					<!-- End Single Widget -->

        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <!-- End main Content -->

		<?php 
		
		include('footer.php'); 

		?> 
		

	</div>
	<!-- //Main wrapper -->

	

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	
</body>
</html>