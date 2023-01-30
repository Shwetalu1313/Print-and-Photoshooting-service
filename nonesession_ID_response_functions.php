<?php 


function noneIDrpo() {
	include('connect.php');
	if(!isset($_SESSION['cid'])) {
		echo "<script>window.alert('You Need To login first.🌦️🌦️')</script>";
		// header("Location: customer_L_R.php");
		echo "<script>window.location='customer_L_R.php';</script>";
		exit;
	  }
}


 ?>