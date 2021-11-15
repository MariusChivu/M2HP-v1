<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_log_gest_gmaingame']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['log'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {

			echo "<table class='table table-dark'>
				<th class='active'>".$lang['admin_log_gm']."</th>
				<th class='active'>".$lang['admin_log_action']."</th>
				<th class='active'>".$lang['admin_log_data']."</th>";
				
			$sql = mysqli_query($con, "select * from $log.command_log order by date desc");
				
			while($obj = mysqli_fetch_object($sql))
			{
				
				echo "<tr>
				<td>".$obj->username."</td>
				<td>/".$obj->command."</td>
				<td>".$obj->date."</td>
				</tr>";
				
			}
			echo "</table>";

						
					
			
		}
?>
	</li>
</ul>