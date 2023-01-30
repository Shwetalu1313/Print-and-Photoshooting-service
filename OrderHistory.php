<?php
session_start();
include('connect.php');

include('nonesession_ID_response_functions.php');

$CustomerID=$_SESSION['cid'];

noneIDrpo();

if(isset($_POST['btnSearch']))
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType == 1) 
	{
		$cboOrderID=$_POST['cboOrderID'];

		$query="SELECT ord.*,cus.CustomerID,cus.Cname
				FROM orders ord,customer cus
				WHERE ord.OrderID='$cboOrderID'
                AND ord.CustomerID=cus.CustomerID
                -- AND cus.CustomerID=$CustomerID
                -- AND ord.CustomerID=$CustomerID
				";
		$ret=mysqli_query($connect,$query);

	}
	elseif($rdoSearchType == 2) 
	{
		$To=date('Y-m-d',strtotime($_POST['txtTo']));
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));

		$query="SELECT ord.*,cus.CustomerID,cus.Cname
				FROM orders ord,customer cus
				WHERE ord.OrderDate BETWEEN '$From' AND '$To'
				AND ord.CustomerID=cus.CustomerID
                AND cus.CustomerID=$CustomerID ORDER BY OrderID
				";
		$ret=mysqli_query($connect,$query);
	}
	elseif($rdoSearchType == 3) 
	{
		$cboStatus=$_POST['cboStatus'];

		$query="SELECT ord.*,cus.CustomerID,cus.Cname
				FROM orders ord,customer cus
				WHERE ord.OrderStatus='$cboStatus'
				AND ord.CustomerID=cus.CustomerID
                AND cus.CustomerID=$CustomerID
                ORDER BY OrderID
				";
		$ret=mysqli_query($connect,$query);
	}

}
elseif(isset($_POST['btnShowAll']))
{
	$query="SELECT ord.*,cus.CustomerID,cus.Cname
			FROM orders ord,customer cus
			WHERE ord.CustomerID=cus.CustomerID
                AND cus.CustomerID=$CustomerID
                 ORDER BY OrderID
			";
	$ret=mysqli_query($connect,$query);
}
else
{
	$today=date('Y-m-d');

	$query="SELECT ord.*,cus.CustomerID,cus.Cname
			FROM orders ord,customer cus
			WHERE ord.OrderDate='$today'
			AND ord.CustomerID=cus.CustomerID
                AND cus.CustomerID=$CustomerID ORDER BY OrderID
			";
	$ret=mysqli_query($connect,$query);
}

?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Order History</title>
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
    <style>
        /* Apply these styles when printing the page */
        @media print {
        body {
            font-size: 12pt;
            color: #000;
            background-color: #fff;
        }
        }
    </style>
</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		
		<!-- Header -->
		<?php include('header.php'); ?>
		<div class="box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="#">
				<div class="field__search">
					<input type="text" placeholder="Search entire store here...">
					<div class="action">
						<a href="#"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>
		<!-- End Search Popup -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">My Orders History</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">My Orders History</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                    <form action="OrderHistory.php" method="POST">
                        

                        <table cellpadding="5px">
                        <tr>
                            <td>
                                <input type="radio" name="rdoSearchType" value="1" checked />Search By OrderID :
                                <br/>
                                <select name="cboOrderID">
                                    <option>Choose OrderID</option>
                                    <?php 
                                    
                                    $CustomerID=$_SESSION['cid'];

                                    $Oquery="SELECT * FROM orders WHERE CustomerID='$CustomerID' ";  
                                    $Oret=mysqli_query($connect,$Oquery);
                                    $Ocount=mysqli_num_rows($Oret);

                                    for($i=0;$i<$Ocount;$i++) 
                                    { 
                                        $Orow=mysqli_fetch_array($Oret);

                                        $OrderID=$Orow['OrderID'];

                                        echo "<option value='$OrderID'>$OrderID</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input type="radio" name="rdoSearchType" value="2" /> Search By OrderDate :
                                <br/>
                                From <input type="text" name="txtFrom" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)"/>
                                To <input type="text" name="txtTo" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)" />
                            </td>
                            <td>
                                <input type="radio" name="rdoSearchType" value="3" /> Search By Status :
                                <br/>
                                <select name="cboStatus">
                                    <option>Choose Status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                </select>
                            </td>
                            <td>
                                <br/>
                                <input type="submit" name="btnSearch" value="Search Now" />
                                <input type="submit" name="btnShowAll" value="Show All" />
                                <input type="reset" name="btnClear" value="Clear" />
                            </td>
                        </tr>
                        </table>

                            <div class="table-content wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Order ID</th>
                                            <th class="product-name">Order Datetime</th>
                                            <th class="product-name">OrderType</th>
                                            <th class="product-name">Package Name</th>
                                            <th class="product-name">Special Order Title</th>
                                            <th class="product-price">Total Amounte</th>
                                            <th class="product-quantity">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count=mysqli_num_rows($ret);

                                    for($i=0;$i<$count;$i++) 
                                    {
                                        $row=mysqli_fetch_array($ret);
                                            $packageID=$row['PackageID'];
                                            $select2 = "SELECT * FROM package WHERE packageID ='$packageID'";
                                            $check2 = mysqli_query($connect,$select2);
                                            $count2 = mysqli_num_rows($check2);
                                            $row2 = mysqli_fetch_array($check2);
                                            $packagename = isset($row2['package_name']) ? $row2['package_name'] : "-";

                                            
                                        echo "<tr>";
                                        echo    "<th class='product-thumbnail'>" . $row['OrderID'] . "</th>";
                                        echo    "<th class='product-name'>" . $row['OrderDate'] . "</th>";
                                        echo    "<th class='product-name'>" . $row['OrderType'] . "</th>";
                                        echo    "<th class='product-name'>$packagename</th>";
                                        echo    "<th class='product-name'>" . $row['TitleOfSpecial']. "</th>";
                                        echo    "<th class='product-price'>" . $row['GrandTotal']. "</th>";
                                        echo   " <th class='product-quantity'>" . $row['OrderStatus']. "</th>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </form> 
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li><button onclick="window.print()">Print this page</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <!-- cart-main-area end -->
		<!-- Footer Area -->
		<?php include('footer.php'); ?>
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
        function printPage() {
            window.print();
            }
            /* Apply these styles for the normal view of the page */
            window.onbeforeprint = function() {
            // Apply custom styles or hide elements here
            document.body.style.fontSize = "12pt";
            document.body.style.color = "#000";
            }



    </script>
	
</body>
</html>