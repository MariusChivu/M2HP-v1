<?php
if(isset($_SESSION['user']))
{
	echo '<h5 class="center">'.$lang['right_user_panel_title'].'</h5>';
	$id = $_SESSION['id'];
	$admin = $_SESSION['admin'];
	$sql_sts = mysqli_fetch_array(mysqli_query($con, "Select status, motiv_ban, unban_data from $account.account where id='$id'"));
	$sts = $sql_sts[0];
	$motiv_ban = $sql_sts[1];
	$unban_data = $sql_sts[2];
	
	// MENU
	echo "<table class='table' style='font-weight: bold;'>";
	echo "<tr><td><i class='fas fa-info'></i><i class='fas fa-question'></i> </td><td> <a href='$website/account/info'> ".$lang['right_user_panel_accinfo']."</a> </td></tr>";
	if($admin > 0) {
		echo "<tr><td><i class='fas fa-cog'></i> </td><td> <a href='$website/admin/panel'> ".$lang['right_user_panel_admin']."</a> </td></tr>";
	}
	
	if($sts == 'OK') {
		echo "<tr><td><i class='fas fa-user-lock'></i> </td><td> <a href='$website/account/password'> ".$lang['right_user_panel_chg_pass']."</a> </td></tr>";
		echo "<tr><td><i class='fas fa-envelope'></i> </td><td> <a href='$website/account/mail'> ".$lang['right_user_panel_chg_mail']."</a> </td></tr>";
		echo "<tr><td><i class='fas fa-user-plus'></i> </td><td> <a href='$website/account/affiliate'> ".$lang['right_user_panel_aff']."</a> </td></tr>";
		echo "<tr><td><i class='fas fa-unlock'></i> </td><td> <a href='$website/account/safebox'> ".$lang['right_user_panel_pass_dep']."</a> </td></tr>";
	}
	if($sts != 'OK' && $motiv_ban == 'MAIL_ACTIVATE') {
		echo "</table>";
		echo "<p style='color: #822424; font-weight: bold;'>".$lang['info_acc_mail_activate']."</p>";
	}
	if($sts != 'OK' && $motiv_ban != 'MAIL_ACTIVATE') {
		echo "<tr style='color: #822424'><td>".$lang['info_acc_status']."</td><td>".$lang['info_acc_status_block']."</td></tr>";
		echo "<tr style='color: #822424'><td>".$lang['info_acc_reason']."</td><td>$motiv_ban</td></tr>";
		echo "<tr style='color: #328224'><td>".$lang['info_acc_unban']."</td><td>$unban_data</td></tr>";

	}
	echo "</table>";
	
	if($sts == 'OK') {
		/// CHAR
		echo "<table class='table'>
		<th>".$lang['right_user_panel_char']."</th>
		<th>".$lang['right_user_panel_reset']."</th>
		";

		
		$sql_char = mysqli_query($con, "Select * from $player.player where account_id = '$id'");
		while($char = mysqli_fetch_object($sql_char))
		{
			$player_id = $char->id;
			$chars = $char->name;
			$lvl = $char->level;
			$job = $char->job;
			
			$sql_time = mysqli_fetch_array(mysqli_query($con, "Select last_play from $player.player WHERE DATE_SUB(NOW(), INTERVAL 10 MINUTE) < last_play AND id='$player_id'"));
			$time = $sql_time[0];
			$time2 = date_create($time);
			
			if($time != '') {
				$min = date_format($time2, 'i')+10;
				
				if($min > '59') $min = $min - 60; if($min < 10) $min = '0'.$min;
				
				$reset = $lang['right_user_panel_reset_txt'].'<br>'.
				date_format($time2, 'H').':'.$min;
				
			}
			else {
				$reset = "<a href='$website/account/reset/$chars'>".$lang['right_user_panel_reset']."</a>";
				
			}
			
			echo "
			<tr>
				<td>
					<img src='$website/style/$style/img/char/misc/$job.png' style='height: 20px; width: 20px;'>
					<b><a href='$website/player/$chars'>$chars</a></b>
				</td>
				<td>$reset</td>
				
			</tr>
			";
		}
		echo "</table>";
	}
	
}

?>