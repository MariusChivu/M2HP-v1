<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_admins_sitelist']; ?></li>
	<li class="list-group-item left-text">
	<?php	
		if($admin_acces['admins'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_GET['edit']) && isset($_POST['grad_edit']))
			{
				$id = replace('get', 'edit');
				$grad = replace('post', 'web_grad');
				
				$query = mysqli_query($con, "UPDATE $account.account SET `web_admin`='$grad' WHERE (`id`='$id')");
				mysqli_query($con, "INSERT INTO $web.log_webadmin (`id_acc`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$id', 'admin_log_webadmin_update', '$grad', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_admins_sitelist_edit_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_sitelist_edit_danger']."</div><br>";
				
				
			}
			
			if(isset($_GET['edit']) && isset($_POST['grad_delete']))
			{
				$id = replace('get', 'edit');
				
				$query = mysqli_query($con, "UPDATE $account.account SET `web_admin`='0' WHERE (`id`='$id')");
				mysqli_query($con, "INSERT INTO $web.log_webadmin (`id_acc`, `action_lang`, `grad`, `gm`, `date`) VALUES ('$id', 'admin_log_webadmin_delete', '0', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_admins_sitelist_del_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_admins_sitelist_del_danger']."</div><br>";
				
				
			}
			
			
			echo "<table class='table table-dark'>
			<th>#</th>
			<th>".$lang['admin_panel_admins_sitelist_name']."</th>
			<th>".$lang['admin_panel_admins_sitelist_admin']."</th>
			<th>".$lang['admin_panel_admins_sitelist_edit']."</th>
			<th>".$lang['admin_panel_admins_sitelist_del']."</th>";
			
			$sql0 = mysqli_query($con, "Select * from $account.account where web_admin > 0");
			$i = 0;
			while($sql = mysqli_fetch_object($sql0))
			{
				$i = $i+1;
				$id = $sql->id;
				$login = $sql->login;
				$grad = $sql->web_admin;
				
				$del = "<form action='$website/admin/admins/site/$id' method='POST'>
				<input type='submit' name='grad_delete' class='btn btn-danger' value='".$lang['manage_news_del_btn']."'>
				</form>";
				
				echo "
				<tr>
					<td>$i</td>
					<td>$login</td>
					<td>
						<form action='$website/admin/admins/site/$id' method='POST'>
						<input type='number' name='web_grad' class='form-control' value='$grad'>
					</td>
					<td>
						<input type='submit' name='grad_edit' class='btn btn-primary' value='".$lang['manage_news_edit_btn']."'>
						</form>
					</td>
					<td>$del</td>";
				
			}
			
			echo "</table>";
		}
	?>
	</li>
</ul>