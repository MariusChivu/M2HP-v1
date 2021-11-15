<script>
	$(function() {
		$("textarea").sceditor({
			plugins: 'xhtml',
			style: '<?php print $website; ?>/config/textarea/minified/jquery.sceditor.default.min.css'
		});
	});
</script>
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
include("config/general_inc.php");
include("functii/aff_givemd.php");
include("functii/acces_rights.php");

updatecfg();
$key = file_get_contents("config/license.key");
fopen("https://m2hp.mariuschivu.ro?check&version=$version&key=$key&domeniu=$site", 'r');

/*
$http = file_get_contents("config/config_file/http.cfg");
if($http == 'https')
{
	$check_https = file_get_contents("https://".$_SERVER['SERVER_NAME']."/index.php");
	if(!$check_https)
	{
		mysqli_query($con, "UPDATE $web.config SET `value`='http' WHERE (`name`='http')");
		echo '<meta http-equiv="refresh" content="0;url=http://'.$_SERVER['SERVER_NAME'].'">';
	}
}
*/

if(isset($_GET['logout']))
{
	session_destroy();
	echo '<meta http-equiv="refresh" content="0;url='.$website.'">';
	
}

if(isset($_GET['lang']))
{
	$set_lang = replace('get', 'lang');
	setcookie('lang', $set_lang);
	echo '<meta http-equiv="refresh" content="0;url='.$website.'">';
}
$lang = $_COOKIE['lang'];
include("lang/$lang.lang");
mysqli_query($con, "DELETE FROM $account.account WHERE DATE_SUB(NOW(), INTERVAL 2 day) > create_time AND status != 'OK' AND motiv_ban = 'MAIL_ACTIVATE';");
mysqli_query($con, "UPDATE $account.account SET `status`='OK', `exp_ban`='0000-00-00', `admin_unban`='AUTO_UNBAN', `unban_data`=NOW() WHERE status != 'OK' and exp_ban <= CURDATE();");

function updatecfg()
{
	include("config/general_inc.php");
	$config = mysqli_query($con, "Select * from $web.config");
	while($sql = mysqli_fetch_object($config))
	{
		$name = $sql->name;
		$val = $sql->value;
		file_put_contents("config/config_file/$name.cfg", $val);
		
	}
}

function login()
{
	
	include("config/general_inc.php");
	if(isset($_POST['connect']))
	{
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
			
			if(!$queryGM) { }
			if($queryGM){ $gm = $queryGM->mName; $_SESSION['gm'] = $gm; }
			//echo '<meta http-equiv="refresh" content="0;url='.$_SERVER['REQUEST_URI'].'">';
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
	}
	
}


function page()
{
	include("config/general_inc.php");
	if(isset($_GET['page'])) {
		$page = replace('get', 'page');
		
		if($page == '')
		{
			include('page/home.php');
		}
		if(!file_exists("page/$page.php"))
		{
			echo "<div class='alert alert-danger'>".$lang['error_page']."</div>";
		}
		if(file_exists("page/$page.php") && $page !='')
		{
			if($page == 'presentation') echo "<h3><i class='fas fa-file-alt'></i> ".$lang['presentation']."</h3>";
			include("page/$page.php");
		}
	}
	else
	{
		include("page/home.php");
	}
}

function account()
{
	include("config/general_inc.php");
	if(isset($_GET['account'])) {
		$acc = replace('get', 'account');
		
		if($acc == '')
		{
			include('page/account/panel.php');
		}
		if(!file_exists("page/account/$acc.php"))
		{
			echo "<div class='alert alert-danger'>".$lang['error_page']."</div>";
		}
		if(file_exists("page/account/$acc.php") && $acc !='')
		{
			include("page/account/$acc.php");
		}
	}
}
function admin()
{
	include("config/general_inc.php");
	if(isset($_GET['admin'])) {
		$admin = replace('get', 'admin');
		if(!isset($_SESSION['user']))
		{
			echo "<div class='alert alert-danger'>".$lang['error_no_acces']."</div>";
		} else {
			if($admin == '')
			{
				include('page/admin/panel.php');
			}
			if(!file_exists("page/admin/$admin.php"))
			{
				echo "<div class='alert alert-danger'>".$lang['error_page']."</div>";
			}
			if(file_exists("page/admin/$admin.php") && $admin !='')
			{
				include("page/admin/$admin.php");
			}
		}
	}
}

