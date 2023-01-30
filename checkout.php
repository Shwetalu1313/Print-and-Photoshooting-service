<?php 
session_start();
include('connect.php');
include('AutoID_Functions.php');
include ('Discount_functioin.php');
include ('ImageCount_functions.php');

$customer_id = $_SESSION['cid'];
$customer_name = $_SESSION['cname'];
$discountprice = $_SESSION['discountprice'];

$select = "SELECT * FROM customer 
		   WHERE CustomerID = '$customer_id'";
$result = mysqli_query($connect,$select);
$output = mysqli_fetch_array($result);

$Email = $output['Cemail'];
$Phone = $output['Cphone'];


if (isset($_GET['packageID'])) {
	$packageID2 = $_REQUEST['packageID'];
	$selectP = "SELECT * FROM package
				WHERE packageID=$packageID2";
	$result5 = mysqli_query($connect,$selectP);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$fetch = mysqli_fetch_array($result5);
		$packageID2=$fetch['packageID'];
		$package_name=$fetch['package_name'];
		$package_price=$fetch['package_price'];
		$package_image=$fetch['package_image'];
		$package_desc=$fetch['Description'];
		$packagequantity=$fetch['Quantity'];
		$cateID=$fetch['cateID'];
		$editing;

		switch ($cateID) {
			case '1':
				$editing = 3000;
				break;
			case '2':
				$editing = 20000;
				break;
			case '3':
				$editing = 70000;
				break;
			
			default:
				$editing = 150000;
				break;
		}
	}	
}

// Login Start
if (isset($_POST['btnlogin'])) {

    $mail = $_POST['txtmail'];
    $password = $_POST['txtpassword'];

    // check data with mail and pass
    $select = "SELECT * FROM customer WHERE Cemail = '$mail' AND Cpassword = '$password'";

    // store result data in a var
    $data = mysqli_query($connect,$select);

    // counting numbers of rows from $data
    $count = mysqli_num_rows($data);

    if ($count>0) {
		# code...
		$ret = mysqli_fetch_array($data);
		$CustomerID = $ret['CustomerID'];
		$Cname = $ret['Cname'];
		$_SESSION['cid'] = $CustomerID;
		$_SESSION['cname'] = $Cname;
	

	echo "<script>alert('Login has Successed😎')</script>";
	echo "<script>window.location='checkout.php'</script>";
	}   

	else {
		echo "<script>alert('Something is wrong, Try again👷🏻👷🏻‍♀️')</script>";
	}

}
// Login End

// package session start
// if (isset($_GET['packageID'])) 
// {
// 	$packageID=$_REQUEST['packageID'];
// 	$Select="SELECT * FROM package WHERE packageID=$packageID";

// 			$ret=mysqli_query($connect,$Select);
// 			$row=mysqli_fetch_array($ret);

//             $packageID2=$row['packageID'];
//             $package_name=$row['package_name'];
//             $package_price=$row['package_price'];
//             $package_image=$row['package_image'];
//             $package_des=$row['Description'];
//             $cateID=$row['cateID'];
// 			$package_quantity=$row['Quantity'];
		
// }
// package session end

