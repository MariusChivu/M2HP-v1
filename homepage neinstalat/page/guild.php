<?php
echo "<h3><i class='fas fa-chess-rook'></i> ".$lang['guild_info_title']."</h3>";
if(!isset($_GET['gld']) or $_GET['gld'] == null)
{
	echo "<div class='alert alert-danger'>".$lang['guild_info_no_guild_set']."</div>";
} else {
	$guild = replace('get', 'gld');
	
	$sql_count = mysqli_fetch_array( mysqli_query($con, "Select count(*) from $player.guild where name ='$guild'"));
	$sql_count = $sql_count[0];
	if($sql_count == '0')
	{
		echo "<div class='alert alert-danger'>".$lang['guild_info_no_guild']."</div>";
	} else {
		$sql = mysqli_fetch_object(mysqli_query($con, "Select * from $player.guild where name ='$guild'"));
			
			$id = $sql->id;
			$name = $sql->name;
			$master_id = $sql->master;
				$master = mysqli_fetch_array(mysqli_query($con, "Select name from $player.player where id ='$master_id'"));
				$master = $master[0];
			$level = $sql->level;
			$point = number_format($sql->ladder_point);
			$win = number_format($sql->win);
			$draw = number_format($sql->draw);
			$loss = number_format($sql->loss);
			
			$empire = mysqli_fetch_array(mysqli_query($con, "Select empire from $player.player_index where pid1='$master_id' or pid2='$master_id' or pid3='$master_id' or pid4='$master_id'"));
			$empire = $empire[0];
			
			echo "<div style='text-align: center;'>
				<img src='$website/style/$style/img/guild.png'><br><br>
				
				<table class='table table-striped table-bordered table-hover table-dark'>
					<tr><td style='text-align: right'>".$lang['guild_info_name'].":</td><td><b>$name</b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_master'].":</td><td><b><a href='$website/player/$master'>$master</a></b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_empire'].":</td><td><b><img src='$website/style/$style/img/empire/$empire.jpg' ></b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_level'].":</td><td><b>$level</b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_point'].":</td><td><b>$point</b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_win'].":</td><td><b>$win</b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_draw'].":</td><td><b>$draw</b></td></tr>
					<tr><td style='text-align: right'>".$lang['guild_info_loss'].":</td><td><b>$loss</b></td></tr>
				
				
				</table>
				</div>
				";
		
		$sql1 = mysqli_query($con, "SELECT player.id,player.name,player.level,player.exp,player_index.empire,guild.name AS guild_name 
		FROM $player.player 
		LEFT JOIN $player.player_index 
		ON player_index.id=player.account_id 
		LEFT JOIN $player.guild_member 
		ON guild_member.pid=player.id 
		LEFT JOIN $player.guild 
		ON guild.id=guild_member.guild_id 
		INNER JOIN $account.account 
		ON account.id=player.account_id where guild_id='$id' and player.name != '$master' ");
	
	echo "<h3><i class='fas fa-users'></i> ".$lang['guild_info_member_title']."</h3>";
	echo "<table class='table table-striped table-bordered table-hover table-dark'>
		<th>".$lang['guild_info_name']."</th>
		<th>".$lang['guild_info_level']."</th>";
		while($sql = mysqli_fetch_object($sql1))
		{
			$member_name = "<b><a href='$website/player/".$sql->name."'>".$sql->name."</a></b>";
			$member_level = $sql->level;
			echo "<tr><td>$member_name</td><td>$member_level</td></tr>";
		}
	echo "</table>";
	}
}
?>