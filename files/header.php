<!DOCTYPE html PUBLIC = "-//WC//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
	<title>U-Pic | <?php echo $title; ?></title>
	<link rel ="stylesheet" type = "text/css" href = "files/style.css" />
</head>
<body>
<img class = "logo" src = "./images/logo.png" />
<?php
require_once('files/authenticate.php');
require_once('nav.php');
?>
<div class = "body">
<?php
echo "<h1 class = 'head'>" . $head. "</h1>";
?>