// checkout start
if (isset($_POST['btnCheckout'])) 
{
	$customer_id = $_SESSION['cid'];
	$discountprice = $_SESSION['discountprice'];

	$txtOrderID=$_POST['txtOrderNo'];
	$OrderType="Buy Packages";
	$rdoPaymentType=$_POST['rdoPaymentType'];
	$txtCardNo=$_POST['txtCardNo'];
	$deliveryLocation=$_POST['txtdelivery'];
	$EditingFees=$_POST['txtedit'];
	$price=$_POST['txtprice'];
	$packageID=$_POST['txtpackageID'];
	$packagequantityPO=$_POST['txtquantity'];
	
	$GrandTotal=$price+$EditingFees;


	$OrderStatus="Pending";

// Set maximum file size for uploaded images (in bytes)
$max_file_size = 1000000;

// Set allowed file types for uploaded images
$allowed_types = array("image/jpeg", "image/png", "image/gif", "image/jpg", "image/icon");

// Set folder paths
$folder1 = "orderImages/";
$folder2 = "admin/orderimages/";

// Initialize filename counter
$filename_counter = 1;
// Initialize array to store filenames
$filenames = array();

// Loop through image files
for ($i = 1; $i <= $packagequantityPO; $i++) {
    // Check if image file has been uploaded and is of allowed type
    if (isset($_FILES['image' . $i]) && in_array($_FILES['image' . $i]['type'], $allowed_types)) {
        // Check if file size is within allowed limit
        if ($_FILES['image' . $i]['size'] <= $max_file_size) {
            // Generate filenames using filename counter and original file name
            $filename1 = $folder1 . "_" . $filename_counter . "_" . $_FILES['image' . $i]['name'];
			$filename2 = $folder2 . "_" . $filename_counter . "_" . $_FILES['image' . $i]['name'];
			$copy2 = copy($_FILES['image' . $i]['tmp_name'], $filename2);
            // Increment filename counter
            $filename_counter++;
            // Copy uploaded file to first folder
            if (copy($_FILES['image' . $i]['tmp_name'], $filename1)) {
                // Upload and copy successful, add filenames to array
                $filenames[] = $filename1;
                echo "Image " . $i . " uploaded and copied successfully!";
            } else {
                // Error copying file to first folder
                echo "Error copying image " . $i . " to first folder.";
            }
        } else {
            // File size exceeds allowed limit
            echo "Image " . $i . " file size exceeds allowed limit.";
        }
    } else {
        // Image file not uploaded or invalid file type
        echo "Image " . $i . " not uploaded or invalid file type.";
    }
}

// Insert data into orders table
$Insert1 = "INSERT INTO orders (OrderID, OrderType, PackageID, CustomerID, price, DeliveryLocation, EditingFees, GrandTotal, PaymentType, CardNumber, OrderStatus";

// Add image columns to insert query
for ($i = 1; $i <= count($filenames); $i++) {
    $Insert1 .= ", image" . $i;
}

$Insert1 .= ") VALUES ('$txtOrderID', '$OrderType', '$packageID','$price', '$customer_id', '$deliveryLocation', '$EditingFees', '$GrandTotal', '$rdoPaymentType', '$txtCardNo', '$OrderStatus'";

// Add filenames to insert query
for ($i = 0; $i < count($filenames); $i++) {
    $Insert1 .= ", '" . $filenames[$i] . "'";
}

$Insert1 .= ")";

$result1 = mysqli_query($connect, $Insert1);

// Check for errors
if (!$result1) {
    echo "Error saving data to orders table: " . mysqli_error($connect);
}
else {
	echo"<script>alert('Checkout Successful')</script>";
	echo"<script>window.location='packages.php'</script>";
}

mysqli_close($connect);
}	

// checkout end
// }


 ?>




<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Checkout For Photo and Video</title>
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

   <!-- date picker css -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">


	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>

	<style type="text/css">
		.payment {
			margin-left: 50px;
		}
	</style>

	<!-- payment js -->
	<script type="text/javascript">
	function SameAddress()	
	{
		document.getElementById('SameAddress').style.display="block";
		document.getElementById('OtherAddress').style.display="none";
	}
	function OtherAddress()	
	{
		document.getElementById('SameAddress').style.display="none";
		document.getElementById('OtherAddress').style.display="block";
	}

	function COD()	
	{
		document.getElementById('ROMA').style.display="none";
		document.getElementById('CARD').style.display="none";
	}

	function ROMA()	
	{
		document.getElementById('ROMA').style.display="block";
		document.getElementById('CARD').style.display="none";
	}

	function CARD()	
	{
		document.getElementById('ROMA').style.display="none";
		document.getElementById('CARD').style.display="block";
	}
	
	</script>


