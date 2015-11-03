<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Events | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($date ='', $year ='', $month ='', $time ='', $location ='', $event_title = '', $description ='', $about_event ='', $image ='', $error = '', $id = ''){ ?>
				<?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";} ?>
	<div class="container">
		<div class="col-md-12">
				<form action="" method="post">
					<?php if ($id != '') { 
						echo'<input type="hidden" name="id" value="'.$id.'" />';
						}
					?>
					<div class="col-md-3">
						<div class="form-group">
							<label>Date</label>
							<input class="form-control" type="text" name="date" value="<?php echo $date; ?>"/>
						</div>
						<div class="form-group">
							<label>Year</label>
							<input class="form-control" type="text" name="year" value="<?php echo $year; ?>"/>
						</div>
						<div class="form-group">
							<label>Month</label>
							<input class="form-control" type="text" name="month" value="<?php echo $month; ?>"/>
						</div>
						<div class="form-group">
							<label>Time</label>
							<input class="form-control" type="text" name="time" value="<?php echo $time; ?>"/>
						</div>
						<div class="form-group">
							<label>Location</label>
							<input class="form-control" type="text" name="location" value="<?php echo $location; ?>"/>
						</div>
						<div class="form-group">
							<label>Event Title</label>
							<input class="form-control" type="text" name="event_title" value="<?php echo $event_title; ?>"/>
						</div>
						<div class="form-group">
							<label>Event Description</label>
							<input class="form-control" type="text" name="description" value="<?php echo $description; ?>"/>
						</div>
						<div class="form-group">
							<label>Event Image</label>
							<input class="form-control" type="text" name="image" value="<?php echo $image; ?>"/>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label>About Event</label>
								<textarea rows="30" class="form-control" type="text" name="about_event" value=""><?php echo $about_event; ?></textarea><br/>
						</div>
					</div>
		</div>
		<div class="col-md-12">
					<button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
				</form>
		</div>
	</div>
	<?php
	}if (isset($_GET['id'])){
		if (isset($_POST['submit'])){
			if (is_numeric($_POST['id'])){
				$id = $_POST['id'];
				$date = htmlentities($_POST['date'], ENT_QUOTES);
				$year = htmlentities($_POST['year'], ENT_QUOTES);
				$month = htmlentities($_POST['month'], ENT_QUOTES);
				$time = htmlentities($_POST['time'], ENT_QUOTES);
				$location = htmlentities($_POST['location'], ENT_QUOTES);
				$event_title = htmlentities($_POST['event_title'], ENT_QUOTES);
				$description = htmlentities($_POST['description'], ENT_QUOTES);
				$about_event = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['about_event']);
				$image = htmlentities($_POST['image'], ENT_QUOTES);
					if ($stmt = $conn->prepare("UPDATE events SET date = ?, year = ?, month = ?, time = ?, location = ?, event_title = ?, description = ?, about_event = ?, image = ? WHERE id=?")){
						$stmt->bind_param("sssssssssi", $date, $year, $month, $time, $location, $event_title, $description, $about_event, $image, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=events");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, date, year, month, time, location, event_title, description, about_event, image FROM events WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $date, $year, $month, $time, $location, $event_title, $description, $about_event, $image);
					$stmt->fetch();
					renderForm($date, $year, $month, $time, $location, $event_title, $description, $about_event, $image, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=events");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
				$date = htmlentities($_POST['date'], ENT_QUOTES);
				$year = htmlentities($_POST['year'], ENT_QUOTES);
				$month = htmlentities($_POST['month'], ENT_QUOTES);
				$time = htmlentities($_POST['time'], ENT_QUOTES);
				$location = htmlentities($_POST['location'], ENT_QUOTES);
				$event_title = htmlentities($_POST['event_title'], ENT_QUOTES);
				$description = htmlentities($_POST['description'], ENT_QUOTES);
				$about_event = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['about_event']);;
				$image = htmlentities($_POST['image'], ENT_QUOTES);
			if ($event_title == '' || $date == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($date, $year, $month, $time, $location, $event_title, $description, $about_event, $image, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT events (date, year, month, time, location, event_title, description, about_event, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")){
					$stmt->bind_param("sssssssss", $date, $year, $month, $time, $location, $event_title, $description, $about_event, $image);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=events");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}