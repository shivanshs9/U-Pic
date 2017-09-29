<?php
ob_start();
require_once('startsession.php');
require_once('db.php');

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$query = "SELECT * FROM users WHERE sha_id = '$user_id'";
	$result = $mysqli->query($query);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result);
		$user_id = $row['sha_id'];
		$user_name = $row['name'];
		$user_email = $row['email'];
		$user_firstname = $row['firstname'];
		$user_lastname = $row['lastname'];
		$user_joindate = $row['joindate'];
		$user_password = $row['password'];
	}
}
?>