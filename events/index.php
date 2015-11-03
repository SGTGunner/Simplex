<?php
$title = "Events";
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
echo '
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-offset-2 col-sm-8">
			<ul class="event-list">';
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
						<img alt="" src="'.$row['image'].'" />
						<div class="info">
							<h2 class="title">'.$row['event_title'].'</h2>
							<p class="description">'.$row['description'].'</p>
							<ul>
								<li style="width:100%;"><a href="event.php?='.$row['id'].'"><span class="fa fa-plus"></span> More</a></li>
							</ul>
						</div>
					</li>';
			}
		}
echo '</ul>
</div>
</div>
</div>';
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>