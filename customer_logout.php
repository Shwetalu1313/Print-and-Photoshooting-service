<?php 
session_start();

// session destory();
       unset($_SESSION['cid']);
       unset($_SESSION['cname']);
      //  unset($_SESSION['Email']);

 echo "<script>window.alert('logout Successful🔴🔴')</script>";
 echo "<script>window.location='customer_L_R.php'</script>";
 ?>