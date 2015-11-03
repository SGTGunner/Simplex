<?php
$title = "Users";
session_start(); 
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/navbar.php');
?>
<div class="container">
	<div class="col-md-2">
            <form action="#" method="get">
                <div class="input-group">
                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                    <input class="form-control" autocomplete="off" id="system-search" name="q" placeholder="Search for...?" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
		<br>
	</div>
    <div class="col-md-12">
					<?php
				        $per_page = 20;
				        if ($result = $conn->query("SELECT * FROM users")){
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
								echo '        
								<table class="table table-bordered table-list-search">
								<thead>
									<tr>
										<th>
										   Name
										</th>
										<th>
										   Rank
										</th>
										<th>';
										  if($system == "arma"){ echo 'Unit';}else if($system == "minecraft"){echo 'Group';}
										echo'</th>
										<th>
										   Position
										</th>
										<th>
										   Status
										</th>
									</tr>
								</thead>
								<tbody>';
								for ($i = $start; $i < $end; $i++){
									if ($i == $total_results){ break; }
									$result->data_seek($i);
									$row = $result->fetch_assoc();
							   echo'<tr>
									<td><a href="'.DIR.'/users/user.php?='. $row['username'] . '">'.  $row['username'] .'</a></td>
									<td>' . $row['rank'] . '</td>
									<td>' . $row['unit'] . '</td>
									<td>' . $row['position'] . '</td>
									<td>' . $row['status'] . '</td>
									</tr>';
						        }
								echo '
								</tbody>
								</table>
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
								echo'
									</ul>
							</nav>';
				        	}else{
								echo "No results to display!";
				        	} 
				        }else{
							echo "Error: " . $conn->error;
				        }
			?>
    </div>
</div>
<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/footer.php');
?>