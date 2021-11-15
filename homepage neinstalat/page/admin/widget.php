<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_widget']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['widget'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_POST['activate']))
			{
				$id = replace('post', 'widget_id');
				$side = replace('post', 'side');
				
				$query = mysqli_query($con, "UPDATE $web.side SET `active`='1' WHERE (`id`='$id')");
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_widget_activate', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_widget_btn_activate_success']."</div>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_widget_btn_activate_danger']."</div>";
				
			}
			
			if(isset($_POST['update']))
			{
				$id = replace('post', 'widget_id');
				$side = replace('post', 'side');
				$active = replace('post', 'active');
				$query = mysqli_query($con, "UPDATE $web.side SET `side`='$side', `active`='$active' WHERE (`id`='$id')");
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_widget_update', '".$_SESSION['gm']."', NOW())");
				echo mysqli_error($con);
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_widget_update_success']."</div>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_widget_update_danger']."</div>";
				
			}
			
			$query = mysqli_query($con, "Select * from $web.side");
			
			echo "<table class='table table-dark'>";
				echo "<th>".$lang['admin_widget_name']."</th>";
				echo "<th>".$lang['admin_widget_side']."</th>";
				echo "<th>".$lang['admin_widget_activdezact']."</th>";
				echo "<th>".$lang['admin_widget_update']."</th>";
			
			while($sql = mysqli_fetch_object($query) )
			{
				$id = $sql->id;
				$widget = $sql->widget;
				$side = $sql->side;
				$active = $sql->active;
				
				
				$activ = "<input type='submit' name='update' class='btn btn-warning' value='".$lang['admin_widget_update']."'>";
				
				
				if($active == '1') $act = 'active';
				if($active == '0') $act = 'dezactive';
				$lang_active = 'admin_widget_'.$act;
				$lang_side = 'admin_widget_'.$side;
				
				
				echo "<form action='' method='POST'>";
				
				echo "<input type='hidden' name='widget_id' value='$id'>";
				echo "<tr>";
				echo "<td>$widget</td>";
				echo "<td>
				<select name='side' class='form-control'>
					<option value='$side'>".$lang[$lang_side]."</option>";
					if($side == 'right') echo "<option value='left'>".$lang['admin_widget_left']."</option>";
					if($side == 'left') echo "<option value='right'>".$lang['admin_widget_right']."</option>";
				echo "</select>
				</td>";
				echo "<td>
				<select name='active' class='form-control'>
					<option value='$active'>".$lang[$lang_active]."</option>";
					if($active == '0') echo "<option value='1'>".$lang['admin_widget_btn_activate']."</option>";
					if($active == '1') echo "<option value='0'>".$lang['admin_widget_btn_dezactivate']."</option>";
				echo "</select>
				</td>";
				echo "<td>$activ</td>";
				echo "</tr>";
				
				echo "</form>";
				
			}	
				
			echo "</table>";
				
			
			
		}
?>
	</li>
</ul>