<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		<a class="navbar-brand" href="/"><?php $sql = "SELECT * FROM settings"; $result = mysqli_query($conn, $sql); if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {  echo $row['brand']; }}?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="/admin/"><i class="fa fa-home fa-fw"></i>&nbsp;Home</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Services <i class="fa fa-caret-down"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/admin/?admin=news">Annoucements</a></li>
						<li><a href="/admin/?admin=users">Users</a></li>
						<li><a href="/admin/?admin=navbar">Navbar</a></li>
					</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Modules <i class="fa fa-caret-down"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="/admin/?admin=roster">Roster</a></li>
						<li><a href="/admin/?admin=awards">Awards</a></li>
						<li><a href="/admin/?admin=uawards">User Awards</a></li>
						<li><a href="/admin/?admin=events">Events</a></li>
					</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="settings.php/?id=1"><i class="fa fa-cogs fa-fw"></i>&nbsp;Settings</a></li>
			<li><p class="navbar-btn"><a class="btn btn-danger" href="logout.php"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a></p></li>
        </ul>
    </div>
  </div>
</nav>
<br><br><br>