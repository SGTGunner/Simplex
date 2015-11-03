<?php
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$us = substr($actual_link, (strpos($actual_link, '='))+1, strlen($actual_link));
$title = "Users | $us";
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
$sql = "SELECT * FROM users WHERE username = '$us'";
	$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) != 0) {

echo'
<div class="container">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="thumbnail">';
                    $sql = "SELECT * FROM users WHERE username = '$us'";
                        $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
     echo' <img width="" class="img-responsive" src="' . $row['user_avt'] . '" alt="User Image">
      <div class="caption">
		<h3><a href="/users/user.php?='. $row['username'] . '">' . $row['username'] . '</a></h3>
			<p>
				<ul style="list-style-type: none;">
					<li><b>Rank</b> ' . $row['rank'] . '</li>';
						if($system == "arma"){
							echo '<li><b>Unit </b>';
							}else if($system == "minecraft"){
								echo'<li><b>Group </b> ';
								}echo'<a href="/roster/?unit=' . $row['unit'] . '">' . $row['unit'] . '</a></li>
					<li><b>Status</b> ' . $row['status'] . '</li>
					<li><b>Position</b> ' . $row['position'] . '</li>
				</ul>
			</p>
		</div>
    </div>';
			}
		}
	echo'</div>
			</div>';
$sql = "SELECT * FROM users WHERE username = '$us'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
echo'
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Awards Received</h3>
		</div>
			<div class="panel-body">
				<div class="row">';
$sql = "SELECT * FROM user_awards WHERE username = '$us'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				echo '
				<div class="col-xs-4">
							<a href="/awards/" class="thumbnail">
								<img src="'.$row['award_link'].'" alt="An Award">	
							</a>
				</div>';
				
		}
	}
echo'
					</div>
			</div>
	</div>';
			}
	}
	echo '</div><div class="col-md-8">';
                        $sql = "SELECT * FROM users WHERE username = '$us'";
                            $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                                echo' 
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">About ' . $row['username'] . '</h3>
            </div>
                <div class="panel-body">
                    ' . $row['bio'] . '
                    <hr>
                    <ul style="list-style-type: none;">
                        <li><b>Gender: </b>' . $row['gender'] . '</li>
                        <li><b>Birthday: </b>' . $row['birthday'] . '</li>
                        <li><b>Website: </b><a href="http://' . $row['website'].'">' . $row['website'] .'</a></li>
                        <li><b>Location: </b>' . $row['location'] . '</li>
                        <li><b>Occupation: </b>' . $row['occupation'] . '</li>
                    </ul>
				</div>
			</div>';
                                    }
                                }
            ?>
        </div>
</div>
<?php
		}else{
  echo '<div class="container">
			<div style="text-align: center;" class="alert alert-danger" role="alert">This user does not exist, please return back to the <a href="/users/">users</a> list.</div>	
		</div>';
		}
		
?>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>