<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/var.php');
	if($user->is_logged_in()){
		if($isadmin == 'true'){
$title = "Admin | Roster | Edit";
include ('../header.php');
include ('../navbar.php');
	function renderForm($unit = '', $image ='', $about ='', $about_internal ='', $error = '', $id = ''){ ?>
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
							<label>Unit Name</label>
							<input class="form-control" type="text" name="unit" value="<?php echo $unit; ?>"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Image</label>
							<input class="form-control" type="text" name="image" value="<?php echo $image; ?>"/>
						</div>
					</div>
		</div>
		<div class="col-md-12">
					<div class="col-md-6">
						<div class="form-group">
							<label>About Unit (Front)</label>
								<textarea rows="30" class="form-control" type="text" name="about" value=""><?php echo $about; ?></textarea><br/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>About Unit (Internal)</label>
								<textarea rows="30" class="form-control" type="text" name="about_internal" value=""><?php echo $about_internal; ?></textarea><br/>
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
				$unit = htmlentities($_POST['unit'], ENT_QUOTES);
				$image = htmlentities($_POST['image'], ENT_QUOTES);
				$about = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['about']);;
				$about_internal = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_POST['about_internal']);;
					if ($stmt = $conn->prepare("UPDATE roster SET unit = ?, image = ?, about = ?, about_internal = ? WHERE id=?")){
						$stmt->bind_param("ssssi", $unit, $image, $about, $about_internal, $id);
						$stmt->execute();
						$stmt->close();
					}else{
						echo "ERROR: 1 could not prepare SQL statement.";
					}header("Location: ../?admin=roster");
			}else{
				echo "1) Error!";
			}
		}else{
			if (is_numeric($_GET['id']) && $_GET['id'] > 0){
				$id = $_GET['id'];
				if($stmt = $conn->prepare("SELECT id, unit, image, about, about_internal FROM roster WHERE id = ?")){
					$stmt->bind_param("i", $id);
					$stmt->execute();
					$stmt->bind_result($id, $unit, $image, $about, $about_internal);
					$stmt->fetch();
					renderForm($unit, $image, $about, $about_internal, NULL, $id);
					$stmt->close();
				}else{
					echo "Error: 2 could not prepare SQL statement";
				}
			}else{
				header("Location: ../?admin=roster");
			}
		}//add new
	}else{
		if (isset($_POST['submit'])){
			$unit = htmlentities($_POST['unit'], ENT_QUOTES);
			$image = htmlentities($_POST['image'], ENT_QUOTES);
			$about = htmlentities($_POST['about'], ENT_QUOTES);
			$about_internal = htmlentities($_POST['about_internal'], ENT_QUOTES);
			if ($unit == '' || $image == ''){
				$error = 'ERROR: Please fill in all required fields!';
				renderForm($unit, $image, $about, $about_internal, $error, $id);
			}else{
				if ($stmt = $conn->prepare("INSERT roster (unit, image, about, about_internal) VALUES (?, ?, ?, ?)")){
					$stmt->bind_param("ssss", $unit, $image, $about, $about_internal);
					$stmt->execute();
					$stmt->close();
				}else{
					echo "ERROR: Could not prepare SQL statement.";
				}header("Location: ../?admin=roster");
			}
		}else{
			renderForm();
		}
	}
include ('../footer.php');
		}
	}