<!-- register -->
<?php
session_start();
include('connect.php');

// Check if the user is logged in
include('nonesession_ID_response_functions.php');

noneIDrpo();



$CustomerID = $_SESSION['cid'];

// Retrieve the customer's data from the database
$query = "SELECT * FROM customer WHERE CustomerID = '$CustomerID'";
$result = mysqli_query($connect, $query);
$customer = mysqli_fetch_assoc($result);

if (isset($_POST['btnsubmit'])) {
    $UCustomerID = $_POST['txtid'];
    $name = $_POST['name'];
    $mail = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    
    $select = "SELECT * FROM customer WHERE CustomerID='$UCustomerID'";
    $query = mysqli_query($connect,$select);
    $count = mysqli_num_rows($query);

    if ($count < 0) {
        echo "<script>window.alert('Something Wrong')</script>";
        echo mysqli_error($connect);
        }


    else {
        $insert = "UPDATE customer SET Cname = '$name', Cemail = '$mail', Cphone = '$phone', Caddress = '$address', Cpassword = '$password' WHERE CustomerID = '$UCustomerID'";

        $data = mysqli_query($connect, $insert);

        if ($data) {
            
            echo "<script>window.alert('Update Successful')</script>";
            echo "<script>window.location = 'customer_profile_update.php'</script>";
            }

        }
}

?>
<!-- Update end -->

<!-- ----------------------------------------------------------------- -->



<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Login / Register</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.PNG">
	<link rel="apple-touch-icon" href="images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="style.css">

	<!-- Cusom css -->
   <link rel="stylesheet" href="css/custom.css">

	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/[email protected]/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
	<?php include('header.php');?>
		<!-- End Search Popup -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Update My Account</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Update My Account</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
		<!-- Start My Account Area -->
		<section class="my_account_area pt--80 pb--55 bg--white">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Update</h3>
							<form action="customer_profile_update.php" method="POST">
              <input type="hidden" name="txtid" value="<?php echo $customer['CustomerID']; ?>" required>
								<div class="account__form">
                  <div class="input__box">
										<label>Name <span>*</span></label>
										<input type="text" name="name" id="bock_special" value="<?php echo $customer['Cname']; ?>" required>
                    
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" name="email" value="<?php echo $customer['Cemail']; ?>" required>
									</div>
                                    <div class="input__box">
										<label>Phone Number <span>*</span></label>
										<input type="number" name="phone" value="<?php echo $customer['Cphone'];?>" min=0 required>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="password" value="<?php echo $customer['Cpassword']; ?>" required>
									</div>
                                    <div class="input__box">
										<label>Address<span>*</span></label>
										<textarea type="text" cols="55" rows="3" name="address" value="<?php echo $customer['Caddress']; ?>" required></textarea>
									</div>

									<div class="input__box">
									<div class="g-recaptcha" data-sitekey="6Ld3fH0gAAAAAETAL5eqS8oN5xxaL_J1nzb0Q4Z4" required>
									</div>
									</div>

									<div class="form__btn" style="margin-top: 10px;">
										<button type="submit" name="btnsubmit" class="btn">UPDATE</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End My Account Area -->
		<!-- Footer Area -->
		<?php include('footer.php');?>
		<!-- //Footer Area -->
		
	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	<script>



		window.onload = function() {
		const input = document.getElementById('bock_special');
		input.addEventListener('keypress', (event) => {
			const charCode = event.charCode;
			const char = String.fromCharCode(charCode);
			if (/[^a-zA-Z0-9]/.test(char)) {
			event.preventDefault();
			for (let i = 0; i < char.length; i++) {
				alert('Typing Special characters are not allowed');
			}
			}
		});

		input.addEventListener('paste', (event) => {
			event.preventDefault();
			const pastedText = event.clipboardData.getData('text');
			const sanitizedText = pastedText.replace(/[^a-zA-Z0-9]/g, '');
			if (pastedText !== sanitizedText) {
			for (let i = 0; i < pastedText.length; i++) {
				if (/[^a-zA-Z0-9]/.test(pastedText[i])) {
				alert('Pasting Special characters are not allowed');
				}
			}
			}
			document.execCommand('insertText', false, sanitizedText);
		});
		};




	</script>
	
</body>
</html>