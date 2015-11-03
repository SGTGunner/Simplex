<?php
session_start;
$title = "User | Editor";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
?>
<div class="container">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Awards</h3>
			</div>
				<div class="panel-body">
					<div class="row">
				<?php
				$sql = "SELECT * FROM awards";
					$result = mysqli_query($conn, $sql);
						if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
							echo '
							<div class="col-sm-12 col-md-6">
								<div class="thumbnail">
									<img src="'.$row['award_image_link'].'" alt="An Award">
										<div class="caption">
											<h3>'.$row['award_name'].'</h3>
												<p>'.$row['award_about'].'</p>
										</div>
								</div>
							</div>';
						}
					}
				?>
					</div>
				</div>
		</div>
	</div>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>