<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Awards | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($award_name = '', $award_image_link ='', $award_about ='', $error = '', $id = ''){ ?>
				<?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";} ?>
	<div class="container">
		<div class="col-md-12">
				<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<?php if ($id != '') { 
						echo'<input type="hidden" name="id" value="'.$id.'" />';
						}
					?>
					<div class="col-md-6">
						<div class="form-group">
							<label>Award Name</label>
							<input class="form-control" type="text" name="award_name" value="<?php echo $award_name; ?>"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Award Image</label>
							<input class="form-control" type="text" name="award_image_link" value="<?php echo $award_image_link; ?>"/>
						</div>
					</div>
		</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>About Award</label>
								<textarea rows="30" class="form-control" type="text" name="award_about" value=""><?php echo $award_about; ?></textarea><br/>
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
				$award_name = htmlentities($_POST['award_name'], ENT_QUOTES);
				$award_image_link = htmlentities($_POST['award_image_link'], ENT_QUOTES);
				$award_about = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['award_about']);;
					if ($stmt = $conn->prepare("UPDATE awards SET award_name = ?, award_image_link = ?, award_about = ? WHERE id=?")){
						$stmt->bind_param("sssi", $award_name, $award_image_link, $award_about, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=awards");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, award_name, award_image_link, award_about FROM awards WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $award_name, $award_image_link, $award_about);
					$stmt->fetch();
					renderForm($award_name, $award_image_link, $award_about, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=awards");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$award_name = htmlentities($_POST['award_name'], ENT_QUOTES);
			$award_image_link = htmlentities($_POST['award_image_link'], ENT_QUOTES);
			$award_about = htmlentities($_POST['award_about'], ENT_QUOTES);
			if ($award_name == '' || $award_image_link == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($award_name, $award_image_link, $award_about, $award_about_internal, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT awards (award_name, award_image_link, award_about) VALUES (?, ?, ?)")){
					$stmt->bind_param("sss", $award_name, $award_image_link, $award_about);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=awards");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}