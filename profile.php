<?php
require_once('files/authenticate.php');
$title = $user_name;
$head = "Welcome to your Profile, " . $user_firstname . " " . $user_lastname . "!";
require_once('files/header.php');

if(isset($_POST['personal'])){
	$firstname = $mysqli->real_escape_string(trim($_POST['firstname']));
	$lastname = $mysqli->real_escape_string(trim($_POST['lastname']));
	$current_pass = $mysqli->real_escape_string(trim($_POST['current_pass']));
	
	if(!empty($firstname) && !empty($lastname)){
		if(!empty($current_pass)){

			$query = "SELECT * FROM users WHERE password = SHA('$current_pass') AND sha_id = '$user_id'";
			$data = $mysqli->query($query)
				or die("<p class = 'error'>Error Querying</p>");
	        if(mysqli_num_rows($data) == 1) {
				$query1 = "UPDATE users SET " . (!empty($firstname) ? "firstname = '$firstname'" : "") .
						(!empty($firstname) && !empty($lastname) ? ", " : "") .
						(!empty($lastname) ? "lastname = '$lastname'" : "") . "WHERE sha_id = '$user_id'";
				$result = $mysqli->query($query1)
					or die("<p class = 'error'>Error Updating...</p>");
				$mysqli->close();
				header('Refresh: 0; url = profile.php');
			}
			else{
				echo "<p class = 'error'>Entered Password doesn't match the Current Password...!</p>";
			}
		}
		else{
			echo "<p class = 'error'>You need to type your current Password to confirm your settings!</p>";
		}
	}
}
if(isset($_POST['security'])){
	$change_pass = false;
	$email = $mysqli->real_escape_string(trim($_POST['email']));
	$pass1 = $mysqli->real_escape_string(trim($_POST['pass1']));
	$pass2 = $mysqli->real_escape_string(trim($_POST['pass2']));
	$current_pass = $mysqli->real_escape_string(trim($_POST['current_pass']));

	if(!empty($current_pass)){
		if (!empty($pass1) && !empty($pass1))
		{
			if ($pass1 == $pass2){
				$change_pass = true;
			}else{
				echo "<p class = 'error'>Passwords doesn't match up!</p>";
			}
		}
		$query = "SELECT * FROM users WHERE password = SHA('$current_pass') AND sha_id = '$user_id'";
		$data = $mysqli->query($query)
			or die("<p class = 'error'>Error Querying</p>");
        if(mysqli_num_rows($data) == 1) {
			$query = "UPDATE users SET " . (!empty($email) ? "email = '$email'" : "") . (!empty($email) && $change_pass ? ", " : "") .
			($change_pass == true ? "password = SHA('$pass1')" : "") . " WHERE sha_id = '$user_id'";
			$result = $mysqli->query($query)
				or die("<p class = 'error'>Error Querying</p>");
			$mysqli->close();
			header('Refresh: 0; url = profile.php');
		}
		else
		{
			echo "<p class = 'error'>Entered Password doesn't match the Current Password...!</p>";
		}
	}
	else{
		echo "<p class = 'error'>You need to type your current Password to confirm your settings!</p>";
	}
}
?>
Here, you can edit your Profile in an easy-to-use way.
<p />
<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<details close>
	<summary>Personal Information</summary>
	<div class = "personal">
		<b>Your Current Username: </b>
		<?php echo $user_name; ?>
		<p />
		<b>Your Current Name: </b>
		<?php echo $user_firstname . " " . $user_lastname; ?><br />
		<input type = "text" name = "firstname" id = "firstname" placeholder = "Enter your new first name."/>
		<input type = "text" name = "lastname" id = "lastname" placeholder = "Enter your new last name."/>
		<p />
		<input type = "password" name = "current_pass" id = "current_pass" placeholder = "Enter your current password to confirm." required />
		<input type = "submit" name = "personal" value = "Change that!" align = "center" />
		<input type="reset" value="Clear all!"align = "center" />
	</div>
</details>
</form>
<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<details close style = "margin-top:1%;">
	<summary>Security</summary>
	<div class = "personal">
		<b>Your Current E-Mail Address: </b>
		<?php echo $user_email; ?><br />
		<input type = "email" name = "email" id = "email" placeholder = "Enter your new E-mail address."/>
		<p />
		<b>Change your Password: </b><br />
		<input type = "password" name = "pass1" id = "pass1" placeholder = "Enter your new password."/>
		<input type = "password" name = "pass2" id = "pass2" placeholder = "Re-enter your new password."/>
		<p />
		<input type = "password" name = "current_pass" id = "current_pass" placeholder = "Enter your current password to confirm." required />
		<input type = "submit" name = "security" value = "Change that!" align = "center" />
		<input type="reset" value="Clear all!"align = "center" />
	</div>
</details>
</form>