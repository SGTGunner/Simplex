<?php
$title = "Home";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
?>
<div class="container">
	<div class="col-md-12">
		<div class="col-md-4">
<?php
if ($system == "minecraft") {
echo'
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Server Info&nbsp;<span class="label label-success">'. $serverip .'</span></h3>
				</div>
				<div class="panel-body">';
					// Edit this ->
					define('MQ_SERVER_ADDR', $serverip);
					define('MQ_SERVER_PORT', $port);
					define('MQ_TIMEOUT', 1 );
					require 'assets/classes/MinecraftQuery.class.php';
					$Query = new MinecraftQuery();
					try {
						$Query->Connect(MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT);
					}
					catch(MinecraftQueryException $e){
						$Error = $e->getMessage();
						echo($Error);
					}
					if(($Players = $Query->GetPlayers()) !== false) {
						foreach($Players as $Player) {
								$img = htmlspecialchars($Player);
								echo "<a href='/users/user.php?=$img' data-toggle='tooltip' data-placement='top' title='$img'><img src='http://cravatar.eu/avatar/$img/32.png'/'></a>&nbsp;";
						}
					} else {
						echo "";
					}echo'
					<br />';
					if(($Info = $Query->GetInfo())!== false){
						$playersOnline = $Info['Players'];
						$maxPlayers = $Info['MaxPlayers'];
					echo '
					<div class="progress" style="margin-top:10px">
						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'. $playersOnline .'" aria-valuemin="0" aria-valuemax="100" style="width:'. $playersOnline .'%;"><font color="black">
							'. $playersOnline .'/'. $maxPlayers .'
						</font></div>
					</div>';
					}else{
						echo 'Server is offline';
					}
				echo'
					
					';

				?>
				</div>
			</div>
<?php	
}else if ($system == "arma") {
require 'assets/SourceQuery/SourceQuery.class.php';
	// Edit this ->
	define( 'SQ_SERVER_ADDR', $serverip);
	define( 'SQ_SERVER_PORT', $port+1 );
	define( 'SQ_TIMEOUT',     3 );
	define( 'SQ_ENGINE',      SourceQuery :: SOURCE );
	// Edit this <-
	$Timer = MicroTime( true );
	$Query = new SourceQuery( );
	$Info    = Array( );
	$Rules   = Array( );
	$Players = Array( );
	try{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );		
		$Info    = $Query->GetInfo( );
		$Players = $Query->GetPlayers( );
		$Rules   = $Query->GetRules( );
	}catch(Exception $e){
		$Exception = $e;
	}$Query->Disconnect( );
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Arma 3 Server Viewer <span class="label label-<?php echo $Timer > 1.0 ? 'danger' : 'success'; ?>"><?php echo $Timer; ?>s</span></h3>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Player</th>
							<th>Kills</th>
							<th>Time</th>
						</tr>
					</thead>
					<tbody>
						<?php if( Is_Array( $Players ) ): ?>
						<?php foreach( $Players as $Player ): ?>
						<tr>
							<td><?php echo '<a href="/users/user.php?='. htmlspecialchars( $Player[ 'Name' ]) .'">'.$Player[ 'Name' ].'</a>'; ?></td>
							<td><?php echo $Player[ 'Frags' ]; ?></td>
							<td><?php echo $Player[ 'TimeF' ]; ?></td>
						</tr>
							<?php endforeach; ?>
							<?php else: ?>
						<tr>
							<td colspan="3">No players received</td>
						</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

<?php
}if($events == "true"){
?>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Up Coming Events</h3>
				</div>
				<div class="panel-body">
			<ul class="event-list">
<?php
$a = array(
 '01'=>'Jan',
 '02'=>'Feb',
 '03'=>'Mar',
 '04'=>'Apr',
 '05'=>'May',
 '06'=>'Jun',
 '07'=>'Jul',
 '08'=>'Aug',
 '09'=>'Sep',
 '10'=>'Oct',
 '11'=>'Nov',
 '12'=>'Dec',
);
$sql = "SELECT * FROM events";
	$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				 $m = $row['month'];
				echo '
					<li>
						<time datetime="'.$row['year'] .'-'. $row['month'] .'-'. $row['date'] .' '. $row['time'] .'">
							<span class="day">'.$row['date'].'</span>
							<span class="month">'.$a[$m] .'</span>
							<span class="year">'.$row['year'].'</span>
							<span class="time">'.$row['time'].'</span>
						</time>
						<div class="info">
							<h2 class="title">'.$row['event_title'].'</h2>
							<p class="desc">'.$row['desc'].'</p>
							<ul>
								<li style="width:100%;"><a href="events/event.php?='.$row['id'].'"><span class="fa fa-plus"></span> More</a></li>
							</ul>
						</div>
					</li>';
			}
		}
echo '</ul>';
				?>
				</div>
			</div>
<?php
}if($donate == "true"){
 ?>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Donate</h3>
				</div>
				<div class="panel-body">
					<script type="text/javascript" charset="utf-8" src="/assets/includes/donation_widget.php?mode=top"></script>
					<a href="/donate/" class="btn btn-primary btn-block">More</a>
				</div>
			</div>
<?php
 }if($teamspeak == "true"){
?>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">Teamspeak 3 Server</h3>
				</div>
				<div class="panel-body">
					<span id="teamspeak_viewer" ></span> <script type="text/javascript" > (function() { document.getElementById("teamspeak_viewer").innerHTML = '<object type="text/html" data="http://billing.snowstormservers.com//modules/servers/teamspeak3/viewer.php?sid=928" ></object>'; })(); </script>
				</div>
			</div>	
<?php		
 }
 ?>
 </div>
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Announcements</h3>
				</div>
				<div class="panel-body">
					<?php
				        $per_page = 3;
				        if ($result = $conn->query("SELECT * FROM news ORDER BY id DESC")){
				        	if ($result->num_rows != 0){
				        		$total_results = $result->num_rows;
					        	$total_pages = ceil($total_results / $per_page);
						        if (isset($_GET['page']) && is_numeric($_GET['page'])){
						                $show_page = $_GET['page'];
						                if ($show_page > 0 && $show_page <= $total_pages){
						                        $start = ($show_page -1) * $per_page;
						                        $end = $start + $per_page; 
						                }else{
											$start = 0;
											$end = $per_page; 
						                }               
						        }else{
									$start = 0;
									$end = $per_page; 
						        }
						        echo "</p>";
						        for ($i = $start; $i < $end; $i++){
									if ($i == $total_results) { break; }
									$result->data_seek($i);
   	 								$row = $result->fetch_assoc();
										echo '
										<h3 class="text-center">'. $row['title'] . '</h3>
										<p>'.htmlspecialchars_decode(stripslashes($row['body'])).'</p>
										<br>
										<a class="label label-success" href="/users/user.php?=' . $row['puser'] .'">' . $row['puser'] .'</a>
										<hr>';
						        }
								echo '
								<nav>
									<ul class="pagination">';
						        for ($i = 1; $i <= $total_pages; $i++){
						        	if (isset($_GET['page']) && $_GET['page'] == $i){
										echo '<li class="active"><a href="?page='.$i.'">'.$i.'</a></li>';
						        	}else{
										echo '
											<li><a href="?page='.$i.'">'.$i.'</a></li>';
						        	}
						        }
								echo '
								</ul>
									</nav>';
				        	}
				        }else{
							echo "Error: " . $conn->error;
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
