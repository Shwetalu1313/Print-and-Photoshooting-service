<?php 

function shootinglocation ($package_ID) {
	switch ($package_ID) {
		case '23':
			echo "<input type='text' name='txtshootinglocation' value='Conditional Enviroment' readonly>";
			break;
		case '22':
			echo "<input type='text' name='txtshootinglocation' value='King Studio' readonly>";
			break;
		
		default:
			echo "<input type='text' name='txtshootinglocation' placeholder='Fully Address Here' required>";
			break;
	}
	}
 ?>
