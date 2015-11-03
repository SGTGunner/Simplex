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
	$sql = "SELECT * FROM users WHERE username = '$us'";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$g = $row['gender'];
				$timeconvert = $row['year'].$row['month'].$row['day'];
				$year = $row['year'];
				$timeresult = date(" l, d, F, Y", strtotime($timeconvert));
				$w = $row['website'];
				$l = $row['location'];
				$o = $row['occupation'];
				$bEnable = $row['birthday'];
				$avt = $row['user_avt'];
				$usrname = $row['username'];
				$ranks = $row['rank'];
				$positions = $row['position'];
				$statuss = $row['status'];
				$units = $row['unit'];
				$games = $row['games'];
				$bio = $row ['bio'];
				$steamdb = $row ['steam'];
				$facebookdb = $row ['facebook'];
				$twitterdb = $row ['twitter'];
				$youtubedb = $row ['youtube'];
				$instagramdb = $row ['instagram'];
				$twitchdb = $row ['twitch'];
				$skypedb = $row ['skype'];
				$githubdb = $row ['github'];
				$googleplusdb = $row ['googleplus'];
				$pinterestdb = $row ['pinterest'];
				$tumblrdb = $row ['tumblr'];
				$steam = "https://steamcommunity.com/id/$steamdb";
				$facebook = "https://www.facebook.com/$facebookdb";
				$twitter = "https://twitter.com/$twitterdb";
				$youtube = "https://www.youtube.com/user/$youtubedb";
				$instagram = "https://instagram.com/$instagramdb";
				$twitch = "http://www.twitch.tv/$twitchdb/";
				$skype = "skype://$skypedb";
				$github = "https://github.com/$githubdb";
				$googleplus = "https://plus.google.com/+$googleplusdb";
				$pinterest = "https://www.pinterest.com/$pinterestdb";
				$tumblr = "http://$tumblrdb.tumblr.com/";
				if(empty($avt)){
					$default = "https://placehold.it/400x400";
				}else if($avt == "gavatar"){
					$email = $row['email'];
					$default = "http://blufor.rexsdev.com/assets/img/blufor-icon.png";
					$size = 400;
					$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
				}
			}
		}
 echo'
 </br>
 </br>
 </br>
 </div>
<div class="container">
	<div class="col-md-12">
	<div class="col-md-4">';
	if(empty($games)) {
		$game = "I don't play any games.";
	} else{
		$game = $games;
	} if(empty($units)) {
		$unit =  "I'm not apart of any units!";
	} else {
		$unit = $units;
	} if(empty($positions)) {
		$position =  "My Position is not your business.";
	}else {
		$position = $positions;
	} if(empty($statuss)) {
		$status =  "My status is empty because I'm empty!";
	} else {
		$status = $statuss;
	} if(empty($ranks)) {
		$rank =  'My rank is "Rankless" as I am alone.';
	} else {
		$rank = $ranks;
	} if($bEnable == "true") {
		$b = $timeresult;
		$a = date("Y") - $year;
	} else{
		$b = "Hidden";
		$a = "Hidden";
	}
	$social = $steamdb.$facebookdb.$twitterdb.$youtubedb.$instagramdb.$twitchdb.$skypedb.$githubdb.$googleplusdb.$pinterestdb.$tumblrdb;
		if(empty($social)) {
			$socialfull = "I'm anti-social, leave me alone!";
			$socials = "Anti-Social";
		} else {
			$socials = "Social";
		}
