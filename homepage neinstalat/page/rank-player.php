<?php
echo "<h3><i class='fas fa-users'></i> ".$lang['rank_player_title']."</h3>";

$sql0 = mysqli_query($con, "SELECT count(*) 
	FROM $player.player 
	LEFT JOIN $player.player_index 
	ON player_index.id=player.account_id 
	LEFT JOIN $player.guild_member 
	ON guild_member.pid=player.id 
	LEFT JOIN $player.guild 
	ON guild.id=guild_member.guild_id 
	INNER JOIN $account.account 
	ON account.id=player.account_id 
	WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'");
$r = mysqli_fetch_row($sql0);  
$numrows = $r[0];  
 
// Stabileste numarul de linii din tabel afisate in pagina 
$rowsperpage = 10;  
$totalpages = ceil($numrows / $rowsperpage);
 

if (isset($_GET['p']) && is_numeric($_GET['p'])) {  

  $p = (int) $_GET['p'];  
} else { 
  $p = 1;  
}
 

if ($p > $totalpages) {  
 
  $p = $totalpages;  
} 

if ($p < 1) {  

  $p = 1;  
} 
 
  
$offset = ($p - 1) * $rowsperpage;  
 

if($numrows != '0')
{
	echo"<table class='table table-striped table-dark'>
		<th>#</th>
		<th>".$lang['rank_player_name']."</th>
		<th>".$lang['rank_player_level']."</th>
		<th>".$lang['rank_player_empire']."</th>
		<th>".$lang['rank_player_guild']."</th>
		";
	
	if(isset($_GET['p'])) $gp = replace('get', 'p'); else $gp = '1';
	$i = ($rowsperpage * $gp)-$rowsperpage;
	
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
	ORDER BY player.level DESC, player.exp DESC LIMIT $offset, $rowsperpage");
	while ($sql = mysqli_fetch_object($sql1) )
	{
		$i = $i+1;
		$name = $sql->name;
		$level = $sql->level;
		$empire = $sql->empire;
		$exp = number_format($sql->exp);
		$guild = $sql->guild_name;
		if($guild == null) $guild = "<td><b>-</b></td>";
		else $guild = "<td><b><a href='$website/guild/$guild'>$guild</a></b></td>";
		
		echo "
		<tr>
			<td>$i</td>
			<td><b><a href='$website/player/$name'>$name</a></b></td>
			<td>$level</td>
			<td><img src='$website/style/$style/img/empire/$empire.jpg'></td>
			$guild
			
		</tr>
		
		
		
		";
	}
		echo "</table>";

echo '<ul class="pagination justify-content-center">';
$range = 3;
 
if ($p > 1) {  
 
  echo "<li class='page-item'><a class='page-link' href='player&p=1'>&lt;&lt;</a></li>";  

  $prevpage = $p - 1;  

  echo " <li class='page-item'><a class='page-link' href='player&p=$prevpage'>&lt;</a></li>";  
} 


for ($x = ($p - $range); $x < (($p + $range) + 1); $x++) { 

  if (($x > 0) && ($x <= $totalpages)) {
		

	 if ($x == $p) {  

		echo "<li class='page-item active'><a class='page-link'>$x</a></li>";  

	 } else {  

	echo " <li class='page-item'><a class='page-link' href='player&p=$x'>$x</a></li>";  
	 }
 
  }
}
		  

if ($p != $totalpages) {  

  $nextpage = $p + 1;  
 
  echo "<li class='page-item'><a class='page-link' href='player&p=$nextpage'>&gt;</a></li> ";  

  echo "<li class='page-item'><a class='page-link' href='player&p=$totalpages'>&gt;&gt;</a></li> ";  
}
echo '</ul>';
		
} else {
	echo "<small><h5>".$lang['rank_player_no']."</h5></small>";
}

?>