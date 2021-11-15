<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_log_gest_gmadmin']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['log'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {

			$query = mysqli_query($con, "Select * from $web.log_gmadmin order by id desc");
			
			echo "<table class='table table-dark'>";
				echo "<th>".$lang['admin_log_gm']."</th>";
				echo "<th>".$lang['admin_log_action']."</th>";
				echo "<th>".$lang['admin_log_grad']."</th>";
				echo "<th>".$lang['admin_log_name']."</th>";
				echo "<th>".$lang['admin_log_data']."</th>";
			
			while($sql = mysqli_fetch_object($query) )
			{
				$gm = $sql->gm;
				$action = $sql->action_lang;
				$grad = $sql->grad;
				$name = $sql->name_player;
				$data = $sql->date;
				$action = $lang[$action];
				
				echo "<tr>
				<td>$gm</td>
				<td>$action</td>
				<td>$grad</td>
				<td>$name</td>
				<td>$data</td>
				</tr>";

			}	
				
			echo "</table>";
				
			
			
		}
?>
	</li>
</ul>