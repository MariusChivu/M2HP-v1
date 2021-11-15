<?php
$style = file_get_contents('config/config_file/style.cfg');
$title = file_get_contents('config/config_file/title.cfg');
$version = file_get_contents('config/version');

global $lang;
global $website;
global $site;
global $style;
global $title;
global $admin_acces;
global $version;
include("functii/mysql_config.php");
include('functii/db_config.php');

$con = mysqli_connect($host, $user, $pass);
