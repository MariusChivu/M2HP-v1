<?php
@ob_start();
session_start()
?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">	
	
	<link rel='shortcut icon' href='https://m2hp.mariuschivu.ro/m2hp_logo.png' />
	<link rel='stylesheet' href='install.style.css'>	
	<title>M2HP - Metin2 Home Page</title>
	<meta charset="UTF-8">
</head>
<style>
#modal2 {
	display: block;
	background: #0b0a0a;
	opacity: 0.5;
	width: 100%;
	height: 100%;
    top: 0;
    left: 0;
	position: fixed;
	z-index: 999;
}
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $(".modal2").click(function(){
            window.location.replace("<?php print $_SERVER['REQUEST_URI']; ?>");
        });
    });
</script>
<?php
//error_reporting(E_ALL);
error_reporting(0);
if(isset($_POST['ro']))
{
	setcookie('lang', 'ro');
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
}
if(isset($_POST['en']))
{
	setcookie('lang', 'en');
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
}
$prefix = '';
$account = $prefix.'account';
$common = $prefix.'common';
$log = $prefix.'log';
$player = $prefix.'player';
$web = $prefix.'web_m2hp';;
function replacef($var)
{
	$new_var=str_replace(";","&#59;",$var);
	$new_var=str_replace("!","&#33;",$new_var);
	$new_var=str_replace("#","&#35;",$new_var);
	$new_var=str_replace("%","&#37;",$new_var);
	$new_var=str_replace("(","&#40;",$new_var);
	$new_var=str_replace(")","&#41;",$new_var);
	$new_var=str_replace("{","&#123;",$new_var);
	$new_var=str_replace("}","&#125;",$new_var);
	$new_var=str_replace("--","",$new_var);
	$new_var=str_replace("\'\'","",$new_var);
	$new_var=str_replace("-0||","",$new_var);
	$new_var=str_replace("'","&#8217;",$new_var);
	$new_var=str_replace('"',"&#34;",$new_var);
	$new_var=str_replace('http://',"",$new_var);
	$new_var=str_replace('https://',"",$new_var);
	$new_var=str_replace('www.',"",$new_var);
	$new_var=str_replace('//',"&#47;&#47;",$new_var);
	return $new_var;
}

class replacec
{
	 function get($t)
	{
		$get = $_GET[$t];
		$get = replacef($get);
		return $get;
		//replace('get', '$_GET');
	}

	 function post($t)
	{
		$post = $_POST[$t];
		$post = replacef($post);
		return $post;
		//replace('post', '$_POST');	
	}

	 function cookie($t)
	{
		$post = $_COOKIE[$t];
		$post = replacef($post);
		return $post;
		//replace('cookie', '$_POST');	
	}
}

function replace($a, $b)
{
	if($a == 'key')
	{
		return replacef($b);
		//replace('key', 'cuvant');
	} else {
		$class = new replacec;
		return $class->$a($b);
	}
}

