<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Login - MSU-TCTO S-ECE</title>


		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
		<link href="assets/css/flexslider.css" rel="stylesheet" />
		<link href="assets/css/style.css" rel="stylesheet" />   
		
		
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />

			<!--  Jquery Core Script -->
		<script src="assets/js/jquery-1.10.2.js"></script>
		<!--  Core Bootstrap Script -->
		<script src="assets/js/bootstrap.js"></script>
		<!--  Flexslider Scripts --> 
			 <script src="assets/js/jquery.flexslider.js"></script>
		 <!--  Scrolling Reveal Script -->
		<script src="assets/js/scrollReveal.js"></script>
		<!--  Scroll Scripts --> 
		<script src="assets/js/jquery.easing.min.js"></script>
		<!--  Custom Scripts --> 
		<script src="assets/js/custom.js"></script>
		
		
		<script src="login_ajax.js"></script>
	 
	</head>
	<body style="background-image: url(login_background.jpg); background-size: cover;" onload="process()">
		<div class="container">
			<br><br><br>
			<div class="row text-center">
				<div class="flexslider set-flexi" id="main-section">
					<ul class="slides move-me">
						<!-- Slider 01 -->
						<li>
							  <h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">WELCOME</div><br><br>
							<a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							 
						</li>
						<!-- End Slider 01 -->
						
						<!-- Slider 02 -->
						<li>
							<h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">TO OUR FUTURE!</div><br><br>
							 <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							
						</li>
						<!-- End Slider 02 -->
						
						<!-- Slider 03 -->
						<li>
							<h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">CHECK YOUR GRADES</div><br><br>
							 <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							
						</li>
						<!-- End Slider 03 -->
						
						<!-- Slider 04 -->
						<li>
							<h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">WHAT YOU'RE<br>CURRENTLY ENROLLED</div><br><br>
							 <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							
						</li>
						<!-- End Slider 04 -->
						
						<!-- Slider 05 -->
						<li>
							<h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">CONNECT WITH YOUR CLASSMATES<br>AND TEACHERS</div><br><br>
							 <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							
						</li>
						<!-- End Slider 05 -->
						
						<!-- Slider 05 -->
						<li>
							<h4>MINDANAO STATE UNIVERSITY<br>
								<span style="font-weight: bold; ">TAWI-TAWI COLLEGE OF TECHNOLOGY AND OCEANOGRAPHY</span></h4>
								<h2>SOCIO-EDUCATIONAL CYBER ENVIRONMENT</h2>
						   <div style="font-family: tahoma; font-size: 60px;">AND MORE...</div><br><br>
							 <a href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ln">
								Login
							</a>
							 
						</li>
						<!-- End Slider 05 -->
					</ul>
				</div>

				<div style="color: red;">

					<?php
						if(isset($_GET['mark'])){
							
							echo "Incorrect ID Number and Password";
						}else if(isset($block_mark)){
							echo "Your Account is <b>Blocked!</b><br>You Cannot Login Temporarily";
						}
					?>
				</div>
				
			</div>
			
		</div>
	   
	   <div class="modal fade" id="ln" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white; background-color:#16639f" class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 style="color:white" class="modal-title" id="myModalLabel">Login</h4>
				</div>
				<div class="modal-body">

					<form method="post" action="index.php">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="ID Number" id="id" name="id_number" value="<?php if(isset($_GET['id_number'])){echo $_GET['id_number'];} ?>" required>
								<div style="text-align: center; margin-top: 5px;" id="user_check"></div>
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" required>
							</div>
						</fieldset>

				</div>
				<div class="modal-footer">
				   
					<button class="btn btn-md btn-success btn-block" name="user_login"><b class="glyphicon glyphicon-log-in"></b> Sign In</button>
					</form>
				</div>
            </div>
          </div>
        </div>
		
	   </body>
	   </html>