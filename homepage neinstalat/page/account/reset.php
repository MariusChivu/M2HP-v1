<?php 
echo "<h3><i class='fas fa-user-lock'></i> ".$lang['reset_title']."</h3>";

if(!isset($_GET['char']) or $_GET['char'] == null)
{
	echo "<div class='alert alert-danger'>".$lang['reset_no_char_set']."</div>";
} else {
	$char = replace('get', 'char');
		
	$sql_count = mysqli_fetch_array( mysqli_query($con, "Select count(*) from $player.player WHERE DATE_SUB(NOW(), INTERVAL 10 MINUTE) > last_play AND name ='$char'"));
	$sql_count = $sql_count[0];
		
		
	if($sql_count != '1')
	{
		echo "<div class='alert alert-danger'>".$lang['reset_no_10min']."</div>";
	} else {
		$sql0 = mysqli_query($con, "Select * from $player.player WHERE name ='$char' and account_id='".$_SESSION['id']."'");
			
		if(mysqli_num_rows($sql0) == '0')
		{
			echo "<div class='alert alert-danger'>".$lang['reset_char_error']."</div>";
		} else {
			
			$sql = mysqli_fetch_object($sql0);
			$player_id = $sql->id;
			
			$empire = mysqli_fetch_array(mysqli_query($con, "Select empire from $player.player_index where pid1='$player_id' or pid2='$player_id' or pid3='$player_id' or pid4='$player_id'"));
			$empire = $empire[0];
			
			if($empire=='1') { $mapindex = "0"; $x = "459770"; $y = "953980";} //regat rosu
			elseif($empire=='2') { $mapindex = "21"; $x = "52043"; $y = "166304";} //regat galben
			elseif($empire=='3') { $mapindex = "41"; $x = "957291"; $y = "255221";} //regat albastru
				
			$update = mysqli_query($con, "UPDATE $player.player SET map_index='$mapindex', x='$x', y='$y', exit_x='0', exit_y='0', exit_map_index='$mapindex', horse_riding='0' WHERE id='$player_id'");
			
				if($update)
				{ 
					echo "<div class='alert alert-success'>".$lang['reset_success_1']."<b> $char </b>".$lang['reset_success_2']."</div>";
				} else {
					echo "<div class='alert alert-danger'>".$lang['reset_error']."</div>";
				}
			
		}			
	}
}

?>