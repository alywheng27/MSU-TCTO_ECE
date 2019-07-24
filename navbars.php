<?php
	if($role == "Student"){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div  style="background-color: #0045b6"> <!--  0045b6 373333 -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="?student=true&post=Administrator"><span class='glyphicon glyphicon-home'></span> MSU-TCTO S-ECE</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav side-nav" style="background-color: #004cca;"> <!--  004cca 443f3f -->
						<li style="font-size: 18px; color: white; margin: 13px;">&nbsp; &nbsp; &nbsp; NEWSFEED </li>
						<li><a href="?student=true&post=Administrator"> Administrator </a></li>
						<?php
							$query = "SELECT subject FROM subjects JOIN accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
							$query_run = mysql_query($query);
							while($query_row = mysql_fetch_assoc($query_run)){
								echo '<li><a href="?student=true&post='.$query_row['subject'].'" style="padding: 8px; padding-left: 15px;">'.$query_row['subject'].'</a></li>';
							}
						?>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="?profile=true&myProfile=true">PROFILE</a></li>
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown">GRADES<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									$query = "SELECT DISTINCT semester, year FROM grades WHERE id_number = '$id_number' ORDER BY year DESC";
									$query_run = mysql_query($query);
									while($query_row = mysql_fetch_assoc($query_run)){
										echo '<li><a href="?semester='.$query_row['semester'].'&year='.$query_row['year'].'">'.$query_row['semester'].' ('.$query_row['year'].')</a></li>';
									}
									if(mysql_num_rows($query_run) == 0){
										echo '<li><a>NO GRADES</a></li>';
									}
								?>
							</ul>
						</li>
						<li><a href="?subject_enrolled=true">SUBJECT ENROLLED</a></li>
						<li><a href="?curriculum=true">CURICCULUM</a></li>
						<li><a href="?billing_accounts=true">BILLING ACCOUNTS</a></li>
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown">CHAT<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									$query = "SELECT subject FROM subjects join accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
									$query_run = mysql_query($query);
									while($query_row = mysql_fetch_assoc($query_run)){
										echo '<li><a href="?subject='.$query_row['subject'].'">'.$query_row['subject'].'</a></li>';
									}
									if(mysql_num_rows($query_run) == 0){
										echo '<li><a>NO CHAT</a></li>';
									}
								?>
							</ul>
						</li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="?change_password=true"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
								<li><a href="logout.php"><i class="fa fa-power-off"></i> LOGOUT</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}else if($role == "Parent"){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div  style="background-color: #0045b6"> <!--  0045b6 -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href=""><span class='glyphicon glyphicon-home'></span> MSU-TCTO S-ECE</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav side-nav" style="background-color: #004cca;"> <!--  004cca -->
						<li style="font-size: 18px; color: white; margin: 13px;">&nbsp; &nbsp; &nbsp; NEWSFEED </li>
						<li><a href="?student=true&post=Administrator"> Administrator </a></li>
						<?php
							$query = "SELECT subject FROM subjects JOIN accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
							$query_run = mysql_query($query);
							while($query_row = mysql_fetch_assoc($query_run)){
								echo '<li><a href="?student=true&post='.$query_row['subject'].'" style="padding: 8px; padding-left: 15px;">'.$query_row['subject'].'</a></li>';
							}
						?>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="?profile=true&myProfile=true">PROFILE</a></li>
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown">GRADES<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									$query = "SELECT DISTINCT semester, year FROM grades WHERE id_number = '$id_number' ORDER BY year DESC";
									$query_run = mysql_query($query);
									while($query_row = mysql_fetch_assoc($query_run)){
										echo '<li><a href="?semester='.$query_row['semester'].'&year='.$query_row['year'].'">'.$query_row['semester'].' ('.$query_row['year'].')</a></li>';
									}
									if(mysql_num_rows($query_run) == 0){
										echo '<li><a>NO GRADES</a></li>';
									}
								?>
							</ul>
						</li>
						<li><a href="?subject_enrolled=true">SUBJECT ENROLLED</a></li>
						<li><a href="?curriculum=true">CURICCULUM</a></li>
						<li><a href="?billing_accounts=true">BILLING ACCOUNTS</a></li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="?change_password=true"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
								<li><a href="logout.php"><i class="fa fa-power-off"></i> LOGOUT</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}else if($role == "Instructor"){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div  style="background-color: #0045b6">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href=""><span class='glyphicon glyphicon-home'></span> MSU-TCTO S-ECE</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav side-nav" style="background-color: #004cca;">
						<li style="font-size: 18px; color: white; margin: 13px;"> &nbsp; &nbsp; &nbsp; NEWSFEED </li>
						<li><a href="?instructor=true&post=Administrator"> Administrator </a></li>
						<?php
							$query = "SELECT subject FROM subjects join accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
							$query_run = mysql_query($query);
							while($query_row = mysql_fetch_assoc($query_run)){
								echo '<li><a href="?instructor=true&post='.$query_row['subject'].'" style="padding: 8px; padding-left: 15px;">'.$query_row['subject'].'</a></li>';
							}
						?>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="?profile=true&myProfile=true">PROFILE</a></li>
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown">SUBMIT GRADES<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									$query = "SELECT subject FROM subjects join accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
									$query_run = mysql_query($query);
									while($query_row = mysql_fetch_assoc($query_run)){
										echo '<li><a href="?submit_grade_subject='.$query_row['subject'].'">'.$query_row['subject'].'</a></li>';
									}
									if(mysql_num_rows($query_run) == 0){
										echo '<li><a>NO SUBJECTS</a></li>';
									}
								?>
							</ul>
						</li>
						<li><a href="?teaching_load=true">TEACHING LOAD</a></li>
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown">CHAT<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
									$query = "SELECT subject FROM subjects join accounts on accounts.id_number = subjects.id_number where accounts.first_name = '".$name."'";
									$query_run = mysql_query($query);
									while($query_row = mysql_fetch_assoc($query_run)){
										echo '<li><a href="?subject='.$query_row['subject'].'">'.$query_row['subject'].'</a></li>';
									}
									if(mysql_num_rows($query_run) == 0){
										echo '<li><a>NO CHAT</a></li>';
									}
								?>
							</ul>
						</li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="?change_password=true"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
								<li><a href="logout.php"><i class="fa fa-power-off"></i> LOGOUT</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}else if($role == "Administrator"){
		?>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div  style="background-color: #0045b6">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href=""><span class='glyphicon glyphicon-home'></span> MSU-TCTO S-ECE</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav side-nav" style="background-color: #004cca;">
						<li style="font-size: 18px; color: white; margin: 13px;"> &nbsp; &nbsp; &nbsp; NEWSFEED </li>
						<li><a href="?instructor=true&post=Administrator"> Administrator </a></li>
						<?php
							$query = "SELECT DISTINCT subject FROM subjects";
							$query_run = mysql_query($query);
							while($query_row = mysql_fetch_assoc($query_run)){
								echo '<li><a href="?instructor=true&post='.$query_row['subject'].'" style="padding: 8px; padding-left: 15px;">'.$query_row['subject'].'</a></li>';
							}
						?>
					</ul>
					<ul class="nav navbar-nav">
						<li><a href="?change=true">PROFILE</a></li>
						<li><a href="?add_user=true">ADD USER</a></li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="" class="dropdwon-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="?change_password=true"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
								<li><a href="logout.php"><i class="fa fa-power-off"></i> LOGOUT</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php
	}
?>

