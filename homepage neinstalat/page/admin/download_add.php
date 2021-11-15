<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_download']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['download'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_POST['add_link']))
			{
				$name = $_POST['name'];
				$link = $_POST['link'];
				$size = $_POST['size'];
				$size2 = $_POST['size2'];
				
				$size = $size.' '.$size2;
				$type = $_POST['type'];
				
				$query  = mysqli_query($con, "INSERT INTO $web.download (`name`, `link`, `size`, `type`) VALUES ('$name', '$link', '$size', '$type')");
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_addlink', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_download_add_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_download_add_danger']."</div><br>";
			}
			
			echo "
			<form action='$website/admin/download/add' method='POST'>
				<input class='form-control' name='name' placeholder='".$lang['admin_panel_download_add_name']."'><br>
				<input class='form-control' name='link' placeholder='".$lang['admin_panel_download_add_link']."'><br>
				<input class='form-control' type='number' name='size' placeholder='".$lang['admin_panel_download_add_size']."'><br>
				<select name='size2' class='form-control'>
					<option value=''>".$lang['admin_panel_download_add_size2']."</option>
					<option value='KG'>KB</option>
					<option value='MB'>MB</option>
					<option value='GB'>GB</option>
				</select><br>
				<select name='type' class='form-control'>
					<option value=''>".$lang['admin_panel_download_add_type']."</option>
					<option value='torrent'>".$lang['admin_panel_download_add_torrent']."</option>
					<option value='rar'>".$lang['admin_panel_download_add_rar']."</option>
					<option value='zip'>".$lang['admin_panel_download_add_zip']."</option>
					<option value='exe'>".$lang['admin_panel_download_add_exe']."</option>
				</select><br>
				
				<div class='center'><input name='add_link' class='btn btn-primary' type='submit' value='".$lang['admin_panel_download_add_btn']."'></div>
				
			</form>";
			
		}
?>
	</li>
</ul>