<?php
require_once('files/authenticate.php');
?>

<nav>
	<a href = "index.php">Index</a>
	<?php
	if(isset($_SESSION['user_id'])){
	?>
		<a href = "gallery.php">Photo Gallery</a>
		<a href = "profile.php"><?php echo $user_name ?></a>
		<a href = "signout.php">Log-Out?</a>
	<?php
	}
	else{
	?>
		<a href = "login.php">Log-In</a>
		<a href = "register.php">Sign-Up</a>
	<?php
	}
	?>
</nav>