<?php
	if($admin_acces['admins'] > $_SESSION['admin'])
	{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
	else { 
	
		if(isset($_POST['add_admin']))
		{
			
			if(isset($_POST['checkadmin']))
			{	
				$id = replace('post', 'accid');
				$admingrad = replace('post', 'admingrad');
				
				if($id != '' && $admingrad != '0')
				{
					$query = mysqli_query($con, "UPDATE $account.account SET `web_admin`='$admingrad' WHERE (`id`='$id')");
					mysqli_query($con, "INSERT INTO $web.log_webadmin (`id_acc`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$id', 'admin_log_webadmin_add', '$admingrad', '".$_SESSION['gm']."', NOW())");
					if($query)
						echo "<div class='alert alert-success'>".$lang['admin_panel_admins_add_success_admin']."</div>";
					else
						echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_add_danger_admin']."</div>";
					
					
				} 
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_add_danger_admin']."</div>";
			
			}
			
			if(isset($_POST['checkgm']))
			{	
				$id = replace('post', 'gmid');
				$gmgrad = replace('post', 'gmgrad');
				$gmtag = replace('post', 'gmtag');
				
				if($id != '')
				{
					$acc1 = mysqli_fetch_object(mysqli_query($con, "Select * from $player.player WHERE id = '$id'"));
					$acc = $acc1->account_id;
					$acc = mysqli_fetch_array(mysqli_query($con, "Select login from $account.account WHERE id = '$acc'"));
					$acc = $acc[0];
					
					$name = $acc1->name;
					$name = '['.$gmtag.']'.$name;
					
					$query1 = mysqli_query($con, "UPDATE $player.player SET `name`='$name' WHERE (`id`='$id')");
					$query2 = mysqli_query($con, "INSERT INTO $common.gmlist (`mAccount`, `mName`, `mAuthority`) VALUES ('$acc', '$name', '$gmgrad')");
					
				
				mysqli_query($con, "INSERT INTO $web.log_gmadmin (`name_player`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$name', 'admin_log_webadmin_add', '$gmgrad', '".$_SESSION['gm']."', NOW())");
				
					if($query1 && $query2)
						echo "<div class='alert alert-success'>".$lang['admin_panel_admins_add_success_gm']."</div>";
					else
						echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_add_danger_gm']."</div>";
					
					
				} 
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_add_danger_gm']."</div>";
			
			}			
			
			
			
		}
	
	
	
	
	
	
	?>
<form action='<?php print $website; ?>/admin/admins/add' method='POST'>
<ul class="list-group">
	
	
	
		<li class="list-group-item active"><input type="checkbox" name="checkadmin"> <?php print $lang['admin_panel_admins_add_check_website']; ?></li>
		<li class="list-group-item left-text">
			
		
			<input type="number" name="accid" class='form-control' placeholder='<?php print $lang['admin_panel_admins_add_acc_id']; ?>'><br>
			<select  class='form-control' name='admingrad'>
				<option value='0'><?php print $lang['admin_panel_admins_add_sel_webgrad']; ?></option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
			</select>
			
		</li>
</ul>
<ul class="list-group">
		
		<li class="list-group-item active"><input type="checkbox" name="checkgm"> <?php print $lang['admin_panel_admins_add_check_gm']; ?></li>
		<li class="list-group-item left-text">
			
			<input type="number" name="gmid" class='form-control' placeholder='<?php print $lang['admin_panel_admins_add_gm_id']; ?>'><br>
			<select  class='form-control' name='gmgrad'>
				<option value=''><?php print $lang['admin_panel_admins_add_sel_gmgrad']; ?></option>
				<option value='IMPLEMENTOR'>IMPLEMENTOR</option>
				<option value='HIGH_WIZARD'>HIGH_WIZARD</option>
				<option value='GOD'>GOD</option>
				<option value='LOW_WIZARD'>LOW_WIZARD</option>
				<option value='PLAYER'>PLAYER</option>
			</select><br>
			<input class='form-control' type='text' pattern='[A-Z]{1,}' name='gmtag' placeholder='<?php print $lang['admin_panel_admins_add_gm_tag']; ?>'>
		</li>
	
</ul>
	<br><div class='center'>
		<input type='submit' class='btn btn-info' name='add_admin' value='<?php print $lang['admin_panel_admins_add_btn']; ?>'>
	</div>
</form>
<?php } ?>