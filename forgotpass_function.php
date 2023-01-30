<?php
  function forgotpass($name, $email){
    $select = "SELECT * FROM customer where Cemail='$email' and Cname='$name' ";
    $result = mysqli_query(mysqli_connect("localhost","root","","kingstudio"),$select);
    $row = mysqli_fetch_array($result);
  
    $password=$row['Cpassword'];
  
    if ($row>0) {
      echo "<h3>$password</h3>";
  
    }
    else {
      echo "<script>window.alert('You are not deserve to get a password')</script>";
      echo "<script>window.location='forgotpass.php'</script>";
    }
  }
?>