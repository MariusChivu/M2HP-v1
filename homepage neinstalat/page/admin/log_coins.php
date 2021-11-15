<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_log_coins']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['coins'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {

			$query = mysqli_query($con, "Select * from $web.log_coins order by date desc");
			
			echo "<table class='table table-dark'>";
				echo "<th>".$lang['admin_log_gm']."</th>";
				echo "<th>".$lang['admin_log_coins_id']."</th>";
				echo "<th>".$lang['admin_log_coins_md']."</th>";
				echo "<th>".$lang['admin_log_coins_jd']."</th>";
				echo "<th>".$lang['admin_log_data']."</th>";
			
			while($sql = mysqli_fetch_object($query) )
			{
				$gm = $sql->gm;
				$id = $sql->id_account;
				$md = $sql->md;
				$jd = $sql->jd;
				$data = $sql->date;
				
				
				echo "<tr>
				<td>$gm</td>
				<td>$id</td>
				<td>$md</td>
				<td>$jd</td>
				<td>$data</td>
				</tr>";

			}	
				
			echo "</table>";
				
			
			
		}
?>
	</li>
</ul>