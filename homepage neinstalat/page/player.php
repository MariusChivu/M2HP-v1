<?php
echo "<h3><i class='fas fa-user'></i> ".$lang['player_info_title']."</h3>";
if(!isset($_GET['char']) or $_GET['char'] == null)
{
	echo "<div class='alert alert-danger'>".$lang['player_info_no_char_set']."</div>";
} else {
	$char = replace('get', 'char');
	
	$sql_count = mysqli_fetch_array( mysqli_query($con, "Select count(*) from $player.player where name ='$char'"));
	$sql_count = $sql_count[0];
	if($sql_count == '0')
	{
		echo "<div class='alert alert-danger'>".$lang['player_info_no_char']."</div>";
	} else {
		$sql0 = mysqli_query($con, "Select * from $player.player where name ='$char'");
		while($sql = mysqli_fetch_object($sql0) )
		{
			$player_id = $sql->id;
			$name = $sql->name;
			$job = $sql->job;
			$level = $sql->level;
			$playtime = $sql->playtime;
				$ore = floor($playtime / 60);
				$minute = $playtime % 60;
			$last_play = $sql->last_play;
			$horse = $sql->horse_level;
			$exp = number_format($sql->exp);
			$level_step = $sql->level_step;
			
			$empire = mysqli_fetch_array(mysqli_query($con, "Select empire from $player.player_index where pid1='$player_id' or pid2='$player_id' or pid3='$player_id' or pid4='$player_id'"));
			$empire = $empire[0];
			
			$status = mysqli_query($con, "SELECT COUNT(*) as count FROM $player.player WHERE DATE_SUB(NOW(), INTERVAL 5 MINUTE) < last_play AND name = '$char';"); 
			$online = mysqli_fetch_object($status)->count;
			echo '<center>';
			if ($online == "1") { $stson = '<b style="color: #328224;">'.$lang['player_info_online'].'</b>'; 
			} else { 
			$stson = '<b style="color: #822424;">'.$lang['player_info_offline'].'</b>
			<tr><td style="text-align: right">'.$lang['player_info_last_playtime'].':</td><td>'.$last_play.'</td></tr>';
			}
			
			$check_guild = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.guild_member where pid ='$player_id'"));
			$check_guild = $check_guild[0];
			if($check_guild != '0')
			{
				$id_guild = mysqli_fetch_object(mysqli_query($con, "select * from $player.guild_member where pid='$player_id'"));
				$id_guild = $id_guild->guild_id;
					
				$guild = mysqli_fetch_object(mysqli_query($con, "select name from $player.guild where id = '$id_guild'"));
				$guild = $guild->name;
			 
				$sguild = "<b><a href='$website/guild/$guild'>$guild</a></b>";
			} else { $sguild = '-'; }
			
			echo "<div style='text-align: center;'>
				<img src='$website/style/$style/img/char/$job.png'><br><br>
				
				<table class='table table-striped table-bordered table-hover table-dark'>
					<tr><td style='text-align: right'>".$lang['player_info_name'].":</td><td><b>$name</b></td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_status'].":</td><td>$stson</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_empire'].":</td><td><img src='$website/style/$style/img/empire/$empire.jpg' ></td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_level'].":</td><td>$level</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_exp'].":</td><td>$exp</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_levelstep'].":</td><td>$level_step / 4</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_playtime'].":</td><td>$ore ".$lang['player_info_playtime_ore']." & $minute ".$lang['player_info_playtime_minute']."</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_guild'].":</td><td>$sguild</td></tr>
					<tr><td style='text-align: right'>".$lang['player_info_horse_level'].":</td><td>$horse</td></tr>
				</table>
			</div>
			";	
		}	
	}
}
?>