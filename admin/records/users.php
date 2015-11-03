<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Users | Edit";
include ('../header.php');
include ('../navbar.php');
function renderForm($username = '', $email ='', $active ='', $rank ='', $unit ='', $position ='', $status ='', $user_avt ='', $bio ='', $gender ='', $birthday ='', $website ='', $location ='', $occupation ='', $admin ='', $steam ='', $facebook ='', $twitter ='', $youtube ='', $instagram ='', $twitch ='', $skype ='', $github ='', $googleplus ='', $pinterest ='', $tumblr ='', $year ='', $month ='', $day ='', $games ='',  $error = '', $id = ''){ ?>
<?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";} ?>
<br>
<div class="container-fluid">
	<form action="" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php if ($id != '') { echo'<input type="hidden" username="id" value="'.$id.'" />'; }?>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2">
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
				</div>
				<div class="col-md-2">
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
						<select class="form-control" name="position">
							<option value="<?echo $position;?>"><?echo $position;?></option>
							<option value="Server Management">Server Management</option>
							<option value="Administrator">Global Administrator</option>
							<option value="Game Administrator">Game Administrator</option>
							<option value="Forum Administrator">Forum Administrator</option>
							<option value="Teamspeak Administrator">Teamspeak Administrator</option>
							<option value="Moderator">Global Moderator</option>
							<option value="Game Moderator">Game Moderator</option>
							<option value="Forum Moderator">Forum Moderator</option>
							<option value="Teamspeak Moderator">Teamspeak Moderator</option>
							<option value="BluFor Member">BluFor Member</option>
							<option value="BluFor Guest">BluFor Guest</option>
							<option value="Member">Member</option>
							<option value="Guest">Guest</option>
						</select>  
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Status</label>
							<select class="form-control" name="status">
								<option value="<?echo $status;?>"><?echo $status;?></option>
								<option value="Active">Active</option>
								<option value="On leave">On leave</option>
							</select>  
					</div>
					<div class="form-group">
						<label>Enter Games played</label>
						<input class="form-control" type="text" name="games" value="<?php echo $games; ?>"/>
					</div>
					<div class="form-group">
						<label>Gender</label>
							<select class="form-control" name="gender">
								<option value="<?echo $gender;?>"><?echo $gender;?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Unspecified">Unspecified</option>
							</select>  
					</div>
				</div>
				<div class="col-md-2">
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
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Occupation</label>
						<input class="form-control" type="text" name="occupation" value="<?php echo $occupation; ?>"/>
					</div>
					<div class="form-group">
						<label>Admin</label>
							<select class="form-control" name="admin">
								<option value="<?echo $admin;?>"><?echo $admin;?></option>
								<option value="">False</option>
								<option value="true">True</option>
							</select>  
					</div>
					<div class="form-group">
						<label>Display Birthday &amp; Age?</label>
							<select class="form-control" name="birthday">
								<option value="<?echo $birthday;?>"><?php if(!empty($birthday)){ echo $birthday; }else{ echo'Yes or No?'; } ?> </option>
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>  
					</div>
				</div>
				<div class="col-md-2">	
					<div class="form-group">
						<label>User Avatar</label>
						<input class="form-control" type="text" name="user_avt" value="<?php echo $user_avt; ?>"/>
					</div>
					<div class="form-group">
						<pre>To use <a href="https://en.gravatar.com/">Gavatar</a>, simply ender "gavatar" into the box, or you may specify a direct URL, like "https://i.imgur.com/6BpptUH.png" </pre>
					</div>
					<div class="form-group">
					<label>Submit</label><br>
						<button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-1">
					<div class="form-group">
						<label>Steam</label>
						<input class="form-control" type="text" name="steam" value="<?php echo $steam; ?>"/>
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input class="form-control" type="text" name="facebook" value="<?php echo $facebook; ?>"/>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>Twitter</label>
						<input class="form-control" type="text" name="twitter" value="<?php echo $twitter; ?>"/>
					</div>
					<div class="form-group">
						<label>YouTube</label>
						<input class="form-control" type="text" name="youtube" value="<?php echo $youtube; ?>"/>
					</div>
					<div class="form-group">
						<label>GitHub</label>
						<input class="form-control" type="text" name="github" value="<?php echo $github; ?>"/>
					</div>
				</div>
				<div class="col-md-1">				
					<div class="form-group">
						<label>Instagram</label>
						<input class="form-control" type="text" name="instagram" value="<?php echo $instagram; ?>"/>
					</div>
					<div class="form-group">
						<label>Twitch</label>
						<input class="form-control" type="text" name="twitch" value="<?php echo $twitch; ?>"/>
					</div>
					<div class="form-group">
						<label>Skype</label>
						<input class="form-control" type="text" name="skype" value="<?php echo $skype; ?>"/>
					</div>
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>Google Plus</label>
						<input class="form-control" type="text" name="googleplus" value="<?php echo $googleplus; ?>"/>
					</div>
					<div class="form-group">
						<label>Pinterest</label>
						<input class="form-control" type="text" name="pinterest" value="<?php echo $pinterest; ?>"/>
					</div>
					<div class="form-group">
						<label>Tumblr</label>
						<input class="form-control" type="text" name="tumblr" value="<?php echo $tumblr; ?>"/>
					</div>				
				</div>
					<?php
					echo '
					<div class="col-md-1">
						<div class="form-group">
						<label> Year</label>
							<select  class="form-control" name="year">
								<option value="'.$year.'">';if(!empty($year)){ echo $year; }else{ echo'Year'; } echo'</option>';
									for($i = date('Y'); $i >= date('Y', strtotime('-100 years')); $i--){	
									echo "<option value='$i'>$i</option>";
									}
								echo '
							</select>
						</div>
						<div class="form-group">
						<label>Month</label>
							<select  class="form-control" name="month">
								<option value="'.$month.'">'; if(!empty($month)){ echo $month; }else{ echo'Month'; } echo'</option>';
									for($i = 1; $i <= 12; $i++) {
										$i = str_pad($i, 2, 0, STR_PAD_LEFT);
										echo "<option value='$i'>$i</option>";
										}
									echo '
							</select>
						</div>
						<div class="form-group">
						<label>Day</label>
							<select  class="form-control" name="day">
								<option value="'.$day.'">';if(!empty($day)){ echo $day; }else{ echo'Day'; } echo'</option>';
									for($i = 1; $i <= 31; $i++){
										$i = str_pad($i, 2, 0, STR_PAD_LEFT);
										echo "<option value='$i'>$i</option>";
										}
										?>
							</select>							
						</div>
					</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Bio</label>
						<textarea rows="30" class="form-control" type="text" name="bio" value=""><?php echo $bio; ?></textarea><br/>
				</div>
			</div>
			</div>
		</div>
	</form>
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
				$steam = htmlentities($_POST['steam'], ENT_QUOTES);
				$facebook = htmlentities($_POST['facebook'], ENT_QUOTES);
				$twitter = htmlentities($_POST['twitter'], ENT_QUOTES);
				$youtube = htmlentities($_POST['youtube'], ENT_QUOTES);
				$instagram = htmlentities($_POST['instagram'], ENT_QUOTES);
				$twitch = htmlentities($_POST['twitch'], ENT_QUOTES);
				$skype = htmlentities($_POST['skype'], ENT_QUOTES);
				$github = htmlentities($_POST['github'], ENT_QUOTES);
				$googleplus = htmlentities($_POST['googleplus'], ENT_QUOTES);
				$pinterest = htmlentities($_POST['pinterest'], ENT_QUOTES);
				$tumblr = htmlentities($_POST['tumblr'], ENT_QUOTES);
				$year = htmlentities($_POST['year'], ENT_QUOTES);
				$month = htmlentities($_POST['month'], ENT_QUOTES);
				$day = htmlentities($_POST['day'], ENT_QUOTES);
				$games = htmlentities($_POST['games'], ENT_QUOTES);
				if ($username == '' || $email == ''){
					$error = 'ERROR: Please fill in all required fields!';
					renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games, $error, $id);
				}else{
					if ($stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, active = ?, rank = ?, unit = ?, position = ?, status = ?, user_avt = ?, bio = ?, gender = ?, birthday = ?, website = ?, location = ?, occupation = ?, admin = ?, steam =?, facebook =?, twitter =?, youtube =?, instagram =?, twitch =?, skype =?, github =?, googleplus =?, pinterest = ?, tumblr = ?, year = ?, month = ?, day = ?, games = ? WHERE id=?")){
						$stmt->bind_param("ssssssssssssssssssssssssssssssi", $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games, $id);
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
				if($stmt = $conn->prepare("SELECT id, username, email, active, rank, unit, position, status, user_avt, bio, gender, birthday, website, location, occupation, admin, steam, facebook, twitter, youtube, instagram, twitch, skype, github, googleplus, pinterest, tumblr, year, month, day, games FROM users WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games);
					$stmt->fetch();
					renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games, NULL, $id);
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
				$bio = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['bio']);;
				$gender = htmlentities($_POST['gender'], ENT_QUOTES);
				$birthday = htmlentities($_POST['birthday'], ENT_QUOTES);
				$website = htmlentities($_POST['website'], ENT_QUOTES);
				$location = htmlentities($_POST['location'], ENT_QUOTES);
				$occupation = htmlentities($_POST['occupation'], ENT_QUOTES);
				$admin = htmlentities($_POST['admin'], ENT_QUOTES);
				$steam = htmlentities($_POST['steam'], ENT_QUOTES);
				$facebook = htmlentities($_POST['facebook'], ENT_QUOTES);
				$twitter = htmlentities($_POST['twitter'], ENT_QUOTES);
				$youtube = htmlentities($_POST['youtube'], ENT_QUOTES);
				$instagram = htmlentities($_POST['instagram'], ENT_QUOTES);
				$twitch = htmlentities($_POST['twitch'], ENT_QUOTES);
				$skype = htmlentities($_POST['skype'], ENT_QUOTES);
				$github = htmlentities($_POST['github'], ENT_QUOTES);
				$googleplus = htmlentities($_POST['googleplus'], ENT_QUOTES);
				$pinterest = htmlentities($_POST['pinterest'], ENT_QUOTES);
				$tumblr = htmlentities($_POST['tumblr'], ENT_QUOTES);
				$year = htmlentities($_POST['year'], ENT_QUOTES);
				$month = htmlentities($_POST['month'], ENT_QUOTES);
				$day = htmlentities($_POST['day'], ENT_QUOTES);
				$games = htmlentities($_POST['games'], ENT_QUOTES);
			if ($username == '' || $email == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT users (username, email, active, rank, unit, position, status, user_avt, bio, gender, birthday, website, location, occupation, admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
					$stmt->bind_param("ssssssssssssssssssssssssssssss", $username, $email, $active, $rank, $unit, $position, $status, $user_avt, $bio, $gender, $birthday, $website, $location, $occupation, $admin);
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