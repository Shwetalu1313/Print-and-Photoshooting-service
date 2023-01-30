<?php
  session_start();
  include ('connect.php');
  include ('forgotpass_function.php');


  $url = "http://localhost/testProject/hi.txt";
  $response = file_get_contents($url);
  $response_code = http_response_code();

  if ($response_code == 200) {
    echo "<script>window.alert('Server responded as expected')</script>";
  } else {
    echo "<script>window.alert('Server responded with unexpected code: $response_code')</script>";
    exit;
  }

  ?>
<script>window.alert('')</script>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.PNG">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Porgot Password</title>
    <style>
      img{
        width: 100%;
      }
      .login {
          height: 1000px;
          width: 100%;
          background: radial-gradient(#653d84, #332042);
          position: relative;
      }
      .login_box {
          width: 1050px;
          height: 600px;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%,-50%);
          background: #fff;
          border-radius: 10px;
          box-shadow: 1px 4px 22px -8px #0004;
          display: flex;
          overflow: hidden;
      }
      .login_box .left{
        width: 41%;
        height: 100%;
        padding: 25px 25px;
        
      }
      .login_box .right{
        width: 59%;
        height: 100%  
      }
      .left .top_link a {
          color: #452A5A;
          font-weight: 400;
      }
      .left .top_link{
        height: 20px
      }
      .left .contact{
        display: flex;
          align-items: center;
          justify-content: center;
          align-self: center;
          height: 100%;
          width: 73%;
          margin: auto;
      }
      .left h3{
        text-align: center;
        margin-bottom: 40px;
      }
      .left input {
          border: none;
          width: 80%;
          margin: 15px 0px;
          border-bottom: 1px solid #4f30677d;
          padding: 7px 9px;
          width: 100%;
          overflow: hidden;
          background: transparent;
          font-weight: 600;
          font-size: 14px;
      }
      .left{
        background: linear-gradient(-45deg, #dcd7e0, #fff);
      }
      .submit {
          border: none;
          padding: 15px 70px;
          border-radius: 8px;
          display: block;
          margin: auto;
          margin-top: 120px;
          background: #583672;
          color: #fff;
          font-weight: bold;
          -webkit-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
          -moz-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
          box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
      }



      .right {
        background: linear-gradient(212.38deg, rgba(242, 57, 127, 0.7) 0%, rgba(175, 70, 189, 0.71) 100%),url(https://static.seattletimes.com/wp-content/uploads/2019/01/web-typing-ergonomics-1020x680.jpg);
        color: #fff;
        position: relative;
      }

      .right .right-text{
        height: 100%;
        position: relative;
        transform: translate(0%, 45%);
      }
      .right-text h2{
        display: block;
        width: 100%;
        text-align: center;
        font-size: 50px;
        font-weight: 500;
      }
      .right-text h3{
        display: block;
        width: 100%;
        text-align: center;
        font-size: 30px;
        font-weight: 400;
      }

      .right .right-inductor{
        position: absolute;
        width: 70px;
        height: 7px;
        background: #fff0;
        left: 50%;
        bottom: 70px;
        transform: translate(-50%, 0%);
      }
      .top_link img {
          width: 28px;
          padding-right: 7px;
          margin-top: -3px;
      }
    </style>
  </head>
  <body>
  <!-- <form class="login" action="forgotpass.php" method="POST">
  <input type="text" placeholder="name" name="txtname"><br>
  <input type="email" placeholder="email" name="txtemail">
  <button type="submit" name="submit">Request</button> -->


  <section class="login">
		<div class="login_box">
			<div class="left">
				<div class="top_link"><a href="customer_L_R.php"><img src="https://drive.google.com/u/0/uc?id=16U__U5dJdaTfNGobB_OpwAJ73vM50rPV&export=download" alt="">Return home</a></div>
				<div class="contact">
					<form action="forgotpass.php" method="POST">
						<h3>Forgot Password</h3>
						<input type="text" placeholder="USERNAME" name="txtname" required>
						<input type="email" placeholder="email" name="txtemail" pattern=".*@.*" required>
						<button class="submit" name="submit">LET'S GO</button>
					</form>
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>Your Password Is</h2>
					<?php  if(isset($_POST['submit']))
                {
                $name = $_POST['txtname'];
                $email = $_POST['txtemail'];
                forgotpass($name,$email);
              }?>
				</div>
				<div class="right-inductor"><img src="https://lh3.googleusercontent.com/fife/ABSRlIoGiXn2r0SBm7bjFHea6iCUOyY0N2SrvhNUT-orJfyGNRSMO2vfqar3R-xs5Z4xbeqYwrEMq2FXKGXm-l_H6QAlwCBk9uceKBfG-FjacfftM0WM_aoUC_oxRSXXYspQE3tCMHGvMBlb2K1NAdU6qWv3VAQAPdCo8VwTgdnyWv08CmeZ8hX_6Ty8FzetXYKnfXb0CTEFQOVF4p3R58LksVUd73FU6564OsrJt918LPEwqIPAPQ4dMgiH73sgLXnDndUDCdLSDHMSirr4uUaqbiWQq-X1SNdkh-3jzjhW4keeNt1TgQHSrzW3maYO3ryueQzYoMEhts8MP8HH5gs2NkCar9cr_guunglU7Zqaede4cLFhsCZWBLVHY4cKHgk8SzfH_0Rn3St2AQen9MaiT38L5QXsaq6zFMuGiT8M2Md50eS0JdRTdlWLJApbgAUqI3zltUXce-MaCrDtp_UiI6x3IR4fEZiCo0XDyoAesFjXZg9cIuSsLTiKkSAGzzledJU3crgSHjAIycQN2PH2_dBIa3ibAJLphqq6zLh0qiQn_dHh83ru2y7MgxRU85ithgjdIk3PgplREbW9_PLv5j9juYc1WXFNW9ML80UlTaC9D2rP3i80zESJJY56faKsA5GVCIFiUtc3EewSM_C0bkJSMiobIWiXFz7pMcadgZlweUdjBcjvaepHBe8wou0ZtDM9TKom0hs_nx_AKy0dnXGNWI1qftTjAg=w1920-h979-ft" alt=""></div>
			</div>
		</div>
	</section>
</form>



  </body>
  </html>