echo"<h2 class='text-center username'>".$usrname."'s Profile</h2>";
echo'
<img class="img-responsive img-square img-thumbnail" src="'; if(empty($avt)){echo $default; }else if($avt == "gavatar"){echo $grav_url;}else if(!empty($avt)){echo $avt;} echo'" alt="User Image">';
echo'
<div class="responsive-table">
	<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th colspan="2">USER INFORMATION</th>
				</tr>
			</thead>
		<tbody>
			<tr>
				<td>Rank</td>
				<td>'.$rank.'</td>
			</tr>
			<tr>
				<td>Position</td>
				<td> '.$position.'</td>
			</tr>
			<tr>
				<td>Status</td>
				<td> '.$status.'</td>
			</tr>
			<tr>
				<td>Unit</td>
				<td>'.$unit.'</td>
			</tr>
			<tr>
				<td>Games</td>
				<td>'.$game.'</td>
			</tr>
			<tr>
				<td>'.$socials.'</td>
				<td>';
					if(!empty($social)){
					echo'<div class="text-center">';
						if(!empty($steamdb)) { echo '<a href="'.$steam.'" class="hover hover-steam"><i class="fa fa-steam-square fa-1x"></i></a>'; }
						if(!empty($facebookdb)) { echo '<a href="'.$facebook.'" class="hover hover-facebook"><i class="fa fa-facebook-official fa-1x fa-fw"></i></a>'; }
						if(!empty($twitterdb)) { echo '<a href="'.$twitter.'" class="hover hover-twitter"><i class="fa fa-twitter-square fa-1x fa-fw"></i></a>'; }
						if(!empty($youtubedb)) { echo '<a href="'.$youtube.'" class="hover hover-youtube"><i class="fa fa-youtube-square fa-1x fa-fw"></i></a>'; }
						if(!empty($instagramdb)) { echo '<a href="'.$instagram.'" class="hover hover-instagram"><i class="fa fa-instagram fa-1x fa-fw"></i></a>'; }
						if(!empty($twitchdb)) { echo '<a href="'.$twitch.'" class="hover hover-twitch"><i class="fa fa-twitch fa-1x fa-fw"></i></a>'; }
						if(!empty($skypedb)) { echo '<a href="'.$skype.'" class="hover hover-skype"><i class="fa fa-skype fa-1x fa-fw"></i></a>'; }
						if(!empty($githubdb)) { echo '<a href="'.$github.'" class="hover hover-github"><i class="fa fa-github-square fa-1x fa-fw"></i></a>'; }
						if(!empty($googleplusdb)) { echo '<a href="'.$googleplus.'" class="hover hover-google-plus"><i class="fa fa-google-plus-square fa-1x fa-fw"></i></a>'; }
						if(!empty($pinterestdb)) { echo '<a href="'.$pinterest.'" class="hover hover-pinterest"><i class="fa fa-pinterest-square fa-1x fa-fw"></i></a>'; }
						if(!empty($tumblrdb)) { echo '<a href="'.$tumblr.'" class="hover hover-tumblr"><i class="fa fa-tumblr-square fa-1x fa-fw"></i></a>'; }
						echo '</div>';
					}else{
						echo $socialfull;
					}
					echo '
					</td>
				</tr>
		</tbody>	
	</table>';
?>
			</div>
	</div>
	<div class="col-md-8">
<?
echo'
<div class="responsive-table">
	<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th colspan="2">COMMUNITY INFORMATION</th>
				</tr>
			</thead>
		<tbody>
			<tr>
				<td><i class="fa fa-calendar"></i> Birtday</td>
				<td> '.$b.'</td>
			</tr>
			<tr>
				<td><i class="fa fa-birthday-cake"></i> Age</td>
				<td>'.$a.'</td>
			</tr>
			<tr>
				<td><i class="fa fa-venus-mars"></i> Gender</td>
				<td> '.$g.'</td>
			</tr>
			<tr>
				<td><i class="fa fa-compass"></i> Location</td>
				<td> '.$l.'</td>
			</tr>
			<tr>
				<td><i class="fa fa-user"></i> Job</td>
				<td>'.$o.'</td>
			</tr>
			<tr>
				<td><i class="fa fa-external-link"></i> Website</td>
				<td><a href="'.$w.'" target="_blank">'.$w.'</a></td>
			</tr>
		</tbody>	
	</table>
	</div>';
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">About Me</h3>
			</div>
			<div class="panel-body">
				<p><?php echo $bio;?></p>
			</div>
		</div>
	</div>
</div>
<?
	}else{
		echo '<br><br><br>';
echo '<div class="container">
		<div style="text-align: center;" class="alert alert-danger" role="alert">This user does not exist, please return back to the <a href="/users/">users</a> list.</div>	
	</div>';
	}
?>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>