<div>
	<ul class="navbar">
		<li class="nav-element"><a href="index.php"><img src="img/lucidity_hd.png" height="50px"></a></li>
		<?php if(isset($_SESSION['current_user']) && !empty($_SESSION['current_user'])) : ?>
			<li class="nav-element" style="float:right;"><a href="logout.php">Logout</a></li>
			<li class="nav-element" style="float:right;"><a href="dashboard.php">Dashboard</a></li>
		<?php else : ?>
			<li class="nav-element" style="float:right;"><a href="event.php">Request Song</a></li>
			<li class="nav-element" style="float:right;"><a href="login.php">Host Login</a></li>
		<?php endif; ?>
	</ul>
</div>

<div class="clear"></div>