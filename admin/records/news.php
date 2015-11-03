<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Announcements | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($title = '', $date ='', $puser ='', $body ='', $error = '', $id = ''){
		global $s_user; ?>
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
							<label>Post Title</label>
							<input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Date Posted</label>
							<input class="form-control" type="text" name="date" value="<?php echo $date; ?>"/>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Posted puser</label>
							<input class="form-control" type="text" name="puser" value="<?php echo $s_user; ?>" readonly/>
						</div>
					</div>
		</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Post Text</label>
								<textarea rows="30" class="form-control" type="text" name="body" value=""><?php echo $body; ?></textarea><br/>
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
				$title = htmlentities($_POST['title'], ENT_QUOTES);
				$date = htmlentities($_POST['date'], ENT_QUOTES);
				$puser = htmlentities($_POST['puser'], ENT_QUOTES);
				$body = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['body']);
					if ($stmt = $conn->prepare("UPDATE news SET title = ?, date = ?, puser = ?, body = ? WHERE id=?")){
						$stmt->bind_param("ssssi", $title, $date, $puser, $body, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=news");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, title, date, puser, body FROM news WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $title, $date, $puser, $body);
					$stmt->fetch();
					renderForm($title, $date, $puser, $body, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=news");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$title = htmlentities($_POST['title'], ENT_QUOTES);
			$date = htmlentities($_POST['date'], ENT_QUOTES);
			$puser = htmlentities($_POST['puser'], ENT_QUOTES);
			$body = htmlentities($_POST['body'], ENT_QUOTES);
			if ($title == '' || $date == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($title, $date, $puser, $body, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT news (title, date, puser, body) VALUES (?, ?, ?, ?)")){
					$stmt->bind_param("ssss", $title, $date, $puser, $body);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=news");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}