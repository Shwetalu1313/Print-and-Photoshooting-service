<?php 
session_start();
include('connect.php');
include('AutoID_Functions.php');

include ('LocationSelection_function.php');
// Check if the user is logged in
include('nonesession_ID_response_functions.php');

noneIDrpo();

$customer_id = $_SESSION['cid'];
$customer_name = $_SESSION['cname'];


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
	$result = mysqli_query($connect,$selectP);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$fetch = mysqli_fetch_array($result);
		$packageID2=$fetch['packageID'];
		$package_name=$fetch['package_name'];
		$package_price=$fetch['package_price'];
		$package_image=$fetch['package_image'];
		$package_desc=$fetch['Description'];
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
	echo "<script>window.location='packages.php'</script>";
	}   

	else {
		echo "<script>alert('Something is wrong, Try again👷🏻👷🏻‍♀️')</script>";
	}

}
// Login End

// order date

// checkout start
if (isset($_POST['btnCheckout'])) 
{
	$customer_id = $_SESSION['cid'];
	$discountprice = $_SESSION['discountprice'];

	// $var = $_POST['txtorderdate'];
	// echo "<script>window.alert($var)</script>";
	// $date = str_replace('/', '-', $var);
	// $final = date('Y-m-d', strtotime($date));
	// echo "<script>window.alert($final)</script>";



	$txtOrderDate = $_POST['txtorderdate'];
	$txtOrderTime = $_POST['txtordertime'];
	$txtOrderID=$_POST['txtOrderNo'];
	$OrderType="Special Order";
	$ShootingLocation=$_POST['txtshootinglocation'];
	$Description=$_POST['txtdescription'];
    $title=$_POST['title'];

	$OrderStatus="Pending";
    $folder = "OrderFiles/";
    $folder2 = "admin/OrderFiles/";
		// part 10
		$file = $_FILES['txtfile']['name'];
		if($file) {
			$filename=$folder.'_'.$file;
			$filename2=$folder2.'_'.$file;
			// if there is data in FILES var, the system will do following guys
			$copy1 = copy($_FILES['txtfile']['tmp_name'], $filename);
			$copy2 = copy($_FILES['txtfile']['tmp_name'], $filename2);
	
				if (!$copy1) 
				{
					exit ("ERROR ha ERROR");
				}
				if (!$copy2) 
				{
					exit ("ERROR ha ERROR");
				}
		}


	// image file input end




	$selectD = "SELECT u.UnDate, o.ShootingDate
	FROM undate u, orders o
	WHERE u.UnDate='$txtOrderDate' OR o.ShootingDate='$txtOrderDate'";

	$queryD = mysqli_query($connect,$selectD);
	$row = mysqli_fetch_array($queryD);
    if ($row > 0) {
	
        echo "<script>window.alert('This date has been picked by someone.🔴🔴')</script>";
		echo "<script>window.alert('Try Again.🔴🔴')</script>";
		echo "<script>window.location='packages.php'</script>";


        }
    else {

	$Insert2="INSERT INTO orders
			(`OrderID`, 
			 `OrderType`, 
			 `CustomerID`,
			 `ShootingLocation`, 
			 `ShootingDate`, 
			 `ShootingTime`,
			 `OrderStatus`,
             `TitleOfSpecial`,
             `file`,
             `Descriptions`
			 )
			VALUES
			('$txtOrderID',
			 '$OrderType',
			 '$customer_id',
			 '$ShootingLocation',
			 '$txtOrderDate',
			 '$txtOrderTime',
			 '$OrderStatus',
			 '$title',
			 '$filename',
			 '$Description')";
	$result2=mysqli_query($connect,$Insert2);



	if($result2) //True 
	{

		echo "<script>window.alert('Successfully Checkout!')</script>";
		echo "<script>window.location='packages.php'</script>";
	}
	else
	{
		echo "<p>Something Went Wrong in Checkout " . mysqli_error($connect) .  "</p>";
	}
}
}


// checkout end



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



	function shooting()	
	{
		document.getElementById('printing').style.display="none";
		document.getElementById('shooting').style.display="block";
		document.getElementById('shooting1').style.display="block";
		document.getElementById('shooting2').style.display="block";
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
                        	<h2 class="bradcaump-title">Special Order for Photoshooting</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Special Order for Photoshooting</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
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
        				<form action="checkoutPhotoSpecial.php" method="POST" enctype="multipart/form-data">
        				<div class="customer_details">
        					<h3>Order Information</h3>
        					<div class="customar__field">
        						<div class="margin_between">
	        						<div class="input_box space_between">
	        							<label>Order ID <span>*</span></label>
	        							<input type="text" name="txtOrderNo" value="<?php echo AutoID('Orders','OrderID','ORD-',6)?>" readonly>
	        						</div>
	        						<div class="input_box space_between">
	        							<label>Order Date <span>*</span></label>
	        							<input type="text" name="txtprice" value="📅 <?php echo date('D - M - Y'); ?>" readonly>

	        						</div>
        						</div>
								        				<!-- payment Type -->
							<div class="wn__order__box" style="margin-bottom:30px">
        					<h3 class="onder__title">Choose Category Type</h3>
							<div class="payment">
							<input type="radio" name="rdoPaymentType" value="CARD"  onClick="shooting()" checked/> Photo / Video Shooting
							</div>

        					</div>      				
        				<!-- payment End --> 
        						<div class="input_box">
        							<label>Title for Your Order<span>*</span></label>
        							<input type="text" name="title" placeholder="eg: For photshooting, Wedding" required>
        						</div>
        						<div class="input_box" id="shooting">
        							<label>Shooting Date <span>*</span></label>
									<input type="date" name="txtorderdate" required>

        						</div>
								<div class="input_box" id="shooting1">
        							<label>Shooting Time <span>*</span></label>
									<input type="time" name="txtordertime" required>

        						</div>
                                <div class="input_box" id="shooting2">
        							<label>Shooting location <span>*</span></label>
									<input type="text" name="txtshootinglocation" required>

        						</div>
                                <div class="input_box">
                                    <label>What Do You Want To Say?🤩<span>*</span></label>
                                    <textarea name="txtdescription" id="" cols="80" rows="10"></textarea>
                                </div>
                                <div class="input_box">
        							<label>If you have sample design, you can show us.<span>*</span></label>
									<input type="file" name="txtfile" >

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
        				<form action="checkoutPhotoSpecial.php" method="POST">
      				
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

<!-- 
					    <div id="accordion" class="checkout_accordion mt--30" role="tablist">
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
				    <div class="payment">
						        <div class="che__header" role="tab" id="headingFour">
						          	<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							            <span>PayPal <img src="images/icons/payment.png" alt="payment images"> </span>
						          	</a>
						        </div>
						        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
					          		<div class="payment-body">Pay with cash upon delivery.</div>
						        </div>
						    </div> -->
					    <!-- </div> -->
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