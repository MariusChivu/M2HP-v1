<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_log_gest_ban']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['log'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {

			$query = mysqli_query($con, "Select * from $web.log_ban order by id desc");
			
			echo "<table class='table table-dark'>";
				echo "<th>".$lang['admin_log_ban_acc']."</th>";
				echo "<th>".$lang['admin_log_ban_reason']."</th>";
				echo "<th>".$lang['admin_log_gm']."</th>";
				echo "<th>".$lang['admin_log_data']."</th>";
			
			while($sql = mysqli_fetch_object($query) )
			{
				$acc_id = $sql->id_acc;
				$acc = mysqli_fetch_object(mysqli_query($con, "Select * from $account.account where id='$acc_id'"));
				$acc = $acc->login;
				
				$reason = $sql->reason;
				$gm = $sql->gm;
				$data = $sql->date;
				
				
				
			echo '<tr title="'.$lang['admin_panel_account_list_char'].'" data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="hover"data-content="';
			
			$char = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.player where account_id = '$acc_id'"));
			$char = $char[0];
			if($char > '0') {
				$sql_char = mysqli_query($con, "Select * from $player.player where account_id = '$acc_id'");
				while($schar = mysqli_fetch_object($sql_char))
				{
					echo $schar->name.'<br>';
				}
			} else {
			
				$sql_char = mysqli_fetch_object(mysqli_query($con, "Select * from $player.player where account_id = '$id'"));
				if($sql_char)
					$txtchar = $sql_char->name;
				else echo $lang['admin_panel_account_list_char_no'];
			}
			
			echo'"">';
				echo "<td>$acc</td>
				<td>$reason</td>
				<td>$gm</td>
				<td>$data</td>
				</tr>";

			}	
				
			echo "</table>";
				
			
			
		}
?>
	</li>
</ul>