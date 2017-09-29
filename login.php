<?php
$title = "Sign In";
$head = "Login here!";
require_once('files/header.php');
if(isset($_POST['login'])){

	$username = $mysqli->real_escape_string(trim($_POST['name']));
	$pass = $mysqli->real_escape_string(trim($_POST['pass']));

    if (!empty($username) && !empty($pass)) {
        // Look up the username and password in the database
        $query = "SELECT sha_id FROM users WHERE name = '$username' AND password = SHA('$pass')";
        $data = $mysqli->query($query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['sha_id'];
          setcookie('user_id', $row['sha_id'], time() + (60 * 60 * 24 * 1));    // expires in 1 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
          $mysqli->close();
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}
if (isset($error_msg)){
	echo "<p class = 'error'>" . $error_msg . "</p>";
}
?>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" class = "signin">
  <fieldset>
    <legend>Log-In</legend>
  	<label for = "name">Enter your Username: </label>
    &nbsp&nbsp&nbsp&nbsp&nbsp
  	<input type = "text" name = "name" id = "name" required />
  	<br />
  	<label for = "pass">Enter your Password: </label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  	<input type = "password" name = "pass" id = "pass" required />
	</fieldset>
	<input type = "submit" name = "login" value = "Sign Me In!" style = "margin-top:1%;"/>
</form>
<?php
require_once('files/footer.php');
?>