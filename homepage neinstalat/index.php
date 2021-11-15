<?php

ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if(isset($_SERVER['HTTPS'])) { ini_set('session.cookie_secure', 1); } else {}
header('Cache-Control: no-cache, no-store, must-revalidate, private');
header('Pragma: no-cache');
header('Expires: 0');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=31536000 ; includeSubDomains');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');


error_reporting(0);
ini_set('display_errors', '0');
@ob_start();
session_start();
include('config/lang_config.php');

if(!isset($_COOKIE['lang'])) {
	unset($_COOKIE['lang']);
	setcookie('lang', $default_lang);

	header("location:".$_SERVER['REQUEST_URI']);
	//echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
}

//error_reporting(E_ALL);
//ini_set('display_errors', '1');



$base =  basename(dirname(__FILE__));
if($base != 'public_html' && $base != 'htdocs') $base='/'.$base;
else if($base == 'htdocs') $base='';
else if($base == 'public_html') $base='';
$site = $_SERVER['SERVER_NAME'];

if(isset($_SERVER['HTTPS'])) $http = 'https';
	else $http = 'http';	
	
$subdemoniu = '/'.explode('.', $site)[0];
if($subdemoniu == $base) $base = '';

	  
$website = $http.'://'.$site.$base;

include ("config/general_inc.php");


?>
<html lang='<?php print $_COOKIE['lang']; ?>'>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">	
	
	<link rel='shortcut icon' href='<?php print $website; ?>/style/<?php print $style; ?>/logo.png' />
	<link rel='stylesheet' href='<?php print $website; ?>/style/<?php print $style; ?>/style.css'>
	<script src="<?php print $website; ?>/config/js/amcharts.js"></script>
	<script src="<?php print $website; ?>/config/js/amcharts_serial.js"></script>
	<script src="<?php print $website; ?>/config/js/amcharts_light.js"></script>
	<link rel="stylesheet" href="<?php print $website; ?>/config/textarea/minified/themes/default.min.css" />
	<script src="<?php print $website; ?>/config/textarea/minified/jquery.sceditor.xhtml.min.js"></script>
	<script src="<?php print $website; ?>/config/js/js.cookie.js"></script>	
	
	<title><?php print $title; ?></title>
	<meta charset="UTF-8">
</head>
<?php
include ("functii/functii.mc.php");
include ("functii/functii.php");

login();
include("style/$style/ind.php"); 
?>

<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover(); 
  
});
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
</script>