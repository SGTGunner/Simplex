<?php
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$sec = substr($actual_link, (strpos($actual_link, '='))+1, strlen($actual_link));
session_start(); 
$title = "Roster";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
$unit = "";
$sql = "SELECT unit FROM users";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$unit = $row['unit'];
		}
	}
if(empty($_GET['unit'])){
	?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
<?php
$sql = "SELECT * FROM roster";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
?>
<div class="col-sm-3 col-md-3">
<div class="thumbnail">
<a href="?unit=<?php echo $row['unit'];?>"><img class="img-responsive" src="<?if (empty($row['image'])){ echo 'http://placehold.it/400x400'; } else { echo $row['image']; }?>" alt="Unit Image"> </img></a>
<div class="caption">
<h4><a href="?unit=<?php echo $row['unit'];?>"><?php echo $row['unit'];?></a></h4>
<p><?php echo $row['about'];?></p>
</div>
</div>
</div>
<?php
		}
	}
?>
		</div>
	</div>
</div>
<?php
}else if($_GET['unit'] .= $unit){
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
	?>
					<tr>
						<td><?php echo $row['unit']; ?></td>
						<td><a href="/users/user.php?=<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a></td>
						<td><?php echo $row['rank']; ?></td>
						<td><?php echo $row['position']; ?></td>
						<?php $unitname = $row['unit']; ?>
					</tr>
	<?php
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
								echo $row['about_internal'];
							}
						}
					?>
				</div>
		</div>
	</div>
	<a href="/roster" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Return</a>
</div>
<?php
}
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>

