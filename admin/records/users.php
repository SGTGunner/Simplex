<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Users | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($username = '', $email ='', $active ='', $rank ='', $unit ='', $position ='', $status ='', $user_avt ='', $bio ='', $gender ='', $birthday ='', $website ='', $location ='', $occupation ='', $admin ='', $error = '', $id = ''){ ?>
				<?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";} ?>
	<div class="container">
		<div class="col-md-12">
				<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<?php if ($id != '') { 
						echo'<input type="hidden" username="id" value="'.$id.'" />';
						}
					?>
					<div class="col-md-4">
						<div class="form-group">
							<label>Name</label>
							<input class="form-control" type="text" name="username" value="<?php echo $username; ?>"/>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="email" value="<?php echo $email; ?>"/>
						</div>
						<div class="form-group">
							<label>Activated</label>
							<input class="form-control" type="text" name="active" value="<?php echo $active; ?>"/>
						</div>
						<div class="form-group">
							<label>Rank</label>
							<input class="form-control" type="text" name="rank" value="<?php echo $rank; ?>"/>
						</div>
						<div class="form-group">
							<label>Unit</label>
							<input class="form-control" type="text" name="unit" value="<?php echo $unit; ?>"/>
						</div>
						<div class="form-group">
							<label>Position</label>
							<input class="form-control" type="text" name="position" value="<?php echo $position; ?>"/>
						</div>
						<div class="form-group">
							<label>Status</label>
								<select class="form-control" name="status">
									<option value="Active">Active</option>
									<option value="On leave">On leave</option>
								</select>  
						</div>
						<div class="form-group">
							<label>User Avatar</label>
							<input class="form-control" type="text" name="user_avt" value="<?php echo $user_avt; ?>"/>
						</div>
						<div class="form-group">
							<label>Gender</label>
								<select class="form-control" name="gender">
									<option value="<?php if(!empty($gender)){ echo $gender; }else{ echo''; } ?>"><?php if(!empty($gender)){ echo $gender; }else{ echo'Select a gender'; } ?> </option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="Unspecified">Unspecified</option>
								</select>  
						</div>
						<div class="form-group">
							<label>Birthday</label>
							<input class="form-control" type="text" name="birthday" value="<?php echo $birthday; ?>"/>
						</div>
						<div class="form-group">
							<label>Website</label>
							<input class="form-control" type="text" name="website" value="<?php echo $website; ?>"/>
						</div>
						<div class="form-group">
							<label>Location</label>
							<input class="form-control" type="text" name="location" value="<?php echo $location; ?>"/>
						</div>
						<div class="form-group">
							<label>Occupation</label>
							<input class="form-control" type="text" name="occupation" value="<?php echo $occupation; ?>"/>
						</div>
						<div class="form-group">
							<label>Admin</label>
								<select class="form-control" name="admin">
									<option value="<?php if(!empty($admin)){ echo 'true'; }else{ echo''; } ?>"><?php if(!empty($admin)){ echo 'True'; }else{ echo'Set if true or false'; } ?> </option>
									<option value="">False</option>
									<option value="true">True</option>
								</select>  
						</div>
					</div>
							
					
					
					
					
					<div class="col-md-8">
						<div class="form-group">
							<label>Bio</label>
								<textarea rows="30" class="form-control" type="text" name="bio" value=""><?php echo $bio; ?></textarea><br/>
						</div>
					</div>	
					<button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
				</form>
		</div>
	</div>
	<?php
	}if (isset($_GET['id'])){
		if (isset($_POST['submit'])){
			if (is_numeric($_POST['id'])){
				$id = $_POST['id'];
				$username = htmlentities($_POST['username'], ENT_QUOTES);
				$email = htmlentities($_POST['email'], ENT_QUOTES);
				$active = htmlentities($_POST['active'], ENT_QUOTES);
				$rank = htmlentities($_POST['rank'], ENT_QUOTES);
				$unit = htmlentities($_POST['unit'], ENT_QUOTES);
				$position = htmlentities($_POST['position'], ENT_QUOTES);
				$status = htmlentities($_POST['status'], ENT_QUOTES);
				$user_avt = htmlentities($_POST['user_avt'], ENT_QUOTES);
				$bio = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['bio']);;
				$gender = htmlentities($_POST['gender'], ENT_QUOTES);
				$birthday = htmlentities($_POST['birthday'], ENT_QUOTES);
				$website = htmlentities($_POST['website'], ENT_QUOTES);
				$location = htmlentities($_POST['location'], ENT_QUOTES);
				$occupation = htmlentities($_POST['occupation'], ENT_QUOTES);
				$admin = htmlentities($_POST['admin'], ENT_QUOTES);
				if ($username == '' || $email == ''){
					$error = 'ERROR: Please fill in all required fields!';
					renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $error, $id);
				}else{
					if ($stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, active = ?, rank = ?, unit = ?, position = ?, status = ?, user_avt = ?, bio = ?, gender = ?, birthday = ?, website = ?, location = ?, occupation = ?, admin = ? WHERE id=?")){
						$stmt->bind_param("sssssssssssssssi", $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=users");
				}
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, username, email, active, rank, unit, position, status, user_avt, bio, gender, birthday, website, location, occupation, admin FROM users WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin);
					$stmt->fetch();
					renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=users");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$username = htmlentities($_POST['username'], ENT_QUOTES);
			$email = htmlentities($_POST['email'], ENT_QUOTES);
			$active = htmlentities($_POST['active'], ENT_QUOTES);
			$rank = htmlentities($_POST['rank'], ENT_QUOTES);
			$unit = htmlentities($_POST['unit'], ENT_QUOTES);
			$position = htmlentities($_POST['position'], ENT_QUOTES);
			$status = htmlentities($_POST['status'], ENT_QUOTES);
			$user_avt = htmlentities($_POST['user_avt'], ENT_QUOTES);
			$bio = htmlentities($_POST['bio'], ENT_QUOTES);
			$gender = htmlentities($_POST['gender'], ENT_QUOTES);
			$birthday = htmlentities($_POST['birthday'], ENT_QUOTES);
			$website = htmlentities($_POST['website'], ENT_QUOTES);
			$location = htmlentities($_POST['location'], ENT_QUOTES);
			$occupation = htmlentities($_POST['occupation'], ENT_QUOTES);
			$admin = htmlentities($_POST['admin'], ENT_QUOTES);
			if ($username == '' || $email == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT users (username, email, active, rank, unit, position, status, user_avt, bio, gender, birthday, website, location, occupation, admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
					$stmt->bind_param("sssssssssssssss", $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=users");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}