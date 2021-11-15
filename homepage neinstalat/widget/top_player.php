<div class='widget'>
	<div class='title'>
		<?php print $lang['top_player5_title']; ?>
	</div>
	<?php
			$sql1 = mysqli_query($con, "SELECT player.id,player.name,player.level,player.exp,player_index.empire,guild.name AS guild_name 
	FROM $player.player 
	LEFT JOIN $player.player_index 
	ON player_index.id=player.account_id 
	LEFT JOIN $player.guild_member 
	ON guild_member.pid=player.id 
	LEFT JOIN $player.guild 
	ON guild.id=guild_member.guild_id 
	INNER JOIN $account.account 
	ON account.id=player.account_id 
	WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK' 
	ORDER BY player.level DESC, player.exp DESC LIMIT 3");


		echo "<table class='table'>
		<th>#</th>
		<th>".$lang['top_player5_name']."</th>
		<th>".$lang['top_player5_level']."</th>";
		
		$i = 0;
		while($sql = mysqli_fetch_object($sql1))
		{
			$i = $i+1;
			$name = $sql->name;
			$level = $sql->level;
			
			echo "
			<tr>
				<td>$i</td>
				<td><a href='$website/player/$name'>$name</a></td>
				<td>$level</td>
			</tr>";
			
		}

		
		echo "</table>";
		
		
		?>

</div>