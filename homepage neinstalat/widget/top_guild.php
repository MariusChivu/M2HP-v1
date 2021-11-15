<div class='widget'>
	<div class='title'>
		<?php print $lang['top_guild_title']; ?>
	</div>
	<?php
		$sql1 = mysqli_query($con, "Select * from $player.guild ORDER BY ladder_point desc, level desc, exp desc LIMIT 3");


		echo "<table class='table'>
		<th>#</th>
		<th>".$lang['top_guild_name']."</th>
		<th>".$lang['top_guild_point']."</th>";
		
		$i = 0;
		while($sql = mysqli_fetch_object($sql1))
		{
			$i = $i+1;
			$name = $sql->name;
			$point = number_format($sql->ladder_point);
			
			echo "
			<tr>
				<td>$i</td>
				<td><a href='$website/guild/$name'>$name</a></td>
				<td>$point</td>
			</tr>";
			
		}

		
		echo "</table>";
		
		
		?>

</div>