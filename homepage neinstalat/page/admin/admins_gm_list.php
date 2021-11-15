<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_admins_gmlist']; ?></li>
	<li class="list-group-item left-text">
	<?php	
		if($admin_acces['admins'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_GET['edit']) && isset($_POST['gm_edit']))
			{
				$id = replace('get', 'edit');
				$grad = replace('post', 'gm_grad');
				
				$query = mysqli_query($con, "UPDATE $common.gmlist SET `mAuthority`='$grad' WHERE (`mID`='$id')");
				
				$mname = mysqli_fetch_object(mysqli_query($con, "Select * from $common.gmlist where mID = '$id'"));
				$mname = $mname->mName;
				
				mysqli_query($con, "INSERT INTO $web.log_gmadmin (`name_player`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$mname', 'admin_log_webadmin_update', '$grad', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_admins_gmlist_edit_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_gmlist_edit_danger']."</div><br>";
				
			}
			
			if(isset($_GET['edit']) && isset($_POST['grad_delete']))
			{
				$id = replace('get', 'edit');
				
				$mname = mysqli_fetch_object(mysqli_query($con, "Select * from $common.gmlist where mID = '$id'"));
				$mname = $mname->mName;
				
				mysqli_query($con, "INSERT INTO $web.log_gmadmin (`name_player`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$mname', 'admin_log_webadmin_delete', 'PLAYER', '".$_SESSION['gm']."', NOW())");
				
				$query = mysqli_query($con, "DELETE FROM $common.gmlist WHERE (`mID`='$id')");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_admins_gmlist_del_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_gmlist_del_danger']."</div><br>";
				
				
			}
			
			
			echo "<table class='table table-dark'>
			<th>#</th>
			<th>".$lang['admin_panel_admins_gmlist_name']."</th>
			<th>".$lang['admin_panel_admins_gmlist_admin']."</th>
			<th>".$lang['admin_panel_admins_gmlist_edit']."</th>
			<th>".$lang['admin_panel_admins_gmlist_del']."</th>";
			
			$sql0 = mysqli_query($con, "Select * from $common.gmlist");
			$i = 0;
			while($sql = mysqli_fetch_object($sql0))
			{
				$i = $i+1;
				$id = $sql->mID;
				$mName = $sql->mName;
				$mAuthority = $sql->mAuthority;
				
				$del = "<form action='$website/admin/admins/gm/$id' method='POST'>
				<input type='submit' name='grad_delete' class='btn btn-danger' value='".$lang['manage_news_del_btn']."'>
				</form>";
				
				echo "
				<tr>
					<td>$i</td>
					<td>$mName</td>
					<td>
						<form action='$website/admin/admins/gm/$id' method='POST'>
						<select name='gm_grad' class='form-control'>
							<option value='$mAuthority'>$mAuthority</option>";
							if($mAuthority == 'IMPLEMENTOR') {} else echo "<option value='IMPLEMENTOR'>IMPLEMENTOR</option>";
							if($mAuthority == 'HIGH_WIZARD') {} else echo "<option value='HIGH_WIZARD'>HIGH_WIZARD</option>";
							if($mAuthority == 'GOD') {} else echo "<option value='GOD'>GOD</option>";
							if($mAuthority == 'LOW_WIZARD') {} else echo "<option value='LOW_WIZARD'>LOW_WIZARD</option>";
							if($mAuthority == 'PLAYER') {} else echo "<option value='PLAYER'>PLAYER</option>";
						echo "</select>
					</td>
					<td>
						<input type='submit' name='gm_edit' class='btn btn-primary' value='".$lang['manage_news_edit_btn']."'>
						</form>
					</td>
					<td>$del</td>";
				
			}
			
			echo "</table>";
		}
	?>
	</li>
</ul>