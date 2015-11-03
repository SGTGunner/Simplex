<?php
session_start;
$title = "User | Editor";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
$us = $_SESSION['username'];
if ($id = '') {
?>
<div class="container">
<div style="text-align: center;" class="alert alert-danger" role="alert">Please return to the <a href="/users/">users</a> list. There is nothing to see here.</div>
</div>
<?php
}
?>
<br>
 <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
		      font_formats: "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Lucida Console=Monaco,monospace;Comic Sans MS=cursive,sans-serif;Trebuchet MS=Helvetica, sans-serif;Verdana=Geneva, sans-serif;",
			  fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
              plugins: [
                  "advlist wordcount autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image" 
          });
  </script>
<div class="container">
	<h1 class="text-center username" >Edit Your user profile</h1><br>
	<div class="row">
<?php
function renderForm ($bio = '', $gender ='', $birthday ='', $website ='', $location ='', $occupation ='', $status ='', $user_avt ='', $steam ='', $facebook ='', $twitter ='', $youtube ='', $instagram ='', $twitch ='', $skype ='', $github ='', $googleplus ='', $pinterest ='', $tumblr ='', $year ='', $month ='', $day ='', $games ='', $error = '', $id = ''){
  if ($error != '') {
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  } echo'
  <form action="'.$_SERVER['PHP_SELF'].'?id="'.$id.'" method="post">';
if ($id != '') { ?>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php } ?>
	<div class="col-md-12">
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							<h4 class="panel-title">
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Birthday Settings &amp; Information
								</a>
							</h4>
						</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
									<div class="form-group">
										<label>Display Birthday &amp; Age?</label>
										<?php
										if($birthday == "false"){
											$tf = "No";
										}else{
											$tf = "Yes";
										}
										?>
											<select class="form-control" name="birthday">
												<option value="<?echo $birthday?>"><?php if(!empty($birthday)){ echo $tf; }else{ echo'Yes or No?'; } ?> </option>
												<option value="true">Yes</option>
												<option value="false">No</option>
											</select>
									</div>
									<?php
									echo '
									<div class="col-md-4">
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
									</div>
									<div class="col-md-4">
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
									</div>
									<div class="col-md-4">
										<div class="form-group">
										<label>Day</label>
											<select  class="form-control" name="day">
												<option value="'.$day.'">';if(!empty($day)){ echo $day; }else{ echo'Day'; } echo'</option>';
													for($i = 1; $i <= 31; $i++){
														$i = str_pad($i, 2, 0, STR_PAD_LEFT);
														echo "<option value='$i'>$i</option>";
														}
													echo '
											</select>							
										</div>
									</div>';
									?>

								</div>
							</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingTwo">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									Profile Settings &amp; Information
								</a>
							</h4>
						</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								<div class="panel-body">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control" name="gender">
											<option value="<?echo $gender;?>"><?php if(!empty($gender)){ echo $gender; }else{ echo'Gender'; } ?> </option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
											<option value="Unspecified">Unspecified</option>
										</select>
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
											<label>Enter Games played</label>
											<input class="form-control" type="text" name="games" value="<?php echo $games; ?>"/>
										</div>										
										<pre>To use <a href="https://en.gravatar.com/">Gavatar</a>, simply ender "gavatar" into the box, or you may specify a direct URL, like "https://i.imgur.com/6BpptUH.png" </pre>
									</div>
							</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingThree">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
									Social Media Accounts
								</a>
							</h4>
						</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								<div class="panel-body">
										<div class="form-group">
											<label>Steam</label>
											<input class="form-control" type="text" name="steam" value="<?php echo $steam; ?>"/>
										</div>
										<div class="form-group">
											<label>Facebook</label>
											<input class="form-control" type="text" name="facebook" value="<?php echo $facebook; ?>"/>
										</div>
										<div class="form-group">
											<label>Twitter</label>
											<input class="form-control" type="text" name="twitter" value="<?php echo $twitter; ?>"/>
										</div>
										<div class="form-group">
											<label>YouTube</label>
											<input class="form-control" type="text" name="youtube" value="<?php echo $youtube; ?>"/>
										</div>
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
										<div class="form-group">
											<label>GitHub</label>
											<input class="form-control" type="text" name="github" value="<?php echo $github; ?>"/>
										</div>
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
							</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingFour">
							<h4 class="panel-title">
								<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
									Your Biography
								</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
							<div class="form-group">
								<textarea rows="31" class="form-control" type="text" name="bio" value=""><?php echo $bio; ?></textarea>
							</div>
						</div>	
					</div>	
				</div>
		</div>
		<br>
		<div class="col-md-2">
		<br>
			<button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
		</div>
    </form>
  </br>
  <?php
}if (isset($_GET['id'])){
  if (isset($_POST['submit'])){
    if (is_numeric($_POST['id'])){
      $id = $_POST['id'];
      $bio = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['bio']);;
      $gender = htmlentities($_POST['gender'], ENT_QUOTES);
      $birthday = htmlentities($_POST['birthday'], ENT_QUOTES);
      $website = htmlentities($_POST['website'], ENT_QUOTES);
      $location = htmlentities($_POST['location'], ENT_QUOTES);
      $occupation = htmlentities($_POST['occupation'], ENT_QUOTES);
      $status = htmlentities($_POST['status'], ENT_QUOTES);
      $user_avt = htmlentities($_POST['user_avt'], ENT_QUOTES);
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
      {
        if ($stmt = $conn->prepare("UPDATE users SET bio = ?, gender = ?, birthday = ?, website = ?, location = ?, occupation = ?, status = ?, user_avt = ?, steam =?, facebook =?, twitter =?, youtube =?, instagram =?, twitch =?, skype =?, github =?, googleplus =?, pinterest = ?, tumblr = ?, year = ?, month = ?, day = ?, games = ? WHERE id= ?"))
        {
          $stmt->bind_param("sssssssssssssssssssssssi", $bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games, $id);
          $stmt->execute();
          $stmt->close();
        }else{
          echo "ERROR: could not prepare SQL statement.";
        }
        header("Location: /users/user.php?=$us");
      }
    }else{ echo "Error! (1)"; }
  }else{
    if (is_numeric($_GET['id']) && $_GET['id'] > 0){
      $id = $_GET['id'];
      if ($IDstmt = $conn->prepare("SELECT id FROM users WHERE username = ?")) {
        $IDstmt->bind_param("s", $_SESSION["username"]);
        $IDstmt->execute();
        $IDstmt->bind_result($visitingUserID);
        $IDstmt->fetch();
        $IDstmt->close();
        if ($visitingUserID == $id) {
          if($stmt = $conn->prepare("SELECT id, bio, gender, birthday, website, location, occupation, status, user_avt, steam, facebook, twitter, youtube, instagram, twitch, skype, github, googleplus, pinterest, tumblr, year, month, day, games FROM users WHERE id= ?")){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games);
            $stmt->fetch();
            renderForm($bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt, $steam, $facebook, $twitter, $youtube, $instagram, $twitch, $skype, $github, $googleplus, $pinterest, $tumblr, $year, $month, $day, $games, NULL, $id);
            $stmt->close();
          } else{
            echo "Error: could not prepare SQL statement";
          }
        } else {
          echo '<div style="text-align: center;" class="alert alert-danger" role="alert">You do not have permissions to edit this user, please return to the <a href="http://'.$parse['host'].'/users/">users</a> list.</div>';
        }
      }
    }else{
      header("Location: //users/user.php?=$us");
    }
  }
  ?>
  	</div>
</div>
</div>
<?php  
}else{
	?>
 <div class="container">
		 <div style="text-align: center;" class="alert alert-danger" role="alert">You do not have permissions to edit this user, please return to the <a href="/users/">users</a> list.</div>	
</div>

 <?php	
	 }
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 