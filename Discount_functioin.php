<?php 

function discount($originalprice) {
	$discountPercent = 15;
	$discountprice = $originalprice - ($originalprice * $discountPercent / 100);
	$_SESSION['discountprice'] = $discountprice;
	echo $discountprice;
}

// when the scope was bigger, Use Contructor ----> public 

 ?>
