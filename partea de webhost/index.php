<?php
include("../mc_website/functii/functii.mc.php");
include("../mc_website/functii/config.php");

error_reporting(0);
$db = 'jblewcqq_m2hp_licenta';
$con = mysqli_connect($host, $user, $pass, $db);
$v = file_get_contents("version");
mysqli_query($con, "UPDATE `m2hp_licenta` SET `tip_licenta`='INACTIVA' WHERE DATE_SUB(NOW(), INTERVAL 1 day) > ultima_conexiune");

if(!isset($_GET['update']) && !isset($_GET['install']) && !isset($_GET['check']) )
{
	///////////////
	// M2HP INDEX
	/////////////
	if(isset($_POST['download']))
	{
		
		$count = file_get_contents("file/download.count");
		$count = $count+1;
		file_put_contents("file/download.count", $count);
		
		echo '<meta http-equiv="refresh" content="0;url=https://m2hp.mariuschivu.ro/download/M2HP.zip">';

	}
	
$download = file_get_contents("file/download.count");
$activ = mysqli_fetch_array(mysqli_query($con, "Select count(*) from m2hp_licenta where tip_licenta='ACTIVA'"));
$activ = $activ[0];
$instl = mysqli_fetch_array(mysqli_query($con, "Select count(*) from m2hp_licenta"));
$instl = $instl[0];
?>
<head>	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">	

	<link rel='shortcut icon' href='https://m2hp.mariuschivu.ro/m2hp_logo.png' />
	<link rel='stylesheet' href='file/style.css'>	
	<title>M2HP - Metin2 Home Page</title>
	<meta charset="UTF-8">

</head>

<div class='logo'><img src='https://m2hp.mariuschivu.ro/m2hp_logo.png'></div>

<div class='div-table'>
	<div class='inside-table'>
		<table class='table'>
			<tr><td>Versiune</td><td><?php print $v; ?></td></tr>
			<tr><td>Număr descărcări</td><td><span class='count'><?php print $download; ?></span></td></tr>
			<tr><td>Utilizări active</td><td><span class='count'><?php print $activ; ?></span></td></tr>
			<tr><td>Total instalări</td><td><span class='count'><?php print $instl; ?></span></td></tr>
		
		
		</table>
	
	</div>
	
	<div class='download'><br><br>
		<a href='demo' class='btn btn-info' target='_blank'>Previzualizare live</a><br><br>
		<form action='' method='POST'>
			<input type='submit' name='download' class='btn btn-info' value='Descarcă'>
		</form>
	
	</div>

</div>

<div class='info'>
	<div class='version'>
		<div class='title'>Istoric versiuni</div>
		<div class='inside'><?php include("file/istoric"); ?></div>
	
	</div>
	
	<div class='prezentare'>
		<div class='title'>Prezentare</div>
		<div class='inside'><?php include("file/prezentare"); ?></div>
	</div>

</div>
<br><br><br><br>
<script>
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>

<?php }

if(isset($_GET['update']) or isset($_GET['check']) )
{
	$key = replace('get', 'key');
	$version = replace('get', 'version');
	$domeniu = replace('get', 'domeniu');
	$ip = $_SERVER['REMOTE_ADDR'];

}

if(isset($_GET['check']))
{
	mysqli_query($con, "UPDATE `m2hp_licenta` SET `domeniu`='$domeniu', `tip_licenta`='ACTIVA', `ultima_conexiune`=CURDATE(), `ip_licenta`='$ip' WHERE (`licenta_key`='$key')");
}

if(isset($_GET['install']))
{
	$new_key = mysqli_fetch_array(mysqli_query($con, "Select count(*) from m2hp_licenta"));
	$new_key = $new_key[0];
	$new_key = md5($new_key+1);
	
	$count = mysqli_fetch_array(mysqli_query($con, "Select count(*) from m2hp_licenta where domeniu ='$domeniu'"));
	$count = $count[0];
	
	if($count == '0')
	{
		mysqli_query($con, "INSERT INTO `m2hp_licenta` (`licenta_key`, `domeniu`, `tip_licenta`, `ip_licenta`) VALUES ('$new_key', '$domeniu', 'ACTIVA', '$ip')");
		echo $new_key;
		
	}
	if($count > 0)
	{
	$take_key = mysqli_fetch_array(mysqli_query($con, "Select licenta_key from m2hp_licenta where domeniu ='$domeniu'"));
	$take_key = $take_key[0];
	echo $take_key;
		
	}
	
}

if(isset($_GET['update']))
{
	if(!isset($_GET['version']) or !isset($_GET['key']) or !isset($_GET['domeniu']))
	{
		echo '<div class="alert alert-danger"><?php print $lang["license_error"]; ?></div>';
	} else
	{
		echo '<div class="alert alert-info">
		<table class="table table-dark">
			<tr><td><?php print $lang["license_key"]; ?></td><td>'.$key.'</td></tr>
			<tr><td><?php print $lang["license_domain"]; ?></td><td>'.$domeniu.'</td></tr>
			<tr><td><?php print $lang["license_ip"]; ?></td><td>'.$ip.'</td></tr>
		</table>
		</div>';
		$check = mysqli_fetch_array(mysqli_query($con, "Select count(*) from m2hp_licenta where licenta_key='$key'"));
		$check = $check[0];
		if($check == '0') {
			echo '<div class="alert alert-danger"><?php print $lang["license_error"]; ?></div>';
		}
		if($check > '0') {
			if($version != $v)
			{
				$need_update = file_get_contents("update/need_update.php");
				$err_update = file_get_contents("update/err_update.php");
				
				
				
		echo'<form action="" method="POST"><input type="submit" name="update" class="btn btn-success" value="<?php print $lang["update_now"]; ?>"></form>
		<?php
		if(isset($_POST["update"])) {
		$file = file_get_contents("https://m2hp.mariuschivu.ro/update/vSTeewsswEGHbfbs8938bdfssdSRRSDaf/M2HP_update_'.$v.'.zip");
			$update = file_put_contents("update/M2HP_update.pack", $file);
			$install2 = "update/M2HP_update.pack";
						$zip = new ZipArchive;
				$res = $zip->open($install2);

				$path = pathinfo(realpath("index.php"), PATHINFO_DIRNAME);

				if ($res === TRUE) {
				  $zip->extractTo($path);
				  $zip->close();
				  
				unlink($install2);
				?>
				'.$need_update.'
				
		<?php } 
		if ($res != TRUE)
		{ ?>
			'.$err_update.'
		<?php }
		
		
		}
		file_put_contents("update/update", md5(rand(1,9999)));
				?>';
				
			}
		}
		
		
	}
	//("https://m2hp.mariuschivu.ro?update&version=$version&key=$key&domeniu=$site")
	
}

?>