</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		
		<!-- Header -->
		<?php 

		include('header.php');
		 ?>


        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Checkout</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->        <!-- Start Checkout Area -->
        <section class="wn__checkout__area section-padding--lg bg__white">
        	<div class="container">
			<div class="row">
        			<div class="col-lg-12">
        				<div class="wn_checkout_wrap">
        					<div class="checkout_info">
        						<span>Returning customer ?</span>
        						<a class="showlogin" href="customer_L_R.php">Click here to login</a>
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="row">
        			
        			<div class="col-lg-6 col-12">
        				<form action="checkout.php" method="POST" enctype="multipart/form-data">
        				<div class="customer_details">
        					<h3>Order details</h3>
        					<div class="customar__field">
        						<div class="margin_between">
	        						<div class="input_box space_between">
	        							<label>Order ID <span>*</span></label>
	        							<input type="text" name="txtOrderNo" value="<?php echo AutoID('Orders','OrderID','ORD-',6)?>" readonly>
	        						</div>
	        						<div class="input_box space_between">
	        							<label>Price <span>*</span></label>
	        							<input type="text" name="txtprice" value="<?php echo $discountprice; ?>" readonly>
										<input type="hidden" name="txtedit" value="<?php echo $editing; ?>">
										<input type="hidden" name="txtquantity" value="<?php echo $packagequantity; ?>">
										<input type="hidden" name="txtpackageID" value="<?php echo $_GET['packageID']; ?>">
	        						</div>
        						</div>
        						<div class="input_box">
        							<label>Delivery Location<span>*</span></label>
        							<input type="text" name="txtdelivery" required>
        						</div>
								<?php ImageCount($packagequantity,$cateID);?>
								        				<!-- payment Type -->
								<div class="wn__order__box" style="margin-bottom:10px; margin-top: 20px;">
									<h3 class="onder__title">Payment Type</h3>
									<div class="payment">
									<input type="radio" name="rdoPaymentType" value="COD" checked onClick="COD()" /> Cash on Delivery
									</div>
									<div class="payment">
									<input type="radio" name="rdoPaymentType" value="CARD"  onClick="CARD()" /> Card Payment
									</div>
									<div class="payment">
									<input type="radio" name="rdoPaymentType" value="ROMA"  onClick="ROMA()" /> ROMA pay
									</div>
								</div>      				
								<!-- payment End -->  
        						<div class="input_box" id="CARD" style="display: none;">
        							<label>Card <span>*</span></label>
        							<input type="text" name="txtCardNo" placeholder="Enter Card Number">
        							<input type="text" name="txtSecurityNo" placeholder="Enter Security No">
        							<input type="text" name="txtMonth" placeholder="Card Expired Date: eg--> December" >
        							<input type="text" name="txtYear" placeholder="Card Expired Date: eg--> 2023" >
        						</div>
        						<div class="input_box" id="ROMA" style="display: none;">
        							<label>Roma <span>*</span></label>
        							<img src="images/ROMA.jpg" style="width: 200px;">
        						</div>
        						<div class="input__box">
        							<div class="review-form-actions">
        							<center>
        							<input type="submit" name="btnCheckout" value="Checkout" style="width:100px; height: 30px">
        							</center>
        							</div>
        						</div>

        					</div>
        				</div>
        				</form>
        			</div>
        			<div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
        				<form action="checkout.php" method="POST">
     				
        				<div class="wn__order__box">
        					<h3 class="onder__title" style="margin-top:10px">Your Data</h3>
        					<ul class="order__total">
        						<li>Field Name</li>
        						<li>Data</li>
        					</ul>
        					<ul class="order_product">
	        					<li>Name: <span><?php echo "$customer_name"; ?></span></li>
	        					<li>Email: <span><?php echo "$Email"; ?></span></li>
	        					<li>Phone: <span><?php echo "$Phone"; ?></span></li>
        					</ul>

        				</div>

        				<div class="wn__order__box" style="margin-top:10px">
        					<h3 class="onder__title">Cost</h3>
        					<ul class="order__total">
        						<li>Package</li>
        						<li>Total</li>
        					</ul>
        					<ul class="order_product">
        						<li><?php echo $package_name?><span><?php echo $discountprice;?> MMK</span></li>
        						<li><?php echo "Editing";?><span><?php echo $editing;?> MMK</span></li>
        					</ul>
<!--         					<ul class="shipping__method">
        						<li>Cart Subtotal <span>$48.00</span></li>
        						<li>Shipping 
        							<ul>
        								<li>
        									<input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" checked="checked" type="radio">
        									<label>Flat Rate: $48.00</label>
        								</li>
        								<li>
        									<input name="shipping_method[0]" data-index="0" value="legacy_flat_rate" checked="checked" type="radio">
        									<label>Flat Rate: $48.00</label>
        								</li>
        							</ul>
        						</li>
        					</ul>
 -->        				<ul class="total__amount">
        						<li>Order Total <span><?php echo $discountprice+$editing; ?> MMK</span></li>
        					</ul>
        				</div>


					    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
						<div class="payment">
						        <div class="che__header" role="tab" id="headingOne">
						          	<a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						                <span>Day to Wait for Delivery</span>
						          	</a>
						        </div>
						        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					            	<div class="payment-body">My dear customer!🙋🏻. If your order is less than 10 photo and from near locatioon, you only need to wait 4 hours. Else you are not, You need to wait 2 or 3 days we will contact you in these days. Have a nice day!🥰 </div>
						        </div>
						    </div>
						    <div class="payment">
						        <div class="che__header" role="tab" id="headingOne">
						          	<a class="checkout__title" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						                <span>Direct Bank Transfer</span>
						          	</a>
						        </div>
						        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					            	<div class="payment-body">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</div>
						        </div>
						    </div>
						    <div class="payment">
						        <div class="che__header" role="tab" id="headingTwo">
						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							            <span>Cheque Payment</span>
						          	</a>
						        </div>
						        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
					          		<div class="payment-body">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
						        </div>
						    </div>
						    <div class="payment">
						        <div class="che__header" role="tab" id="headingThree">
						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							            <span>Cash on Delivery</span>
						          	</a>
						        </div>
						        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
					          		<div class="payment-body">Pay with cash upon delivery.</div>
						        </div>
						    </div>
<!-- 						    <div class="payment">
						        <div class="che__header" role="tab" id="headingFour">
						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							            <span>PayPal <img src="images/icons/payment.png" alt="payment images"> </span>
						          	</a>
						        </div>
						        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
					          		<div class="payment-body">Pay with cash upon delivery.</div>
						        </div>
						    </div> -->
					    </div>
					</form>
        			</div>

        		</div>
        	</div>
        </section>
        <!-- End Checkout Area -->
		<!-- Footer Area -->
		<?php 

		include('footer.php');

		 ?>
		<!-- //Footer Area -->

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