function alert_account()
{	
global $lang2;
	include('functii/mysql_config.php');
	global $account;
	$con = mysqli_connect($host, $user, $pass, $account);
	
  echo'<div class="alert alert-warning"><b>'.$lang2['step3_acc'].'</b></div>';
  
  $add_web=array();  
  
  $add_web[] = "ALTER TABLE $account.account ADD `real_name` varchar(16) COLLATE utf8_unicode_ci DEFAULT ''";
  $add_web[] = "ALTER TABLE $account.account ADD `social_id` varchar(13) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''";
  $add_web[] = "ALTER TABLE $account.account ADD `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''";
  $add_web[] = "ALTER TABLE $account.account ADD `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'";
  $add_web[] = "ALTER TABLE $account.account ADD `coins` int(11) NOT NULL DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `jcoins` int(11) DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `web_admin` int(1) NOT NULL DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `token_pw` varchar(64) COLLATE utf8_unicode_ci DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `token_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `motiv_ban` varchar(256) COLLATE utf8_unicode_ci DEFAULT '0'";
  $add_web[] = "ALTER TABLE $account.account ADD `admin_ban` varchar(256) COLLATE utf8_unicode_ci NOT NULL";
  $add_web[] = "ALTER TABLE $account.account ADD `exp_ban` date NOT NULL";
  $add_web[] = "ALTER TABLE $account.account ADD `admin_unban` varchar(256) COLLATE utf8_unicode_ci NOT NULL";
  $add_web[] = "ALTER TABLE $account.account ADD `unban_data` varchar(256) COLLATE utf8_unicode_ci NOT NULL";
  $add_web[] = "ALTER TABLE $account.account ADD `mail_activation` varchar(32) COLLATE utf8_unicode_ci NOT NULL";
  $add_web[] = "ALTER TABLE $account.account ADD `aff_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0'";
 
 
  foreach($add_web AS $blub) {
    echo '<p style="font-size:11px;">'.$blub;
    $aktQry = mysqli_query($con, $blub);
    if($aktQry) 
    {
      echo '<div class="alert alert-success" role="alert">
				<strong>'.$lang2['success_db'].'</strong>.
			</div>';    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
				<strong>'.$lang2['exist_db'].'</strong>.
			</div>';

      echo'</a>';
    }
    echo'</p>';
  }
	
}
function add_web()
{	
global $lang2;
	include('functii/mysql_config.php');
	global  $web;
	$con2 = mysqli_connect($host, $user, $pass);
	mysqli_query($con2, "CREATE DATABASE $web;");
	$con = mysqli_connect($host, $user, $pass, $web);
	
  echo'<div class="alert alert-warning"><b>'.$lang2['step3_web'].'</b></div>';
  
  $add_web=array();  
  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `affiliate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aff_token` varchar(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `give_md` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acc` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `gm` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_lang` varchar(255) DEFAULT NULL,
  `news_title` varchar(255) DEFAULT '0',
  `gm` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_gmadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_player` varchar(11) DEFAULT NULL,
  `action_lang` enum('admin_log_webadmin_add','admin_log_webadmin_update','admin_log_webadmin_delete') DEFAULT NULL,
  `grad` varchar(11) DEFAULT NULL,
  `gm` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_unban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acc` int(255) NOT NULL,
  `gm` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_webadmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_acc` int(11) DEFAULT NULL,
  `action_lang` enum('admin_log_webadmin_add','admin_log_webadmin_update','admin_log_webadmin_delete') DEFAULT NULL,
  `grad` int(11) DEFAULT NULL,
  `gm` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(9999) NOT NULL,
  `gm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `side` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget` varchar(255) DEFAULT NULL,
  `side` enum('right','left') DEFAULT NULL,
  `active` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "CREATE TABLE IF NOT EXISTS `log_coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gm` varchar(255) NOT NULL,
  `id_account` int(11) NOT NULL,
  `md` int(255) NOT NULL,
  `jd` int(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
";  
  $add_web[] = "INSERT INTO `config` VALUES ('1', 'style', 'default');";  
  $add_web[] = "INSERT INTO `config` VALUES ('2', 'title', 'M2HP - Metin2 Home Page');";  
  $add_web[] = "INSERT INTO `config` VALUES ('3', 'game_mod', 'Pvm');";  
  $add_web[] = "INSERT INTO `config` VALUES ('4', 'max_level', '127');";  
  $add_web[] = "INSERT INTO `config` VALUES ('5', 'exp', '350');";  
  $add_web[] = "INSERT INTO `config` VALUES ('6', 'drop', '300');";  
  $add_web[] = "INSERT INTO `config` VALUES ('7', 'yang', '400');";  
  $add_web[] = "INSERT INTO `config` VALUES ('8', 'open', NOW());";  
  $add_web[] = "INSERT INTO `config` VALUES ('9', 'facebook', 'Marius-Chivu-WebMarius-Chivu-Web-545973569136560');";  
  $add_web[] = "INSERT INTO `config` VALUES ('10', 'youtube', 'assTrNFEQKU');";  
  $add_web[] = "INSERT INTO `config` VALUES ('11', 'register', '1');";  
  $add_web[] = "INSERT INTO `config` VALUES ('12', 'register_mail', '0');";  
  $add_web[] = "INSERT INTO `config` VALUES ('13', 'online_5min', '1');";  
  $add_web[] = "INSERT INTO `config` VALUES ('14', 'online_24h', '1');";  
  $add_web[] = "INSERT INTO `config` VALUES ('16', 'aff_md', '10');";  
  $add_web[] = "INSERT INTO `config` VALUES ('17', 'aff_on', '1');";  
  $add_web[] = "INSERT INTO `config` VALUES ('18', 'default_lang', 'ro');";  
  $add_web[] = "INSERT INTO `side` VALUES ('1', 'account_stat', 'left', '1');";  
  $add_web[] = "INSERT INTO `side` VALUES ('2', 'facebook', 'left', '1');";  
  $add_web[] = "INSERT INTO `side` VALUES ('3', 'top_guild', 'right', '1');";  
  $add_web[] = "INSERT INTO `side` VALUES ('4', 'top_player', 'right', '1');";  
  $add_web[] = "INSERT INTO `side` VALUES ('5', 'youtube', 'left', '1');";  
  
 
  foreach($add_web AS $blub) {
    echo '<p style="font-size:11px;">'.$blub;
    $aktQry = mysqli_query($con, $blub);
    if($aktQry) 
    {
      echo '<div class="alert alert-success" role="alert">
				<strong>'.$lang2['success_db'].'</strong>.
			</div>';    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
				<strong>'.$lang2['exist_db'].'</strong>.
			</div>';

      echo'</a>';
    }
    echo'</p>';
  }
	
}


if(!isset($_COOKIE['lang'])) { 
	

?>
	<div class='sel_lang'>
	<img src='https://m2hp.mariuschivu.ro/m2hp_logo.png'><br><br>
	<h1><span class="fa fa-globe-americas"></span></h1>
	<form action='' method='POST'>
		<input type='submit' class='btn btn-info' name='ro' value='Română'> 
		<input type='submit' class='btn btn-info' name='en' value='English'>
	</form>
	</div>
	
<?php } else {
include("lang/".$_COOKIE['lang'].".install");

if(isset($_COOKIE['step1']) == 'ok'){ echo "<style> .step1 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step2']) == 'ok'){ echo "<style> .step2 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step3']) == 'ok'){ echo "<style> .step3 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step4']) == 'ok'){ echo "<style> .step4 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step5']) == 'ok'){ echo "<style> .step5 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step6']) == 'ok'){ echo "<style> .step6 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step7']) == 'ok'){ echo "<style> .step7 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step8']) == 'ok'){ echo "<style> .step8 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step9']) == 'ok'){ echo "<style> .step9 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step10']) == 'ok'){ echo "<style> .step10 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step11']) == 'ok'){ echo "<style> .step11 { color: #44bd36; }</style>"; }
if(isset($_COOKIE['step12']) == 'ok'){ echo "<style> .step12 { color: #44bd36; }</style>"; }
?>
<!--
<div class='left-menu'>
	<div class='inside'>
		<img src='https://m2hp.mariuschivu.ro/m2hp_logo.png'><br>
		<h4 class='step1'><?php print $lang2['step1']; ?></h4><br>
		<h4 class='step2'><?php print $lang2['step2']; ?></h4><br>
		<h4 class='step3'><?php print $lang2['step3']; ?></h4><br>
		<h4 class='step4'><?php print $lang2['step4']; ?></h4><br>
		<h4 class='step5'><?php print $lang2['step5']; ?></h4><br>
		<h4 class='step6'><?php print $lang2['step6']; ?></h4><br>

	</div>
</div>
-->
<div class='body'>
	<div class='inside'>
	<img src='https://m2hp.mariuschivu.ro/m2hp_logo.png'>
	<br>
	<!-- STEP1 -->
	<?php
	if(isset($_POST['step2']))
	{
		setcookie("step1", "ok");
		$host = replace('post', 'host');
		$user = replace('post', 'user');
		$pass = replace('post', 'pass');
		
		$put_content  = '<?php
$host = "'.$host.'";
$user = "'.$user.'";
$pass = "'.$pass.'";
?>';

if (!file_exists('functii')) {
    mkdir('functii', 0755, true);
}

echo $put_content;
		
		file_put_contents("functii/mysql_config.php", $put_content);
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
	}
	
	if(!isset($_COOKIE['step1']))
	{
	?>
	<h3><?php print $lang2['step1']; ?></h3><br>
	<form action='' method='POST'>
		<input type='text' class='form-control' name='host' placeholder='<?php print $lang2['host']; ?>'><br>
		<input type='text' class='form-control' name='user' placeholder='<?php print $lang2['user']; ?>'><br>
		<input type='password' class='form-control' name='pass' placeholder='<?php print $lang2['pass']; ?>'><br>
		<input type='submit' name='step2' value='<?php print $lang2['next']; ?>' class='btn btn-success'>
	</form>
	<?php } 
	if(isset($_COOKIE['step1']) && !isset($_COOKIE['step2']))
	{
		?>
		<h3><?php print $lang2['step2']; ?></h3><br>
		<?php include("functii/mysql_config.php");
		$con = mysqli_connect($host, $user, $pass);
		if($con) {
			echo "<div class='alert alert-success'>".$lang2['step2_succes']."</div>";
			setcookie("step2", "ok");
		echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['REQUEST_URI'].'">';
		} else {
			echo "<div class='alert alert-danger'>".$lang2['step2_danger']."</div>";
			setcookie("step1", "", time()-3600);
		echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['REQUEST_URI'].'">';
		}
	}
		if(isset($_POST['step3']))
	{
		setcookie("step3", "ok");
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
	}
	if(isset($_COOKIE['step2']) && !isset($_COOKIE['step3']))
	{
		?>
		<h3><?php print $lang2['step3']; ?></h3><br>
		<?php 
		alert_account();
		add_web();
		
		echo "	<form action='install.php' method='POST'>
		<input type='submit' name='step3' value='".$lang2['next']."' class='btn btn-success'>
	</form>";
	}
		if(isset($_POST['step4']))
	{
		setcookie("step4", "ok");
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
	}
	if(isset($_COOKIE['step3']) && !isset($_COOKIE['step4']))
	{
		?>
		<h3><?php print $lang2['step4']; ?></h3><br>
		<?php
		$file = file_get_contents("https://m2hp.mariuschivu.ro/download/M2HP_install.pack");

		if($file) {
			$install = file_put_contents("M2HP_install.pack", $file);
		} else {
			echo "<h4><a href='https://m2hp.mariuschivu.ro/download/M2HP_install.pack'>".$lang2['manual_download']."</a></h4>";
		}
		$install2 = 'M2HP_install.pack';
					$zip = new ZipArchive;
			$res = $zip->open($install2);

			$path = pathinfo(realpath("index.php"), PATHINFO_DIRNAME);

			if ($res === TRUE) {
			  $zip->extractTo($path);
			  $zip->close();
			  
			unlink($install2);
			?>
			<div style="text-align:left;"><br><h5>
								<script>
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").css("width", "100%");
								  }, 0);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").toggleClass("bg-info bg-success");
								  }, 2200);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog2").css("display", "block");
									$(".progress2").css("width", "100%");
								  }, 2400);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress2").toggleClass("bg-info bg-success");
								  }, 4600);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog3").css("display", "block");
									$(".progress3").css("width", "100%");
								  }, 4800);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress3").toggleClass("bg-info bg-success");
								  }, 7000);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog4").css("display", "block");
									$(".hprog4").css("height", "125px");
								  }, 7400);
								});
								
								</script>
								<style> .progress-bar { transition: width 2s; }
										.progress { margin-bottom: 20px; }
										.hprog4 { margin-bottom: 20px; } </style>
								<?php print $lang2["update_success_download"]; ?><br>
								<div class="progress">
									<div class="progress-bar bg-info progress1" style="width:0%"></div>
								</div>
								
								<div class="hprog2" style="display:none;">
									<?php print $lang2["update_success_verify"]; ?><br>
									<div class="progress">
										<div class="progress-bar bg-info progress2" style="width:0%;"></div>
									</div>
								</div>
								
								<div class="hprog3" style="display:none;">
									<?php print $lang2["update_success_install"]; ?><br>
									<div class="progress">
										<div class="progress-bar bg-info progress3" style="width:0%;"></div>
									</div>
								</div>
								
							</h5>
							</div>
		<?php 
		
		echo "<div class='hprog4' style='display:none; overflow-y:hidden; height:25px; transition:height 0.5s'>	<form action='' method='POST'>
		<input type='submit' name='step4' value='".$lang2['next']."' class='btn btn-success'>
	</form>
	</div>";
		} 
	}
	if(isset($_POST['step5']))
	{
		setcookie("step5", "ok");
		$mail_host = replace('post', 'mail_host');
		$mail_Username = replace('post', 'mail_Username');
		$mail_Password = replace('post', 'mail_Password');
		$mail_Port = replace('post', 'mail_Port');
		
		$put_content = '<?php
$mail_Host = "'.$mail_host.'";
$mail_Username = "'.$mail_Username.'";
$mail_Password = "'.$mail_Password.'";
$mail_Port = "'.$mail_Port.'";
?>';
		file_put_contents("functii/mail_config.php", $put_content);
		
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
		
		
	}
	if(isset($_COOKIE['step4']) && !isset($_COOKIE['step5']))
	{
		?>
		<h3><?php print $lang2['step5']; ?></h3><br>
		
		<form action='' method='POST'>
			<input type='text' class='form-control' name='mail_host' placeholder='<?php print $lang2['mail_host']; ?>'><br><br>
			<input type='text' class='form-control' name='mail_Username' placeholder='<?php print $lang2['mail_Username']; ?>'><br><br>
			<input type='text' class='form-control' name='mail_Password' placeholder='<?php print $lang2['mail_Password']; ?>'><br><br>
			<input type='text' class='form-control' name='mail_Port' placeholder='<?php print $lang2['mail_Port']; ?>'><br><br>
			<input type='submit' name='step5' value='<?php print $lang2['next']; ?>' class='btn btn-success'>
	
	<?php }
	if(isset($_COOKIE['step5']) && !isset($_COOKIE['step6']))
	{
		?>
		<h3><?php print $lang2['step6']; ?></h3><br>
		<h4><?php print $lang2['licenta_txt']; ?></h4>
		
	<?php
		if (!file_exists('config')) {
			mkdir('config', 0755, true);
		}
		$get_key = file_get_contents("https://m2hp.mariuschivu.ro?install");
		
		if($get_key) {
			file_put_contents("config/license.key", $get_key);
		} else {
			$base =  basename(dirname(__FILE__));
			if($base != 'public_html' && $base != 'htdocs') $base='/'.$base;
			else if($base == 'htdocs') $base='';
			else if($base == 'public_html') $base='';
			$site = $_SERVER['SERVER_NAME'];

			if(isset($_SERVER['HTTPS'])) $http = 'https';
				else $http = 'http';	
				
			$subdemoniu = '/'.explode('.', $site)[0];
			if($subdemoniu == $base) $base = '';

				  
			$website = $site.$base;
			$m2hp = "https://m2hp.mariuschivu.ro?install&domeniu=$website";
			if(!isset($_GET['key'])) {
				echo '<meta http-equiv="refresh" content="0;url='.$m2hp.'">';
			} else {
				$key = replace('get', 'key');
			file_put_contents("config/license.key", $key);
			}
		}
			
		?>
		
								<script>
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").css("width", "100%");
								  }, 0);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").toggleClass("bg-info bg-success");
								  }, 2200);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog4").css("display", "block");
									$(".hprog4").css("height", "125px");
								  }, 2400);
								});
								</script>
								<style> .progress-bar { transition: width 2s; }
										.progress { margin-bottom: 20px; }
										.hprog4 { margin-bottom: 20px; } 
										</style>
								<div class="progress">
									<div class="progress-bar bg-info progress1" style="width:0%"></div>
								</div>
								<div class='hprog4' style='display:none; overflow-y:hidden; height:25px; transition:height 0.5s'>	<form action='' method='POST'>
						<input type='submit' name='step6' value='<?php print $lang2['next']; ?>' class='btn btn-success'>
					</form>
					</div>
	<?php
	}
	
			if(isset($_POST['step6']))
	{
		setcookie("step6", "ok");
		echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
	}
	if(isset($_POST['connect2']))
	{
		global $account;
		global $common;
			
		include('functii/mysql_config.php');
		include('lang/'.$_COOKIE['lang'].'.lang');
		$con = mysqli_connect($host, $user, $pass);

		$name = replace('post', 'user');
		$pass = replace('post', 'pass');
		
		$check_user = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where login='$name' and password=PASSWORD('".$pass."')"));
		$check_user = $check_user[0];
		if($check_user != '0')
		{
			$sql = mysqli_fetch_object(mysqli_query($con, "Select * from $account.account where login='$name' and password=PASSWORD('".$pass."')"));
			$_SESSION['user'] = $name;
			$_SESSION['id']= $sql->id;
			$_SESSION['name']= $sql->real_name;
			$_SESSION['mail']= $sql->email;
			$_SESSION['admin']= $sql->web_admin;
			$_SESSION['aff']= $sql->aff_token;
			$queryGM = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM $common.gmlist where mAccount='$name' limit 1"));
			
			mysqli_query($con, "UPDATE $account.account SET `web_admin`='4' WHERE (`login`='$name')");
			if(!$queryGM) { }
			if($queryGM){ $gm = $queryGM->mName; $_SESSION['gm'] = $gm; }
			//echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';

				setcookie("step7", "ok");
				echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
			
		} else {
			echo '
				<div id="modal2"></div>		
				  <div class="modal show modal2" style="display: block;">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">'.$lang['err_login_head'].'</h4>
						<a href="'.$_SERVER['REQUEST_URI'].'" class="close" data-dismiss="modal">&times;</a>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
						'.$lang['err_login_txt'].'
						<br><br>
					  </div>

					</div>
				  </div>
				</div>
			';
		}
	
	

		//echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
	}
	if(isset($_COOKIE['step6']) && !isset($_COOKIE['step7']))
	{
		?>
		<h3><?php print $lang2['step7']; ?></h3><br>
		<form action='' method='POST'>
			<input type='hidden' name='install' value='inst'>
			<input type='text' class='form-control' name='user' placeholder='<?php print $lang2['admin_acc']; ?>'><br>
			<input type='password' class='form-control' name='pass' placeholder='<?php print $lang2['adminpass']; ?>'><br>
			<input type='submit' name='connect2' value='<?php print $lang2['next']; ?>' class='btn btn-success'>
		</form>
	<?php 
	}
	if(isset($_COOKIE['step7']))
	{
		?>
		<h3><?php print $lang2['step8']; ?></h3><br>
		<h4><?php print $lang2['step8text']; ?></h4><br>
		
	<?php 
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
		echo '<form action="'.$website.'/admin/panel" method="POST">
				<input type="submit" name="update" class="btn btn-success" value="'.$lang2["finish"].'">
				
			</form>';
		unlink("install.php");
		unlink("install.style.css");
		unlink("lang/ro.install");
		unlink("lang/en.install");
	
	
	}
	?>
	
	
	</div>
</div>
<?php } ?>