<?php
session_start;
$title = " Events | Sign Up";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
	    $etitle = $_COOKIE["etitle"];
	    $i = $_COOKIE["i"];
function renderForm($username = '', $event_title ='', $status ='', $error = '', $id = ''){
	global $s_user;
	global $etitle;
	global $i;
				 if ($error != '') {
					echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
				}?>
	<div class="container">
		<form action="" method="post">
					<?php if ($id != '') { ?>
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<?php } ?>
					
						<div class="col-md-4 col-md-offset-4">
							<div class="form-group">
								<label>Username</label>
								<input class="form-control" type="text" name="username" value="<?php echo $s_user; ?>" readonly/>
							</div>
							<div class="form-group">
								<label>Event Title</label>
								<input class="form-control" type="text" name="event_title" value="<?php echo $etitle; ?>" readonly/>
							</div>
							<div class="form-group">
								<label>Status</label>
									<select class="form-control" name="status">
										<option value=" <?php if(!empty($status)){ echo $status; }else{ echo'Invited'; } ?> "><?php if(!empty($status)){ echo $status; }else{ echo'Select a status'; } ?> </option>
										<option value="Attending">Attending</option>
										<option value="Not Attending">Not Attending</option>
										<option value="Maybe">Maybe</option>
									</select>  
							</div>
							<button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
						</div>
		</form>
	<?php }
	if (isset($_GET['id'])){
		if (isset($_POST['submit'])){
			if (is_numeric($_POST['id'])){
				$id = $_POST['id'];
				$username = htmlentities($_POST['username'], ENT_QUOTES);
				$status = htmlentities($_POST['status'], ENT_QUOTES);
				$event_title = htmlentities($_POST['event_title'], ENT_QUOTES);
					if ($stmt = $conn->prepare("UPDATE event_signup SET username = ?, status = ?, event_title = ? WHERE id=?")){
						$stmt->bind_param("sssi", $username, $status, $event_title, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: could not prepare SQL statement.";
					}header("Location: /events/event.php?=$i");
			}else{
				echo "Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT * FROM event_signup WHERE id=?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $username, $status, $event_title);
					$stmt->fetch();					
					renderForm($username, $status, $event_title, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: could not prepare SQL statement";
				}
			}else{
				header("Location: /events/event.php?=$i");
			}
		}
	}else{
		if (isset($_POST['submit'])){
			// get the form data
			$username = htmlentities($_POST['username'], ENT_QUOTES);
			$status = htmlentities($_POST['status'], ENT_QUOTES);
			$event_title = htmlentities($_POST['event_title'], ENT_QUOTES);
				// insert the new record into the database
				if ($stmt = $conn->prepare("INSERT event_signup (username, status, event_title) VALUES (?, ?, ?)")){
					$stmt->bind_param("sss", $username, $status, $event_title);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: /events/event.php?=$i");			
			}else{
			renderForm();
		}
	}
	echo'</div>';
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 