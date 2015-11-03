<?php
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$sec = substr($actual_link, (strpos($actual_link, '='))+1, strlen($actual_link));
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
$title = "Admin";
include ('header.php');
include ('navbar.php');
?>
<div class="container">
	<div class="col-md-6">
		<table class="table table-bordered table-list-search">
			<thead>
				<tr>
					<th><?php if($system == "arma"){ echo 'Unit';}else if($system == "minecraft"){echo 'Group';}?></th>
					<th>Name</th>
					<th>Rank</th>
					<th>Position</th>
				</tr>
			</thead>
				<tbody>
	<?php
	$sql = "SELECT * FROM users WHERE unit = '$sec'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '
					<tr>
						<td>'. $row['unit'] .'</td>
						<td><a href="/users/user.php?='.$row['username'].'">'. $row['username'] .'</a></td>
						<td>'. $row['rank'] .'</td>
						<td>'. $row['position'] .'</td>
					</tr>';
		$unitname = $row['unit'];
			}
		}
	?>
				</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">About <?php echo $unitname;?> </h3>
			</div>
				<div class="panel-body">
			<?php
				$sql = "SELECT * FROM roster WHERE unit = '$sec'";
					$result = mysqli_query($conn, $sql);
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo $row['about_internal']. '<hr/>
								<a class="btn btn-success" href="edit/roster_about.php?id=' . $row['id'] . '"><i class="fa fa-plus fa-fw"></i>Modify</a>';
							}
						}
					?>
				</div>
		</div>
	</div>
	<a href="./?admin=roster" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Return</a>
</div>
<?php
include ('footer.php');
?>