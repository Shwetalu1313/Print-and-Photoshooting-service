<?php 

function CartCheck($cateID){
	include('connect.php');
	$select = "SELECT * FROM category 
			  WHERE cateID = '$cateID' ";
	$ret = mysqli_query($connect,$select);
	$row = mysqli_num_rows($ret);
	if ($row>0) {
		$fetch = mysqli_fetch_array($ret);
		$cateType = $fetch['cateType'];

		if ($cateType != 'Printing') {
			echo "<a href='checkoutPV.php?packageID=$packageID><button class='tocart' type='submit' title='Checkout Go' name='btncheckout'>Direct Checkout</button></form>";
		}

		else {
			echo "<a href='packageDetails.php?packageID=$packageID'><button class='tocart' type='submit' title='Add to cart' name='btnaddtocart'>Add to Cart</button>";
		}
	}
}

 ?>