function content()
{
	include("config/general_inc.php");
	if(!$con)
	{
		include("page/offline.php");
	} else {
		if(!isset($_GET['account']) && !isset($_GET['admin']))
		{
			page();
		}
		if (isset($_GET['account']))
		{
			
			if(!isset($_SESSION['user']))
			{
				echo "<div class='alert alert-danger'>".$lang['error_no_login']."</div>";
			} else {
				account();
			}
			
		}
		if(isset($_GET['admin']))
		{
			echo "<div class='admin-panel'>";
				echo "<h5 class='center'><a style='color:black' href='$website/admin/panel'><i class='fas fa-cog'></i> ".$lang['admin_panel_title']."</a></h5>";
				admin();
			echo "</div>";

		}
	}
}

function mail_corp($to, $subiect, $mesaj)
{
global $title;

include("functii/use_PHPMailer.php");

	
	                   // Set mailer to use SMTP	
	include("config/general_inc.php");
	$mesaj_send = "	
<style>
a {
	background-color:#7892c2;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	border-radius:7px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:4px 8px;
	text-decoration:none;
	text-shadow:0px 1px 0px #283966;
	margin-top: 10px;
}
a:hover {
	background-color:#5482c7;
}
a:active {
	position:relative;
	top:1px;
}

.titlu {
	padding: 10px;
	font-size: 35px;
	text-align: center;
	font-weight: bold;
}

.mesaj {
	padding: 20px;
	font-size: 25px;
	border-top:1px solid #ececec;
	text-align: center;
}

.subsol {
	color: #a3a3a3;
	font-size: 20px;
	border-top:1px solid #ececec;
	text-align: center;
}

.corp {
	background-color: #3d3d3d;
	color: white;
	border:1px solid #3d3d3d;
}
</style>

<div class='corp'>
	<div class='titlu'>
			<b>".$subiect."</b>
	</div>

	<div class='mesaj'>
			".$mesaj."
	</div>
	
	<br><br>
	<div class='subsol'>
	<br>
	".$lang['mail_end_msj1']."<br>
		".$lang['mail_end_msj2']." <b>".$title."</b> ".$lang['mail_end_msj3']."
	<br><br>
	</div>
</div>
";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subiect;
    $mail->Body    = $mesaj_send;
    $mail->addAddress($to);               // Name is optional
  $mail->send();
//$mail = mail($to, $subiect, $mesaj_send, "Content-Type: text/html; charset=utf-8");

//$mail = new mail($to, $subiect, $mesaj_send);

	
	if(!$mail) {
		"<div class='alert alert-success'>".$lang['error_send_mail']."</div>";
	} else {
		echo "<div class='alert alert-success'>".$lang['success_mail']."</div>";
		}
}

function status_acc()
{
	include("config/general_inc.php");
		
	if(isset($_POST['unblock_acc']))
	{
		$unblock_id = replace('post', 'unblock_id');
		$gm = $_SESSION['gm'];
		
		$query = mysqli_query($con, "UPDATE $account.account SET `status`='OK', `exp_ban`='0000-00-00', `admin_unban`='$gm', `unban_data`=NOW() WHERE (`id`='$unblock_id')");
		mysqli_query($con, "INSERT INTO $web.log_unban  (`id_acc`, `gm`, `date`) VALUES ('$unblock_id', '$gm',NOW())");
		
		if($query)
		{
			echo "<div class='alert alert-success'>".$lang['admin_panel_account_ban_unblock_success']."</div>";
		} else {
			echo "<div class='alert alert-success'>".$lang['admin_panel_account_ban_unblock_danger']."</div>";
		}
		
	}
	if(isset($_POST['block_acc']))
	{
		$block_id = replace('post', 'block_id');
		$block_motiv = replace('post', 'block_motiv');
		$block_data = replace('post', 'block_data');
		$admin_ban = $_SESSION['gm'];
		
		$query = mysqli_query($con, "UPDATE $account.account SET `status`='BLOCK', `motiv_ban`='$block_motiv', `admin_ban`='$admin_ban', `exp_ban`='$block_data' WHERE (`id`='$block_id')");
		mysqli_query($con, "INSERT INTO $web.log_ban (`id_acc`, `reason`, `gm`, `date`) VALUES ('$block_id', '$block_motiv', '$admin_ban', NOW())");
		
		if($query)
		{
			echo "<div class='alert alert-success'>".$lang['admin_panel_account_ban_block_success']."</div>";
		} else {
			echo "<div class='alert alert-success'>".$lang['admin_panel_account_ban_block_danger']."</div>";
		}
	}
	
	
}