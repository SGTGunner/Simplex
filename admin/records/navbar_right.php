<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Navbar Right | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($title = '', $link ='', $error = '', $id = ''){
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
							<label>Title</label>
							<input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Link</label>
							<input class="form-control" type="text" name="link" value="<?php echo $link; ?>"/>
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
				$title = htmlentities($_POST['title'], ENT_QUOTES);
				$link = htmlentities($_POST['link'], ENT_QUOTES);
					if ($stmt = $conn->prepare("UPDATE navbar_right SET title = ?, link = ? WHERE id=?")){
						$stmt->bind_param("ssi", $title, $link, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=navbar");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, title, link FROM navbar_right WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $title, $link);
					$stmt->fetch();
					renderForm($title, $link, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=navbar");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$title = htmlentities($_POST['title'], ENT_QUOTES);
			$link = htmlentities($_POST['link'], ENT_QUOTES);
			if ($title == '' || $link == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($title, $link, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT navbar_right (title, link) VALUES (?, ?)")){
					$stmt->bind_param("ss", $title, $link);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=navbar");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}