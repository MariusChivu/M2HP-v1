<?php
if($admin_acces['update'] > $_SESSION['admin'])
{ }
else {

	$key = file_get_contents("config/license.key");

	$file = file_get_contents("https://m2hp.mariuschivu.ro?update&version=$version&key=$key&domeniu=$site");
	
	 
	 file_put_contents("update/update", $file);
	 include("update/update");
	 
}