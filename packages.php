<?php
session_start();
include ('connect.php');
include ('Discount_functioin.php');

// mysqli_close($connect);



?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Packages</title>
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
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

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
                        	<h2 class="bradcaump-title">Packages</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Packages</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Shop Page -->
        <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
        				<div class="shop__sidebar">

        					<aside class="wedget__categories poroduct--cat">
        						<h3 class="wedget__title">Packages Category</h3>
        						<ul>
                                    <form action="packages.php" method="get">
                                <?php
                                $select = "SELECT * FROM category";
                                $query = mysqli_query($connect, $select);
                                $row = mysqli_num_rows($query);

                                for ($b=0; $b < $row; $b++) { 
                                    $catch = mysqli_fetch_array($query);
                                    $cateID = $catch['cateID'];
                                    $type = $catch['cateType'];
                                    echo "<a href='packages.php?cateID=$cateID'><li>$type</li></a>";
                                    
                                }
                                ?>
                                </form>
                                
        						</ul>
        					</aside>


        					<aside class="wedget__categories pro--range">
        						<h3 class="wedget__title">Filter by price</h3>
        						<div class="content-shopby">
        						    <div class="price_filter s-filter clear">
        						        <form action="packages.php" method="Post">
                                            <?php
                                            $sql = "SELECT MAX(package_price) as maximum FROM package";
                                            $make =mysqli_query($connect,$sql);
                                            $row = mysqli_fetch_array($make);

                                            $sql2 = "SELECT MIN(package_price) as mainimum FROM package";
                                            $make2 =mysqli_query($connect,$sql2);
                                            $row2 = mysqli_fetch_array($make2);
                                            ?>
                                            <input type="range" name="txtfilter" id="myRange" min='<?php echo $row2['mainimum'];?>'
                                                        max='<?php echo $row['maximum'];?>'>
                                            <div class="slider__range--output">
        						                <div class="price__output--wrap">
        						                    <div class="price--output">
        						                        <span>Price :</span><span id="demo"></span>
        						                    </div><br>
        						                    <div class="price--filter">
        						                        <button type="submit" name="btnfilter" class="btn btn-warning">FILTER</button>
        						                    </div>
        						                </div>
        						            </div>
        						        </form>
        						    </div>
        						</div>
        					</aside>
        					
        				</div>
        			</div>


        			<div class="col-lg-9 col-12 order-1 order-lg-2">
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									<div class="shop__list nav justify-content-center" role="tablist">
										<a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
			                            <!-- <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a> -->
			                        </div>
			                        <p>Showing results</p>
			                        <div class="orderby__wrapper">
									<form action="packages.php" method="POST">
                                    <input type="text" name="txtSearch" placeholder="Search Here ...package Name" style="width: 300px;height: 25px; border-radius:10px 0 0 10px"/>
                                    <button name="btnSearch" 
                                    		style="width: 55px;
                                    			   height: 25px; 
                                    			   border-radius:0 10px 10px 0;
                                    			   border: 1px solid grey; 
                                    			   background: #2196F3;
                                    			   cursor: pointer;" 
                                    		hover='background: #0b7dda;'><i class="fa fa-search"></i></button>
									</form>
			                        </div>
		                        </div>
        					</div>
        				</div>

						


<!-- package searching starrt -->

						<div class="tab__container">
						
