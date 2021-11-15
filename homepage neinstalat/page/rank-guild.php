<?php
echo "<h3><i class='fas fa-chess-rook'></i> ".$lang['rank_guild_title']."</h3>";

$sql0 = mysqli_query($con, "Select count(*) from $player.guild");
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
		<th>".$lang['rank_guild_name']."</th>
		<th>".$lang['rank_guild_level']."</th>
		<th>".$lang['rank_guild_point']."</th>
		<th>".$lang['rank_guild_leader']."</th>
		<th>".$lang['rank_guild_empire']."</th>
		<!--<th>".$lang['rank_guild_win']."</th>
		<th>".$lang['rank_guild_draw']."</th>
		<th>".$lang['rank_guild_loss']."</th>-->
		";
	
	if(isset($_GET['p'])) $gp = replace('get', 'p'); else $gp = '1';
	$i = ($rowsperpage * $gp)-$rowsperpage;
	
	$sql1 = mysqli_query($con, "Select * from $player.guild ORDER BY ladder_point desc, level desc, exp desc LIMIT $offset, $rowsperpage");
	while ($sql = mysqli_fetch_object($sql1) )
	{
		$i = $i+1;
		$name = $sql->name;
		$level = $sql->level;
		$exp = number_format($sql->exp);
		$ladder_point = number_format($sql->ladder_point);
		$win = number_format($sql->win);
		$draw = number_format($sql->draw);
		$loss = number_format($sql->loss);
		
		$master_id = $sql->master;
		$master = mysqli_fetch_array(mysqli_query($con, "Select name from $player.player where id='$master_id'"));
		$master = $master[0];
		
		$empire = mysqli_fetch_array(mysqli_query($con, "Select empire from $player.player_index where pid1='$master_id' or pid2='$master_id' or pid3='$master_id' or pid4='$master_id'"));
		$empire = $empire[0];
		
		echo "
		<tr>
			<td>$i</td>
			<td><b><a href='$website/guild/$name'>$name</a></b></td>
			<td>$level</td>
			<td>$ladder_point</td>
			<td><b><a href='$website/player/$master'>$master</a></b></td>
			<td><img src='$website/style/$style/img/empire/$empire.jpg'></td>
			<!--<td>$win</td>
			<td>$draw</td>
			<td>$loss</td>-->
		</tr>
		
		
		
		";
	}
		echo "</table>";
echo '<ul class="pagination justify-content-center">';
$range = 3;
 
if ($p > 1) {  
 
  echo "<li class='page-item'><a class='page-link' href='guild&p=1'>&lt;&lt;</a></li>";  

  $prevpage = $p - 1;  

  echo " <li class='page-item'><a class='page-link' href='guild&p=$prevpage'>&lt;</a></li>";  
} 


for ($x = ($p - $range); $x < (($p + $range) + 1); $x++) { 

  if (($x > 0) && ($x <= $totalpages)) {
		

	 if ($x == $p) {  

		echo "<li class='page-item active'><a class='page-link'>$x</a></li>";  

	 } else {  

	echo " <li class='page-item'><a class='page-link' href='guild&p=$x'>$x</a></li>";  
	 }
 
  }
}
		  

if ($p != $totalpages) {  

  $nextpage = $p + 1;  
 
  echo "<li class='page-item'><a class='page-link' href='guild&p=$nextpage'>&gt;</a></li> ";  

  echo "<li class='page-item'><a class='page-link' href='guild&p=$totalpages'>&gt;&gt;</a></li> ";  
}
echo '</ul>';	
} else {
	echo "<small><h5>".$lang['rank_guild_no']."</h5></small>";
}


?>