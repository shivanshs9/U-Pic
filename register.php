<?php
$title = "Sign Up";
$head = "Join here!";
require_once('files/header.php');

if (isset($_POST['register'])) {
	// Grab the profile data from the POST
	$username = $mysqli->real_escape_string(trim($_POST['name']));
	$password1 = $mysqli->real_escape_string(trim($_POST['pass']));
	$password2 = $mysqli->real_escape_string(trim($_POST['pass2']));
	$email = $mysqli->real_escape_string(trim($_POST['email']));
	$firstname = $mysqli->real_escape_string(trim($_POST['first_name']));
	$lastname = $mysqli->real_escape_string(trim($_POST['last_name']));

	if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($email)) {
	  // Make sure someone isn't already registered using this username
	  $query = "SELECT * FROM users WHERE name = '$username'";
	  $data = $mysqli->query($query);
	  if (mysqli_num_rows($data) == 0) {
	    // The username is unique, so insert the data into the database
	    $query = "SELECT id FROM users WHERE id = (SELECT MAX(id) FROM users)";
	    $res = $mysqli->query($query);
	    if ($res == false)
	    {
	    	$id = 1;
	    }
	    else
	    {
	    	$id = mysqli_fetch_array($res)['id'] + 1;
	    }
	    $query = "INSERT INTO users (sha_id, name, password, email, joindate, firstname, lastname) " .
	             "VALUES (SHA('$id'), '$username', SHA('$password1'), '$email', NOW(), '$firstname', '$lastname')";
	    $mysqli->query($query)
	    	or die("<p class = 'error'>Error Quering!!!</p>");

	    // Confirm success with the user
	    echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php" style="color:black;">log in</a>.</p>';
	    $mysqli->close();
	    exit();
	  }
	  else {
	    // An account already exists for this username, so display an error message
	    echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
	    $username = "";
	  }
	}
	else {
	  echo '<p class="error">Your passwords doesn\'t match.</p>';
	}
}
if (isset($error_msg)){
	echo "<p class = 'error'>" . $error_msg . "</p>";
}
?>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" class = "signup">
	<fieldset>
		<legend>Personal Information:</legend>
		<label for = "first_name">Enter your First Name: </label>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type = "text" name = "first_name" id = "first_name" required />
		<br />
		<label for = "last_name">Enter your Last Name: </label>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type = "text" name = "last_name" id = "last_name" required />
		<br />
	</fieldset>
	<fieldset>
		<legend>Security:</legend>
		<label for = "name">Enter your Username: </label>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type = "text" name = "name" id = "name" required />
		<br />
		<label for = "name">Enter your valid E-Mail Address: </label>
		&nbsp&nbsp&nbsp
		<input type = "email" name = "email" id = "email" required />
		<br />
		<label for = "pass">Enter your Password: </label>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type = "password" name = "pass" id = "pass" required />
		<br />
		<label for = "pass">Re-Enter your Password: </label>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type = "password" name = "pass2" id = "pass2" required />	
	</fieldset>
	<input type = "submit" name = "register" value = "Join Me In too!" style = "margin-top:1%;" />
</form>
<?php
require_once('files/footer.php');
?>