<!-- sorting start-->
						<div class='shop-grid tab-pane fade show active' id='nav-grid' role='tabpanel'>

						<?php
						if (isset($_GET['cateID'])){
							$cateID = $_REQUEST['cateID'];
							$query="SELECT * FROM package 
									WHERE cateID='$cateID' 
									ORDER BY cateID";
							$ret=mysqli_query($connect,$query);
							$count=mysqli_num_rows($ret);

						if (empty($count)) 
						{
							echo "<p>No Package found</p>";
							exit();
						}
						else
						{
							// looping start for row
							for ($a=0; $a < $count ; $a+=3) 
						{        
							#WE USE LIMIT FUNCTION
							$select="SELECT * FROM package 
									WHERE cateID='$cateID' 
									ORDER BY cateID 
									LIMIT $a,3";

							$result=mysqli_query($connect,$select);
							$count2=mysqli_num_rows($result);
							?>
							<div class='row'>
							<?php
							for ($v=0; $v < $count2 ; $v++) 
							{ 
								$data=mysqli_fetch_array($result);
								$packageID2=$data['packageID'];
								$package_name=$data['package_name'];
								$package_price=$data['package_price'];
								$package_image=$data['package_image'];
								$package_des=$data['Description'];
								list($width,$height)=getimagesize($package_image);
								$w=$width/270;
								$h=$height/340;
							?>
								<!-- Start Single Product -->
								<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
									<div class="product__thumb">
										<a class="first__img" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
										<a class="second__img animation1" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
										<div class="hot__box">
											<span class="hot-label">15% OFF</span>
										</div>
									</div>
									<div class="product__content content--center">
										<h4><a <?php echo "href='single_product.php?packageID=$packageID2'";?>><?php echo $package_name ?></a></h4>
										<ul class="prize d-flex">
												<li><?php discount($package_price) ?> MMK </li>
												<li class="old_prize"><?php echo $package_price; ?> MMk </li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" <?php echo "href='single_product.php?packageID=$packageID2'";?>><i class="bi bi-shopping-bag4"></i></a></li>
													<!-- <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li> -->
													
													<!-- <li><a data-toggle='modal' title='Quick View' class='quickview modal-view detail-link' href='#productmoda'><i class='bi bi-search'></i></a></li> -->
												</ul>
											</div>
										</div>
										<div class="product__hover--content">
											<ul class="rating d-flex">
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
									</div>
								</div>
								<!-- End Single Product -->

							<?php
								}
								?>
							</div> 			
							<!-- shop grid end -->
							<?php
								}
							}
							?>
							</div>

							<div id="quickview-wrapper">
							<!-- Modal -->
							<div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
								<div class="modal-dialog modal__container" role="document">
									<div class="modal-content">
										<div class="modal-header modal__header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<div class="modal-product">
												<!-- Start product images -->
												<div class="product-images">
													<div class="main-image images">

														<img alt="big images" src="<?php echo $package_image; ?>">
													</div>
												</div>
												<!-- end product images -->
												<div class="product-info">

													<h1><?php echo $package_name; ?></h1>
													<div class="rating__and__review">
														<ul class="rating">
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
														</ul>

													</div>
													<div class="price-box-3">
														<div class="s-price-box">
																<li><b><?php discount($package_price); ?> MMK </b></li>
																<li class="old_prize" style="text-decoration: line-through; color:crimson;"><?php echo $package_price; ?> MMk </li>
														</div>
													</div>
													<div class="quick-desc">
														<?php
														echo $package_des; ?>
													</div>

													<div class="social-sharing">
														<div class="widget widget_socialsharing_widget">
															<h3 class="widget-title-modal">Share this product</h3>
															<ul class="social__net social__net--2 d-flex justify-content-start">
																<li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
																<li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
																<li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
																<li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="addtocart-btn">
														<?php echo "<a href='single_product.php?packageID=$packageID2'>Package Details</a>" ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END QUICKVIEW PRODUCT -->
<!-- sorting end -->

							


<!-- filtering start -->
<!-- shop grid start -->
						<div class='shop-grid tab-pane fade show active' id='nav-grid' role='tabpanel'>

						<?php
						}

						elseif (isset($_POST['btnfilter'])){
							$filterprice = $_POST['txtfilter'];

							$sql3 = "SELECT MIN(package_price) as mainimum FROM package";
							$make3 =mysqli_query($connect,$sql3);
							$row3 = mysqli_fetch_array($make3);
							$minium = $row3['mainimum'];


							$query="SELECT * FROM package
									 WHERE package_price
									 BETWEEN $minium AND $filterprice
									 Order by package_price";
							$ret=mysqli_query($connect,$query);
							$count=mysqli_num_rows($ret);

						if (empty($count)) 
						{
							echo "<p>No Package found</p>";
							exit();
						}
						else
						{
							// looping start for row
							for ($a=0; $a < $count ; $a+=3) 
						{        
							#WE USE LIMIT FUNCTION
							$select="SELECT * FROM package
									WHERE package_price
									Between $minium AND $filterprice  
									ORDER BY package_price 
									LIMIT $a,3";

							$result=mysqli_query($connect,$select);
							$count2=mysqli_num_rows($result);
							?>
							<div class='row'>
							<?php

							for ($v=0; $v < $count2 ; $v++) 
							{ 
								$data=mysqli_fetch_array($result);
								$packageID2=$data['packageID'];
								$package_name=$data['package_name'];
								$package_price=$data['package_price'];
								$package_image=$data['package_image'];
								$package_des=$data['Description'];
								list($width,$height)=getimagesize($package_image);
								$w=$width/270;
								$h=$height/340;

							?>
								<!-- Start Single Product -->
								<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
									<div class="product__thumb">
										<a class="first__img" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
										<a class="second__img animation1" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
										<<div class="hot__box">
											<span class="hot-label">15% OFF</span>
										</div>
									</div>
									<div class="product__content content--center">
										<h4><a <?php echo "href='single_product.php?packageID=$packageID2'";?>><?php echo $package_name ?></a></h4>
										<ul class="prize d-flex">
												<li><?php discount($package_price) ?> MMK </li>
												<li class="old_prize"><?php echo $package_price; ?> MMk </li>
										</ul>
										<div class="action">
											<div class="actions_inner">
												<ul class="add_to_links">
													<li><a class="cart" <?php echo "href='single_product.php?packageID=$packageID2'";?>><i class="bi bi-shopping-bag4"></i></a></li>
													<!-- <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li> -->
													
													<!-- <li><a data-toggle='modal' title='Quick View' class='quickview modal-view detail-link' href='#productmodal'><i class='bi bi-search'></i></a></li> -->
												</ul>
											</div>
										</div>
										<div class="product__hover--content">
											<ul class="rating d-flex">
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li class="on"><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
									</div>
								</div>
								<!-- End Single Product -->
							<!-- </div> -->
							<?php
								}
								?>
							</div>
							<!-- shop grid end -->
							<?php
								}
							}
							?>

						</div>

						<div id="quickview-wrapper">
							<!-- Modal -->
							<div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
								<div class="modal-dialog modal__container" role="document">
									<div class="modal-content">
										<div class="modal-header modal__header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<div class="modal-product">
												<!-- Start product images -->
												<div class="product-images">
													<div class="main-image images">

														<img alt="big images" src="<?php echo $package_image; ?>">
													</div>
												</div>
												<!-- end product images -->
												<div class="product-info">

													<h1><?php echo $package_name; ?></h1>
													<div class="rating__and__review">
														<ul class="rating">
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
														</ul>

													</div>
													<div class="price-box-3">
														<div class="s-price-box">
																<li><b><?php discount($package_price); ?> MMK </b></li>
																<li class="old_prize" style="text-decoration: line-through; color:crimson;"><?php echo $package_price; ?> MMk </li>
														</div>
													</div>
													<div class="quick-desc">
														<?php
														echo $package_des; ?>
													</div>

													<div class="social-sharing">
														<div class="widget widget_socialsharing_widget">
															<h3 class="widget-title-modal">Share this product</h3>
															<ul class="social__net social__net--2 d-flex justify-content-start">
																<li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
																<li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
																<li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
																<li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="addtocart-btn">
														<?php echo "<a href='single_product.php?packageID=$packageID2'>Package Details</a>" ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END QUICKVIEW PRODUCT -->
<!-- filtering end -->

<!-- text searching start -->
							<!-- shop grid start -->
							<div class='shop-grid tab-pane fade show active' id='nav-grid' role='tabpanel'>

							<?php
							}

							elseif (isset($_POST['btnSearch'])){
								$searchtxt = $_POST['txtSearch'];

								$query="SELECT * FROM package
										WHERE package_name
										Like '%$searchtxt%'
										Order by CateID";
								$ret=mysqli_query($connect,$query);
								$count=mysqli_num_rows($ret);

							if (empty($count)) 
							{
								echo "<p>No Package found</p>";
								exit();
							}
							else
							{
								// looping start for row
								for ($a=0; $a < $count ; $a+=3) 
							{        
								#WE USE LIMIT FUNCTION
								$select="SELECT * FROM package
										WHERE package_name
										Like '%$searchtxt%'
										Order by CateID 
										LIMIT $a,3";

								$result=mysqli_query($connect,$select);
								$count2=mysqli_num_rows($result);
								?>
								<div class='row'>
								<?php

								for ($v=0; $v < $count2 ; $v++) 
								{ 
									$data=mysqli_fetch_array($result);
									$packageID2=$data['packageID'];
									$package_name=$data['package_name'];
									$package_price=$data['package_price'];
									$package_image=$data['package_image'];
									$package_des=$data['Description'];
									list($width,$height)=getimagesize($package_image);
									$w=$width/270;
									$h=$height/340;
	
									$newprice;
								?>
									<!-- Start Single Product -->
									<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="product__thumb">
											<a class="first__img" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
											<a class="second__img animation1" style="width: 270px; height: 340px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
											<div class="hot__box">
												<span class="hot-label">15% OFF</span>
											</div>
										</div>
										<div class="product__content content--center">
											<h4><a <?php echo "href='single_product.php?packageID=$packageID2'";?>><?php echo $package_name ?></a></h4>
											<ul class="prize d-flex">
												<li><?php discount($package_price) ?> MMK </li>
												<li class="old_prize"><?php echo $package_price; ?> MMk </li>
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="cart" <?php echo "href='single_product.php?packageID=$packageID2'";?>><i class="bi bi-shopping-bag4"></i></a></li>
														<!-- <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li> -->
														
														<!-- <li><a data-toggle='modal' title='Quick View' class='quickview modal-view detail-link' href='#productmodal'><i class='bi bi-search'></i></a></li> -->
												</div>
											</div>
											<div class="product__hover--content">
												<ul class="rating d-flex">
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
											</div>
										</div>
									</div>
									<!-- End Single Product -->
								<!-- </div> -->
								<?php
									}
									?>
								</div>
								<!-- shop grid end -->
								<?php
									}
								}
								?>

							</div>

							<div id="quickview-wrapper">
							<!-- Modal -->
							<div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
								<div class="modal-dialog modal__container" role="document">
									<div class="modal-content">
										<div class="modal-header modal__header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<div class="modal-product">
												<!-- Start product images -->
												<div class="product-images">
													<div class="main-image images">

														<img alt="big images" src="<?php echo $package_image; ?>">
													</div>
												</div>
												<!-- end product images -->
												<div class="product-info">

													<h1><?php echo $package_name; ?></h1>
													<div class="rating__and__review">
														<ul class="rating">
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
														</ul>

													</div>
													<div class="price-box-3">
														<div class="s-price-box">
																<li><b><?php discount($package_price); ?> MMK </b></li>
																<li class="old_prize" style="text-decoration: line-through; color:crimson;"><?php echo $package_price; ?> MMk </li>
														</div>
													</div>
													<div class="quick-desc">
														<?php
														echo $package_des; ?>
													</div>

													<div class="social-sharing">
														<div class="widget widget_socialsharing_widget">
															<h3 class="widget-title-modal">Share this product</h3>
															<ul class="social__net social__net--2 d-flex justify-content-start">
																<li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
																<li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
																<li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
																<li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="addtocart-btn">
														<?php echo "<a href='single_product.php?packageID=$packageID2'>Package Details</a>" ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END QUICKVIEW PRODUCT -->

<!-- None start -->
							<!-- shop grid start -->
							<div class='shop-grid tab-pane fade show active' id='nav-grid' role='tabpanel'>

							<?php
							}

							else{

								$query="SELECT * FROM package
										Order by CateID";
								$ret=mysqli_query($connect,$query);
								$count=mysqli_num_rows($ret);

							if (empty($count)) 
							{
								echo "<p>No Package found</p>";
								exit();
							}
							else
							{
								// looping start for row
								for ($a=0; $a < $count ; $a+=3) 
							{        
								#WE USE LIMIT FUNCTION
								$select="SELECT * FROM package
										Order by CateID 
										LIMIT $a,3";

								$result=mysqli_query($connect,$select);
								$count2=mysqli_num_rows($result);
								?>
								<div class='row'>
								<?php

								for ($v=0; $v < $count2 ; $v++) 
								{ 
									$data=mysqli_fetch_array($result);
									$packageID2=$data['packageID'];
									$package_name=$data['package_name'];
									$package_price=$data['package_price'];
									$package_image=$data['package_image'];
									$package_des=$data['Description'];
									list($width,$height)=getimagesize($package_image);
									$w=$width/270;
									$h=$height/340;
	
								?>
									<!-- Start Single Product -->
									<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="product__thumb">
											<a class="first__img" style="width: 270px; height: 330px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
											<a class="second__img animation1" style="width: 270px; height: 330px;" <?php echo "href='single_product.php?packageID=$packageID2'";?>><img src="<?php echo $package_image ?>" alt="product image"></a>
											 <div class="hot__box">
												<span class="hot-label">15% OFF</span>
											</div>
										</div>
										<div class="product__content content--center">
											<h4><a <?php echo "href='single_product.php?packageID=$packageID2'";?>><?php echo $package_name ?></a></h4>
											<ul class="prize d-flex">
												<li><?php discount($package_price) ?> MMK </li>
												<li class="old_prize"><?php echo $package_price; ?> MMk </li>
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="cart" <?php echo "href='single_product.php?packageID=$packageID2'";?>><i class="bi bi-shopping-bag4"></i></a></li>
														<!-- <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li> -->
														
														<!-- <li><a data-toggle='modal' title='Quick View' class='quickview modal-view detail-link' href='#productmodal'><i class='bi bi-search'></i></a></li> -->
													</ul>
												</div>
											</div>
											<div class="product__hover--content">
												<ul class="rating d-flex">
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
											</div>
										</div>
									</div>
									<!-- End Single Product -->
								<!-- </div> -->
								<?php
									}
									?>
								</div>
								<!-- shop grid end -->
								<?php
									}
								}
								?>

							</div>
							<div id="quickview-wrapper">
							<!-- Modal -->
							<div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
								<div class="modal-dialog modal__container" role="document">
									<div class="modal-content">
										<div class="modal-header modal__header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											<div class="modal-product">
												<!-- Start product images -->
												<div class="product-images">
													<div class="main-image images">

														<img alt="big images" src="<?php echo $package_image; ?>">
													</div>
												</div>
												<!-- end product images -->
												<div class="product-info">

													<h1><?php echo $package_name; ?></h1>
													<div class="rating__and__review">
														<ul class="rating">
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
															<li><span class="ti-star"></span></li>
														</ul>

													</div>
													<div class="price-box-3">
														<div class="s-price-box">
																<li><b><?php discount($package_price); ?> MMK </b></li>
																<li class="old_prize" style="text-decoration: line-through; color:crimson;"><?php echo $package_price; ?> MMk </li>
														</div>
													</div>
													<div class="quick-desc">
														<?php
														echo $package_des; ?>
													</div>

													<div class="social-sharing">
														<div class="widget widget_socialsharing_widget">
															<h3 class="widget-title-modal">Share this product</h3>
															<ul class="social__net social__net--2 d-flex justify-content-start">
																<li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
																<li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
																<li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
																<li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
															</ul>
														</div>
													</div>
													<div class="addtocart-btn">
														<?php echo "<a href='single_product.php?packageID=$packageID2'>Package Details</a>" ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END QUICKVIEW PRODUCT -->

							<?php
							}
							?>
							<!-- None end -->




						</div>
						</div>
        		</div>
        	</div>
        </div>
        <!-- End Shop Page -->
		<!-- Footer Area -->
		<?php 

		include ('footer.php');

		 ?>
		<!-- //Footer Area -->
		<!-- QUICKVIEW PRODUCT -->
		</div>
		<!-- //Main wrapper -->

		<!-- JS Files -->
		<script src="js/vendor/jquery-3.2.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/active.js"></script>
		<script>

			var slider = document.getElementById("myRange");
			var output = document.getElementById("demo");
			output.innerHTML = slider.value;

			slider.oninput = function() {
			output.innerHTML = this.value;
			}

			function timeout() {
			// code to show the back page with the current time and "Screen Timeout" text
			}

			setTimeout(timeout, 10000); // timeout function will be called after 10 seconds

			let timeoutId;

			function timeout() {
			// code to show the back page with the current time and "Screen Timeout" text
			}

			function resetTimeout() {
			// cancel the timeout
			clearTimeout(timeoutId);

			// set a new timeout
			timeoutId = setTimeout(timeout, 10000);
			}

			// reset the timeout whenever the mouse is moved
			document.addEventListener("mousemove", resetTimeout);

			// set the initial timeout
			timeoutId = setTimeout(timeout, 10000);



        </script>
	</body>
	</html>