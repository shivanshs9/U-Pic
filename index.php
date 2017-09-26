<?php
$title = "Home Page";
$head = "Welcome to Cyber-X-Zone!";
require_once('files/header.php');

echo '<p>Hello, ' . (isset($_SESSION['user_id']) ? $user_firstname . ' ' . $user_lastname : 'Guest' ). '!</p>';

if (isset($_SESSION['user_id']))
{ ?>
	<script type="text/javascript" src="files/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="files/jquery.form.js"></script>
	<script type="text/javascript" src="files/upload_progress.js"></script>
	<link rel="stylesheet" type="text/css" href="files/progress_style.css">
	<form action="upload.php" id = "imgUpload" method="post" enctype="multipart/form-data">
	    Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload" required>
	    <input type="submit" value="Upload Image" name="submit" class="btnSubmit">
	<div id="progress-div"><div id="progress-bar"></div></div>
	<div id="targetLayer"></div>
	</form>
	<div id="loader-icon" style="display:none;"><img src="media/LoaderIcon.gif" /></div>
<?php
}

require_once('files/footer.php');
?>