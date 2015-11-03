<?php
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$i = substr($actual_link, (strpos($actual_link, '='))+1, strlen($actual_link));
$title = "Events";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
echo '
<div class="container">	 
		<div class="col-md-10 col-md-offset-2">
			<ul class="event-list">';
$a = array( 
 '01'=>'Jan', 
 '02'=>'Feb', 
 '03'=>'Mar', 
 '04'=>'Apr', 
 '05'=>'May', 
 '06'=>'Jun', 
 '07'=>'Jul', 
 '08'=>'Aug', 
 '09'=>'Sep', 
 '10'=>'Oct', 
 '11'=>'Nov', 
 '12'=>'Dec', 
);  
$sql = "SELECT * FROM events WHERE id = '$i'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				 $m = $row['month'];
				echo '
					<li>
						<time datetime="'.$row['year'] .'-'. $row['month'] .'-'. $row['date'] .' '. $row['time'] .'">
							<span class="day">'.$row['date'].'</span>
							<span class="month">'.$a[$m] .'</span>
							<span class="year">'.$row['year'].'</span>
							<span class="time">'.$row['time'].'</span>
						</time>
						<div class="info">
							<h2 class="title">'.$row['event_title'].'</h2>
							<ul>
								<li style="width:10%;"><a href="#"><span class="fa fa-clock-o"></span> '.$row['time'].' EST </a></li>
								<li style="width:10%;"><a href="#"><span class="fa fa-calendar-o"></span> '.$row['date'].' </a></li>
								<li style="width:10%;"><a href="#"><span class="fa fa-map-marker"></span> '.$row['location'].'</a></li>
							</ul>
						</div>
					</li>';
			}
		}
echo '</ul>
	</div>';
$sql = "SELECT * FROM events WHERE id = '$i'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$etitle = $row['event_title'];
			echo '
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Signed up</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
				$stat = "";
				$usr = "";
					$sql = "SELECT * FROM event_signup WHERE event_title = '$etitle'";
					$result = mysqli_query($conn, $sql); 
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$ii = $row['id'];
									if ($row['username'] == $s_user){
									$usr = $row['username'];
									}
									$stat = $row['status'];
									echo '
									<tr>
										<td>'.$row['username'].'</td>
										<td>'.$row['status'].'</td>
									</tr>';
							}
						}
						setcookie('etitle', $etitle);	
						setcookie('i', $i);
	echo'		</tbody>
			</table>';
	echo '</div>';
		if($user->is_logged_in()){
			if($usr != $s_user){
			echo '<a class="btn btn-success" href="signup.php">Sign up</a>';
			}else{
				echo '<a class="btn btn-warning" href="signup.php?id='.$ii.'">Edit Sign-up</a>';
			}			
		}
	echo'</div>';		
		}
	}
$sql = "SELECT * FROM events WHERE id = '$i'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
echo '
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">About '.$row['event_title'].'</h3>
			</div>
			<div class="panel-body">
				'.$row['about_event'].'
			</div>
		</div>
	</div>';
		}
	}
echo '</div>';
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');