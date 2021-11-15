<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_general_info_gest']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['general_set'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
		
			$servername = file_get_contents("config/config_file/title.cfg");
			$game_mod = file_get_contents("config/config_file/game_mod.cfg");
			$max_level = file_get_contents("config/config_file/max_level.cfg");
			$exp = file_get_contents("config/config_file/exp.cfg");
			$drop = file_get_contents("config/config_file/drop.cfg");
			$yang = file_get_contents("config/config_file/yang.cfg");
			$open = file_get_contents("config/config_file/open.cfg");
			$facebook = file_get_contents("config/config_file/facebook.cfg");
			$youtube = file_get_contents("config/config_file/youtube.cfg");
			$register = file_get_contents("config/config_file/register.cfg");
			$register_mail = file_get_contents("config/config_file/register_mail.cfg");
			$online_5min = file_get_contents("config/config_file/online_5min.cfg");
			$online_24h = file_get_contents("config/config_file/online_24h.cfg");
			$aff_md = file_get_contents("config/config_file/aff_md.cfg");
			$aff_on = file_get_contents("config/config_file/aff_on.cfg");
			$default_lang2 = file_get_contents("config/config_file/default_lang.cfg");
			
			function check_active($i)
			{
				global $lang;
				if($i == '1')
				{
					echo "<option value='1'>".$lang['admin_panel_enable']."</option>";
					echo "<option value='0'>".$lang['admin_panel_disable']."</option>";
				} else {
					echo "<option value='0'>".$lang['admin_panel_disable']."</option>";
					echo "<option value='1'>".$lang['admin_panel_enable']."</option>";
				}
			}
		
		echo "<form action='' method='POST'>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_default_lang']."</span>
				</div>
				<select class='form-control' name='lang'>
					<option value='$default_lang2'>".lang_name($default_lang2)."</option>";
					
					$select_lang = "lang/*.lang";
					foreach (glob("lang/*.lang") as $filename)
					{
					
						$lng = basename($filename, ".lang");
						echo "<option value='$lng'>".lang_name($lng)."</option>";
					}
			echo "</select>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_servername']."</span>
				</div>
				<input class='form-control' value='$servername' name='servername'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_gamemod']."</span>
				</div>
				<input class='form-control' value='$game_mod' name='game_mod'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_level']."</span>
				</div>
				<input type='number' autocomplete='off' class='form-control' value='$max_level' name='max_level'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_exp']."</span>
				</div>
				<input type='number' autocomplete='off' class='form-control' value='$exp' name='exp'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_drop']."</span>
				</div>
				<input type='number' autocomplete='off' class='form-control' value='$drop' name='drop'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_yang']."</span>
				</div>
				<input type='number' autocomplete='off' class='form-control' value='$yang' name='yang'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_open']."</span>
				</div>
				<input class='form-control' value='$open' name='open' type='date'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_facebook']."</span>
				</div>
				<input class='form-control' value='$facebook' name='facebook'>
			</div>
		
			<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_youtube']."</span>
				</div>
				<input class='form-control' value='$youtube' name='youtube'>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_register']."</span>
				</div>
				<select class='form-control' name='register'>";
					echo check_active($register);
			echo "</select>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_registermail']."</span>
				</div>
				<select class='form-control' name='register_mail'>";
					echo check_active($register_mail);
			echo "</select>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_online5']."</span>
				</div>
				<select class='form-control' name='online_5min'>";
					echo check_active($online_5min);
			echo "</select>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_online24']."</span>
				</div>
				<select class='form-control' name='online_24h'>";
					echo check_active($online_24h);
			echo "</select>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_aff_md']."</span>
				</div>
				<input class='form-control' value='$aff_md' name='aff_md' type='number'>
			</div>";
		
			echo "<div class='input-group mb-3'>
				<div class='input-group-prepend'>
					<span class='input-group-text'>".$lang['admin_panel_aff_on']."</span>
				</div>
				<select class='form-control' name='aff_on'>";
					echo check_active($aff_on);
			echo "</select>
			</div>";
			
			echo "<input class='btn btn-primary' type='submit' value='".$lang['admin_panel_update_btn']."' name='updateinfo'>
				</form>";
		}
?>
	</li>
</ul>