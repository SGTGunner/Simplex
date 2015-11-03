<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$username = "Admin | User Awards | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($username = '', $award_link ='', $error = '', $id = ''){
		global $s_user; ?>
				<?php if ($error != '') { echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";} ?>
	<div class="container">
		<div class="col-md-12">
				<form action="" method="post">
					<?php if ($id != '') {
						echo'<input type="hidden" name="id" value="'.$id.'" />';
						}
					?>
					<div class="col-md-6">
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" type="text" name="username" value="<?php echo $username; ?>"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Image Link</label>
							<input class="form-control" type="text" name="award_link" value="<?php echo $award_link; ?>"/>
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
				$username = htmlentities($_POST['username'], ENT_QUOTES);
				$award_link = htmlentities($_POST['award_link'], ENT_QUOTES);
					if ($stmt = $conn->prepare("UPDATE user_awards SET username = ?, award_link = ? WHERE id=?")){
						$stmt->bind_param("ssi", $username, $award_link, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=uawards");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT * FROM user_awards WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $username, $award_link);
					$stmt->fetch();
					renderForm($username, $award_link, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=uawards");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$username = htmlentities($_POST['username'], ENT_QUOTES);
			$award_link = htmlentities($_POST['award_link'], ENT_QUOTES);
			if ($username == '' || $award_link == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($username, $award_link, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT user_awards (username, award_link) VALUES (?, ?)")){
					$stmt->bind_param("ss", $username, $award_link);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=uawards");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}