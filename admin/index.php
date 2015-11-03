<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
			if(empty($_GET['admin'])){
				$title = "Admin";
				include ('header.php');
				include ('navbar.php');
?>
   <div class="container-fluid">
    <div class="side-body">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-tachometer fa-fw"></i>&nbsp; Site Dashboard</h3>
				</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						<a href="?admin=users" class="btn btn-primary btn-lg" role="button"><i class="fa fa-users fa-fw"></i> <br/>Users</a>
						<a href="?admin=news" class="btn btn-primary btn-lg" role="button"><i class="fa fa-newspaper-o fa-fw"></i> <br/>News</a>
						<a href="?admin=navbar" class="btn btn-primary btn-lg" role="button"><i class="fa fa-bars fa-fw"></i> <br/>Navbar</a>
					</div>
					<div class="col-xs-6 col-md-6">
						<a href="?admin=events" class="btn btn-primary btn-lg" role="button"><i class="fa fa-calendar fa-fw"></i> <br/>Events</a>
						<a href="?admin=roster" class="btn btn-primary btn-lg" role="button"><i class="fa fa-list-alt fa-fw"></i> <br/>Roster</a>
						<a href="?admin=awards" class="btn btn-primary btn-lg" role="button"><i class="fa fa-trophy fa-fw"></i> <br/>Awards</a>
						<a href="?admin=uawards" class="btn btn-primary btn-lg" role="button"><i class="fa fa-users fa-fw"></i> + <i class="fa fa-trophy fa-fw"></i> <br/></a>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-inbox fa-fw"></i>&nbsp; Admin Shoutbox</h3>
				</div>
					<div class="panel-body">
					</div>
			</div>
		</div>
	</div>
</div>
<?php
}else if($_GET['admin'] == "users"){
	$title = "Admin | Users";
	include ('header.php');
	include ('navbar.php');
?>
<div class="container">
	<div class="col-md-2">
		<form action="#" method="get">
			<div class="input-group">
				<input class="form-control" autocomplete="off" id="system-search" name="q" placeholder="Search for...?" required>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
					</span>
			</div>
		</form>
	<br>
	</div>
	<div class="col-md-12">
	<?php
echo '<div class="table-responsive">
		<table class="table table-bordered table-list-search">
				<thead>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Active</th>
						<th>Email</th>
						<th>Rank</th>';
				if($system == "arma"){
					echo '<th>Unit</th>';
					}else if($system == "minecraft"){
						echo '<th>Group</th>';
						}echo'
						<th>Postion</th>
						<th>Status</th>
						<th>Location</th>
						<th>Occupation</th>
						<th>Admin</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
			<tbody>';
		$sql = "SELECT * FROM users ORDER BY id ASC";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
		echo'<tr>
				<td>' . $row['id'] . '</td>
				<td><a href="http://'. DIR .'/users/user.php?='. $row['username'] . '">'.  $row['username'] .'</a></td>
				<td>' . $row['active'] . '</td>
				<td>' . $row['email'] . '</td>
				<td>' . $row['rank'] . '</td>
				<td>' . $row['unit'] . '</td>
				<td>' . $row['position'] . '</td>
				<td>' . $row['status'] . '</td>
				<td>' . $row['location'] . '</td>
				<td>' . $row['occupation'] . '</td>
				<td>' . $row['admin'] . '</td>
				<td><a class="btn btn-warning" href="records/users.php?id='. $row['id'] .'"><i class="fa fa-pencil fa-fw"></i></a></td>
				<td><a class="btn btn-danger" href="delete/users.php?id='. $row['id'] .'"><i class="fa fa-times fa-fw"></i></a></td>
			</tr>';
			}
		}
	echo'</tbody>
	</table>
	</div>';
	?>
	</div>
	<div class="col-md-1 pull-right">
		<a class=" btn btn-success" href="records/users.php"><i class="fa fa-plus fa-fw"></i></a>
	</div>
</div>
<?php
	}else if($_GET['admin'] == "roster" ){
		$title = "Admin | Roster";
		include ('header.php');
		include ('navbar.php');
?>
<div class="container">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Unit</th>
					<th>Image</th>
					<th>About</th>
					<th>About Internal</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
	<?php
			$sql = "SELECT * FROM roster";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo '<tr>
					<td>' . $row['id'] . '</td>
					<td>'. $row['unit'] .'</td>
					<td><img src="'; if (empty($row['image'])){ echo 'http://placehold.it/50x50'; } else { echo $row['image']; } echo'"></td>
					<td>' . $row['about'] . '</td>
					<td>' . $row['about_internal'] . '</td>
					<td><a class="btn btn-warning" href="records/roster.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
					<td><a class="btn btn-danger" href="delete/roster.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
					</tr>';	
				}
		}
	?>
			</tbody>
		</table>
	</div>
	<div class="col-md-1 pull-right">
		<a class=" btn btn-success" href="records/roster.php"><i class="fa fa-plus fa-fw"></i></a>
	</div>
