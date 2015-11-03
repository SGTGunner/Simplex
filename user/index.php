<?php
session_start;
$title = "User | Editor";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
$us = $_SESSION['username'];

?>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#format" ).change(function() {
      $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
    });
  });
  </script>
  <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
		      font_formats: "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;Lucida Console=Monaco,monospace;Comic Sans MS=cursive,sans-serif;Trebuchet MS=Helvetica, sans-serif;Verdana=Geneva, sans-serif; Lato= helvetica, sans-serif",
			  fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
              plugins: [
                  "advlist wordcount autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | sizeselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image" 
          });
  </script>

<?php
if ($id = '') {
?>
<div class="container">
<div style="text-align: center;" class="alert alert-danger" role="alert">Please return to the <a href="/users/">users</a> list. There is nothing to see here.</div>
</div>
<?php
}
?>
<div class="container">
	<div class="row">
<?php
function renderForm ($bio = '', $gender ='', $birthday ='', $website ='', $location ='', $occupation ='', $status ='', $user_avt ='', $error = '', $id = ''){
  if ($error != '') {
    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
  } echo'
  <form action="'.$_SERVER['PHP_SELF'].'?id="'.$id.'" method="post">';
if ($id != '') { ?>
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<?php } ?>
	<div class="col-md-4">
			<div class="form-group">
				<label>Gender</label>
					<select class="form-control" name="gender">
						<option value=" <?php if(!empty($gender)){ echo $gender; }else{ echo''; } ?> "><?php if(!empty($gender)){ echo $gender; }else{ echo'Select a gender'; } ?> </option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Unspecified">Unspecified</option>
					</select>  
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Birthday</label>
					<input class="form-control" id="datepicker" type="text" name="birthday" value="<?php echo $birthday; ?>"/>
				</div>	
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Select Format</label>
						<select class="form-control" id="format">
							<option value="mm/dd/yy">Default - mm/dd/yy</option>
							<option value="d M, y">Short - d M, y</option>
							<option value="d MM, y">Medium - d MM, y</option>
							<option value="DD, d MM, yy">Full - DD, d MM, yy</option>
						  </select>
				</div>
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
	</div>
	<div class="col-md-8">
			<div class="form-group">
				<label>Bio</label>
				<textarea rows="30" class="form-control" type="text" name="bio" value=""><?php echo $bio; ?></textarea><br/>
			</div>
	</div>	
      <button type="submit" value="submit" name="submit" class="btn btn-success">Submit</button>
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
      {
        if ($stmt = $conn->prepare("UPDATE users SET bio = ?, gender = ?, birthday = ?, website = ?, location = ?, occupation = ?, status = ?, user_avt = ? WHERE id= ?"))
        {
          $stmt->bind_param("ssssssssi", $bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt, $id);
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
          if($stmt = $conn->prepare("SELECT id, bio, gender, birthday, website, location, occupation, status, user_avt FROM users WHERE id= ?")){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id, $bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt);
            $stmt->fetch();
            renderForm($bio, $gender, $birthday, $website, $location, $occupation, $status, $user_avt, NULL, $id);
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