<div class='center'>

<?php

if(isset($_POST['updateinfo']))
{
	$servername = replace('post', 'servername');
	$game_mod = replace('post', 'game_mod');
	$max_level = replace('post', 'max_level');
	$exp = replace('post', 'exp');
	$drop = replace('post', 'drop');
	$yang = replace('post', 'yang');
	$open = replace('post', 'open');
	$facebook = replace('post', 'facebook');
	$youtube = replace('post', 'youtube');
	$register = replace('post', 'register');
	$register_mail = replace('post', 'register_mail');
	$online_5min = replace('post', 'online_5min');
	$online_24h = replace('post', 'online_24h');
	$aff_md = replace('post', 'aff_md');
		if($aff_md < '0') $aff_md = '0';
	$aff_on = replace('post', 'aff_on');
	$set_lang = replace('post', 'lang');
	
	mysqli_query($con, "UPDATE $web.config SET `value`='$servername' WHERE (`name`='title')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$game_mod' WHERE (`name`='game_mod')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$max_level' WHERE (`name`='max_level')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$exp' WHERE (`name`='exp')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$drop' WHERE (`name`='drop')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$yang' WHERE (`name`='yang')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$open' WHERE (`name`='open')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$facebook' WHERE (`name`='facebook')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$youtube' WHERE (`name`='youtube')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$register' WHERE (`name`='register')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$register_mail' WHERE (`name`='register_mail')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$online_5min' WHERE (`name`='online_5min')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$online_24h' WHERE (`name`='online_24h')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$aff_md' WHERE (`name`='aff_md')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$aff_on' WHERE (`name`='aff_on')");
	mysqli_query($con, "UPDATE $web.config SET `value`='$set_lang' WHERE (`name`='default_lang')");
	mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_updateinfo', '".$_SESSION['gm']."', NOW())");
	updatecfg();
	echo "<div class='alert alert-success'>".$lang['admin_panel_success_info']."</div>";
	echo '<meta http-equiv="refresh" content="2;url='.$_SERVER['REQUEST_URI'].'">';
	
	
}

include ("update.php");
?>


	<!-- Tab panes -->
	<div class="tab-content">
	  
	  <div class="tab-pane active container" id="menu1">
		
		<?php include("general_info.php"); ?>
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_panel_gest_news']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['news'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/news/add'>".$lang['admin_panel_add_news']."</a>";
					echo "<h5><a href='$website/admin/news/manage'>".$lang['admin_panel_manage_news']."</a>";
					echo "<h5><a href='$website/admin/presentation'>".$lang['presentation']."</a>";
					echo "<h5><a href='$website/admin/widget'>".$lang['admin_widget']."</a>";
					
				}
				?>
			</li>
		</ul>
		
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_panel_gest_admins']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['admins'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/admins/site'>".$lang['admin_panel_admins_sitelist']."</a>";
					echo "<h5><a href='$website/admin/admins/gm'>".$lang['admin_panel_admins_gmlist']."</a>";
					echo "<h5><a href='$website/admin/admins/add'>".$lang['admin_panel_admins_add']."</a>";
					
				}
				?>
			</li>
		</ul>
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_panel_download']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['download'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/download/delete'>".$lang['admin_panel_download_del']."</a>";
					echo "<h5><a href='$website/admin/download/add'>".$lang['admin_panel_download_add']."</a>";
					
				}
				?>
			</li>
		</ul>
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_panel_account']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['account'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/account/list'>".$lang['admin_panel_account_list']."</a>";
					echo "<h5><a href='$website/admin/account/block'>".$lang['admin_panel_account_block']."</a>";
					
				}
				?>
			</li>
		</ul>
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_log_gest']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['account'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/log/general'>".$lang['admin_log_gest_general']."</a>";
					echo "<h5><a href='$website/admin/log/ban'>".$lang['admin_log_gest_ban']."</a>";
					echo "<h5><a href='$website/admin/log/unban'>".$lang['admin_log_gest_unban']."</a>";
					echo "<h5><a href='$website/admin/log/gm/administration'>".$lang['admin_log_gest_gmadmin']."</a>";
					echo "<h5><a href='$website/admin/log/gm/command'>".$lang['admin_log_gest_gmaingame']."</a>";
					echo "<h5><a href='$website/admin/log/webadmin'>".$lang['admin_log_gest_webdmin']."</a>";
					
				}
				?>
			</li>
		</ul>
		
		<ul class="list-group">
			<li class="list-group-item active"><?php print $lang['admin_panel_coins']; ?></li>
			<li class="list-group-item left-text">
				<?php	
				if($admin_acces['coins'] > $_SESSION['admin'])
				{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
				else {
					echo "<h5><a href='$website/admin/coins'>".$lang['admin_panel_coins_title']."</a>";
					echo "<h5><a href='$website/admin/log/coins'>".$lang['admin_log_coins']."</a>";
					
				}
				?>
			</li>
		</ul>				
	  </div>

	</div>
</div>