</div>
<?php
	}else if($_GET['admin'] == "news" ){
		$title = "Admin | News";
		include ('header.php');
		include ('navbar.php');
echo'<div class="container">
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Title</th>	
								<th>Body</th>
								<th>Posted By</th>
								<th>Date</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>';
					$sql = "SELECT * FROM news ORDER BY id DESC";
					$result = mysqli_query($conn, $sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$timeresult = date(" l, d, F, Y", strtotime($row['date']));
							echo'		
								<tr>
									<td>' . $row['id'] . '</td>
									<td>' . $row['title'] . '</td>
									<td>' . $row['body'] . '</td>
									<td><a href="'.DIR.'/users/user.php?=' . $row['puser'] . '">' . $row['puser'] . '</a></td>
									<td>' . $timeresult . '</td>
									<td><a class="btn btn-warning" href="records/news.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
									<td><a class="btn btn-danger" href="delete/news.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
								</tr>';
							}
				}		
				echo'</tbody>
				</table>
			</div>
	<div class="col-md-1">
		<a href="records/news.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>
</div>';
}else if($_GET['admin'] == "awards" ){
	$title = "Admin | Awards";
	include ('header.php');
	include ('navbar.php');
	echo '
<div class="container">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Award</th>
					<th>Award Image</th>
					<th>About Award</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
		$sql = "SELECT * FROM awards";
		$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo'		
						<tr>
							<td>' . $row['id'] . '</td>
							<td>' . $row['award_name'] . '</td>
							<td>' . $row['award_image_link'] . '</td>
							<td>' . $row['award_about'] . '</td>
							<td><a class="btn btn-warning" href="records/awards.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
							<td><a class="btn btn-danger" href="delete/awards.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
						</tr>';
					}
			}		
		echo'</tbody>
		</table>
	</div>
	<div class="col-md-1">
		<a href="records/awards.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>
</div>';
}else if($_GET['admin'] == "events" ){
	$title = "Admin | Events";
	include ('header.php');
	include ('navbar.php');
	echo'
<div class="container">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Event Title</th>
					<th>Date</th>
					<th>Time</th>
					<th>Month</th>
					<th>Year</th>
					<th>Location</th>
					<th>Description</th>
					<th>Event Info</th>
					<th>Event Image</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
			$sql = "SELECT * FROM events";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$dateraw = $row['year'].$row['month'].$row['date'];
					$timeraw = $row['time'];
					$date = date(" D d, F Y", strtotime($dateraw));
					$time = date("g:iA", strtotime($timeraw));
				echo'
				<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['event_title'] . '</td>
					<td>' . $date . '</td>
					<td>' . $time . '</td>
					<td>' . $row['month'] . '</td>
					<td>' . $row['year'] . '</td>
					<td>' . $row['location'] . '</td>
					<td>' . $row['description'] . '</td>
					<td>' . $row['about_event'] . '</td>
					<td><img class="img-responsive" src="' . $row['image'] . '"></img></td>
					<td><a class="btn btn-warning" href="records/events.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
					<td><a class="btn btn-danger" href="delete/events.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
				</tr>';
				}
			}
		echo'
			</tbody>
		</table>
	</div>
</div>
	<div class="col-md-1">
		<a href="records/events.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>';
}else if($_GET['admin'] == 'navbar'){
	$title = 'Admin | Navbar';
	include('header.php');
	include('navbar.php');
	echo'
<div class="container">
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Link</th>
					<th>Title</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
			$sql = "SELECT * FROM navbar";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo'
				<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['link'] . '</td>
					<td>' . $row['title'] . '</td>
					<td><a class="btn btn-warning" href="records/navbar.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
					<td><a class="btn btn-danger" href="delete/navbar.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
				</tr>';
				}
			}
		echo'
			</tbody>
		</table>
		<a href="records/navbar.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Link</th>
					<th>Title</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
			$sql = "SELECT * FROM navbar_right";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo'
				<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['link'] . '</td>
					<td>' . $row['title'] . '</td>
					<td><a class="btn btn-warning" href="records/navbar_right.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
					<td><a class="btn btn-danger" href="delete/navbar_right.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
				</tr>';
				}
			}
		echo'
			</tbody>
		</table>
		<a href="records/navbar_right.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>
</div>';
}else if($_GET['admin'] == 'uawards'){
	$title = "Admin | Events";
	include ('header.php');
	include ('navbar.php');
	echo'
<div class="container">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Award (Image)</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
			$sql = "SELECT * FROM user_awards";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
				echo'
				<tr>
					<td>' . $row['id'] . '</td>
					<td><a href="'.DIR.'/users/user.php?=' . $row['username'] . '">' . $row['username'] . '</a></td>
					<td><img class="img-responsive" src="' . $row['award_link'] . '"></img></td>
					<td><a class="btn btn-warning" href="records/uawards.php?id=' . $row['id'] . '"><i class="fa fa-pencil fa-fw"></i></a></td>
					<td><a class="btn btn-danger" href="delete/uawards.php?id=' . $row['id'] . '"><i class="fa fa-times fa-fw"></i></a></td>
				</tr>';
				}
			}
		echo'
			</tbody>
		</table>
	</div>
</div>
	<div class="col-md-1">
		<a href="records/uawards.php" class="btn btn-success"><i class="fa fa-plus"></i></a>
	</div>';	
}
//End of Admin
}else{
include ('header.php');
include ('navbar.php');
echo'<div class="container"><div style="text-align:center;" class="alert alert-danger" role="alert">YOU ARE NOT AN ADMIN!</div></div>';
header( "refresh:3;url=/" ); 
}
}else{
header('Location: /login/');
}
include ('footer.php');
?>