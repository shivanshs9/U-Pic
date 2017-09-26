<?php
require_once('appvars.php');
require_once('startsession.php');

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
		or die("<p class = 'error'>Couldn't Connect to the MYSQLi Server/Database...</p>");
	$query = "SELECT * FROM users WHERE sha_id = '$user_id'";
	$result = mysqli_query($dbc, $query);

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