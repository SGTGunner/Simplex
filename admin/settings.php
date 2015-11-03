<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
if($user->is_logged_in()){
	if($isadmin == 'true'){
$title = "Admin | Settings";
include ('header.php');
include ('navbar.php');
?>
<div class="container">
	<div class="jumbotron">
		<h1 class="text-center"><i class="fa fa-cogs fa-fw"></i>&nbsp;Site Settings</h1><hr>
			<div class="row">
<?php
	function renderForm($title = '', $brand ='', $copyright ='', $teamspeak ='', $system ='', $events ='', $donate ='', $gallery ='', $serverip ='', $port ='', $error = '', $id = ''){
?>
				<form action="" method="post">
					<?php if ($id != '') { ?>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<?php } ?>
				<div class="col-md-3">
					<div class="form-group">
						<label>Teamspeak Module</label>
							<select class="form-control" name="teamspeak">
								<option value="<?php echo $teamspeak; ?>"><?php if($teamspeak == "true"){echo 'True';}else{echo 'False';}?></option>
								<option value="true">True</option>
								<option value="false">False</option>
							</select>  
					</div>
					<div class="form-group">
						<label>Event Module</label>
							<select class="form-control" name="events">
								<option value="<?php echo $events; ?>"><?php if($events == "true"){echo 'True';}else{echo 'False';}?></option>
								<option value="true">True</option>
								<option value="false">False</option>
							</select>  
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Donation Module</label>
							<select class="form-control" name="donate">
								<option value="<?php echo $donate; ?>"><?php if($donate == "true"){echo 'True';}else{echo 'False';}?></option>
								<option value="true">True</option>
								<option value="false">False</option>
							</select>  
					</div>
					<div class="form-group">
						<label>Gallery Module</label>
							<select class="form-control" name="gallery">
								<option value="<?php echo $gallery; ?>"><?php if($gallery == "true"){echo 'True';}else{echo 'False';}?></option>
								<option value="true">True</option>
								<option value="false">False</option>
							</select>  
					</div>
					<div class="form-group">
						<label>System Type</label>
							<select class="form-control" name="system">
								<option value="<?php echo $system; ?>"><?php if($system == "arma"){echo 'Arma 3';}else if($system == "minecraft"){echo 'Minecraft';}else{echo 'Blog';}?></option>
								<option value="arma">Arma 3</option>
								<option value="minecraft">Minecraft</option>
								<option value="blog">Blog</option>
							</select>  
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Site Title</label>
						<input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/>
					</div>
					<div class="form-group">
						<label>Site Brand</label>
						<input class="form-control" type="text" name="brand" value="<?php echo $brand; ?>"/>
					</div>
					<div class="form-group">
						<label>Site Copyright</label>
						<input class="form-control" type="text" name="copyright" value="<?php echo $copyright; ?>"/>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Server Viewer IP</label>
						<input class="form-control" type="text" name="serverip" value="<?php echo $serverip; ?>"/>
					</div>
					<div class="form-group">
						<label>Server Viewer Port</label>
						<input class="form-control" type="text" name="port" value="<?php echo $port; ?>"/>
					</div>
					<label>Save Your Settings</label>
						<input class="btn btn-success btn-block" type="submit" name="submit" value="Save" />
				</div>
				</form>
<?php
	// if the 'id' variable is set in the URL, we know that we need to edit a record
	}if (isset($_GET['id'])){
		// if the form's submit button is clicked, we need to process the form
		if (isset($_POST['submit'])){
			// make sure the 'id' in the URL is valid
			if (is_numeric($_POST['id'])){
				// get variables from the URL/form
				$id = $_POST['id'];
				$title = htmlentities($_POST['title'], ENT_QUOTES);
				$brand = htmlentities($_POST['brand'], ENT_QUOTES);
				$copyright = htmlentities($_POST['copyright'], ENT_QUOTES);
				$teamspeak = htmlentities($_POST['teamspeak'], ENT_QUOTES);
				$system = htmlentities($_POST['system'], ENT_QUOTES);
				$events = htmlentities($_POST['events'], ENT_QUOTES);
				$donate = htmlentities($_POST['donate'], ENT_QUOTES);
				$gallery = htmlentities($_POST['gallery'], ENT_QUOTES);
				$serverip = htmlentities($_POST['serverip'], ENT_QUOTES);
				$port = htmlentities($_POST['port'], ENT_QUOTES);
				if ($title == '' || $brand == ''){
					// if they are empty, show an error message and display the form
					$error = 'ERROR: Please fill in all required fields!';
					renderForm($title, $brand, $error, $id);
				}else{
					// if everything is fine, update the record in the database
					if ($stmt = $conn->prepare("UPDATE settings SET title = ?, brand = ?, copyright = ?, teamspeak = ?, system = ?, events = ?, donate = ?, gallery = ?, serverip = ?, port = ? WHERE id=?")){
						$stmt->bind_param("ssssssssssi", $title, $brand, $copyright, $teamspeak, $system, $events, $donate, $gallery, $serverip, $port, $id);
						$stmt->execute();
						$stmt->close();
					// show an error message if the query has an error
					}else{
						echo "ERROR: could not prepare SQL statement.";
					}
					echo '<div style="text-align: center;" class="alert alert-success" role="alert">Successfully updated. Go back <a href="/admin">home</a></div>';
				}
			}
			// if the 'id' variable is not valid, show an error message
			else{
				echo "Error!";
			}
		// if the form hasn't been submitted yet, get the info from the database and show the form
		}else{
			// make sure the 'id' value is valid
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				// get 'id' from URL
				$id = $_GET['id'];
				// get the recod from the database
				if($stmt = $conn->prepare("SELECT * FROM settings WHERE id=?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id,  $title, $brand, $copyright, $teamspeak, $system, $events, $donate, $gallery, $serverip, $port);
					$stmt->fetch();
					// show the form
					renderForm( $title, $brand, $copyright, $teamspeak, $system, $events, $donate, $gallery, $serverip, $port, NULL, $id);
					
					$stmt->close();
				
				// show an error if the query has an error
				}else{
					echo "Error: could not prepare SQL statement";
				}
			// if the 'id' value is not valid, redirect the user back to the view.php page
			}else{
				echo 'Error (if the "id" value is not valid, redirect the user back to the view.php page) ';
			}
		}
	}
?>
			</div>
		</div>
</div>
<?php
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