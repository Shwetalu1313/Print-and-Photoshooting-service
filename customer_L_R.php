<!-- register -->
<?php
include('connect.php');

if (isset($_POST['btnsubmit'])) {
    $name = $_POST['txtname'];
    $mail = $_POST['txtmail'];
    $phone = $_POST['txtphone'];
    $password = $_POST['txtpassword'];
    $address = $_POST['txtaddress'];

    if (preg_match('/[^A-Za-z0-9]/', $name)) {
        echo "<script>alert('Special characters and non-alphanumeric characters are not allowed in the name field')</script>";
        return;
    }
	
    $select = "SELECT * FROM customer WHERE Cemail='$mail'";
    $query = mysqli_query($connect,$select);
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        echo "<script>window.alert('This Email is already exist🔴🔴')</script>";
        }


    else {
        $insert = "INSERT INTO customer (Cname, Cemail, Cphone, Cpassword, Caddress)
        VALUES ('$name', '$mail', '$phone', '$password','$address')";

        $data = mysqli_query($connect, $insert);

        if ($data) {
            echo "<script>window.alert('Account created successfully😁')</script>";
            echo "<script>window.alert('You need to login🔏')</script>";
            echo "<script>window.location = 'customer_L_R.php'</script>";
            }

        }
}

?>
<!-- register end -->

<!-- ----------------------------------------------------------------- -->

<!-- login -->
<?php
session_start();
include('connect.php');

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
	echo "<script>window.location='index.php'</script>";
	}   

	else {
		echo "<script>alert('Something is wrong, Try again👷🏻👷🏻‍♀️')</script>";
	}

}
?>
<!-- login end -->
<!-- ----------------------------------------- -->


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
                        	<h2 class="bradcaump-title">My Account</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">My Account</span>
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
							<h3 class="account__title">Login</h3>
							<form action="customer_L_R.php" method="POST">
								<div class="account__form">
									<div class="input__box">
										<label>email address <span>*</span></label>
										<input type="email" name="txtmail" pattern=".*@.*" id="bock_special" required>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="txtpassword" required>
									</div>
									<div class="form__btn">
										<button type="submit" name="btnlogin">Login</button>

									</div>
									<a class="forget_pass" href="forgotpass.php">Lost your password?</a>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="my__account__wrapper">
							<h3 class="account__title">Register</h3>
							<form action="customer_L_R.php" method="POST">
								<div class="account__form">
                                <div class="input__box">
										<label>Name <span>*</span></label>
										<input type="text" name="txtname" id="bock_special" required>
									</div>
									<div class="input__box">
										<label>Email address <span>*</span></label>
										<input type="email" name="txtmail" pattern=".*@.*" required>
									</div>
                                    <div class="input__box">
										<label>Phone Number <span>*</span></label>
										<input type="number" name="txtphone" min=0 required>
									</div>
									<div class="input__box">
										<label>Password<span>*</span></label>
										<input type="password" name="txtpassword" required>
									</div>
                                    <div class="input__box">
										<label>Address<span>*</span></label>
										<textarea type="text" cols="55" rows="3" name="txtaddress" required></textarea>
									</div>

									<div class="input__box">
									<div class="g-recaptcha" data-sitekey="6Ld3fH0gAAAAAETAL5eqS8oN5xxaL_J1nzb0Q4Z4" required>
									</div>
									</div>

									<div class="form__btn" style="margin-top: 10px;">
										<button type="submit" name="btnsubmit" class="btn">Register</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
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