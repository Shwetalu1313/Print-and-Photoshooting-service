<?php 

// looping function
function ImageCount($imageQuantity,$categoryID) {
	$imageQuantityTo1 = $imageQuantity / $imageQuantity;
	intval($imageQuantityTo1);
	if ($categoryID == 1) {
		while ($imageQuantityTo1 <= $imageQuantity) {
		echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
		echo "<span class='posted_in'>Image Input ($imageQuantityTo1): ";
		echo "<input type='file' name='image$imageQuantityTo1' title='image($imageQuantityTo1)' id='filesize$imageQuantityTo1' required>";
		echo "</span>";
		echo "</div>";
		echo "	<script>

		document.getElementById('filesize$imageQuantityTo1').onchange=function(){
					var file = this.files[0];
					var fileSize$imageQuantityTo1 = file.size / 1024;
					if (fileSize$imageQuantityTo1 < 200) {
					  alert('your file has small frame size, try to input good quality photo');
					}
				  };
				  
			</script>";

		echo "<script>document.getElementById('filesize$imageQuantityTo1').accept = 'image/*';</script>";
		$imageQuantityTo1++;
		}
	}
}


















// normal function
function Imagecountsecond($imageQuantity,$categoryID) {

		if ($imageQuantity == 10) {

			// part 1
			echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
			echo "<span class='posted_in'>Image Input (1): ";
			echo "<input type='file' name='image1' title='image(1)' id='filesize1'>";
			echo "</span>";
			echo "</div>";

						// part 2
						echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
						echo "<span class='posted_in'>Image Input (2): ";
						echo "<input type='file' name='image2' title='image(2)' id='filesize2'>";
						echo "</span>";
						echo "</div>";

						// part 3
						echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
						echo "<span class='posted_in'>Image Input (3): ";
						echo "<input type='file' name='image3' title='image(3)' id='filesize3'>";
						echo "</span>";
						echo "</div>";

									// part 4
			echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
			echo "<span class='posted_in'>Image Input (4): ";
			echo "<input type='file' name='image4' title='image(4)' id='filesize4'>";
			echo "</span>";
			echo "</div>";

						// part 5
						echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
						echo "<span class='posted_in'>Image Input (5): ";
						echo "<input type='file' name='image5' title='image(5)' id='filesize5'>";
						echo "</span>";
						echo "</div>";

									// part 6
			echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
			echo "<span class='posted_in'>Image Input (6): ";
			echo "<input type='file' name='image6' title='image(6)' id='filesize6'>";
			echo "</span>";
			echo "</div>";

						// part 7
						echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
						echo "<span class='posted_in'>Image Input (7): ";
						echo "<input type='file' name='image7' title='image(7)' id='filesize7'>";
						echo "</span>";
						echo "</div>";

									// part 8
			echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
			echo "<span class='posted_in'>Image Input (8): ";
			echo "<input type='file' name='image8' title='image(8)' id='filesize8'>";
			echo "</span>";
			echo "</div>";


						// part 9
						echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
						echo "<span class='posted_in'>Image Input (9): ";
						echo "<input type='file' name='image9' title='image(9)' id='filesize9'>";
						echo "</span>";
						echo "</div>";

			// part 10
			echo "<div class='box-tocart d-flex' style='margin-top: 10px;'>";
			echo "<span class='posted_in'>Image Input (10): ";
			echo "<input type='file' name='image10' title='image(10)' id='filesize10'>";
			echo "</span>";
			echo "</div>";
		}

		$imageQuantityTo1 = $imageQuantity / $imageQuantity;
		intval($imageQuantityTo1);
		if ($categoryID == 1) {
			while ($imageQuantityTo1 <= $imageQuantity) {
				echo "	<script>

				document.getElementById('filesize$imageQuantityTo1').onchange=function(){
							var file = this.files[0];
							var fileSize$imageQuantityTo1 = file.size / 1024;
							if (fileSize$imageQuantityTo1 < 1000) {
							  alert('your file size is smaller than 1000KB');
							}
						  };
						  
					</script>";
		
				echo "<script>document.getElementById('filesize$imageQuantityTo1').accept = 'image/*';</script>";
				$imageQuantityTo1++;
			}
		}

}
 ?>
