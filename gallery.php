<?php
$title = "Photo Gallery";
$head = "Browse shared photos!";
require_once('files/header.php');
//imgallery PHP Class
include("imgallery.php");
?>
<!--Scripts (jQuery + LightBox Plugin + imgallery Script)-->
<script type="text/javascript" src="files/jquery-3.2.1.js"></script>
<script type="text/javascript" src="files/jquery-lightbox.0.41.js"></script>
<script type="text/javascript" src="files/imgallery.js"></script>
 
<!--CSS (LightBox CSS + imgallery CSS)-->
<link rel="stylesheet" type="text/css" href="files/lightbox.css" />
<link rel="stylesheet" type="text/css" href="files/imgallery.css" />
<?php
$gal = new ImgGallery;
$gal->getPublicSide();

require_once('files/footer.php');
?>