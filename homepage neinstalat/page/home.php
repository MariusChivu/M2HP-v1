<?php
echo "<h3><i class='fas fa-clipboard-list'></i> ".$lang['news_title']."</h3>";

$sql0 = mysqli_query($con, "select count(*) from $web.news");
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
 

$sql1 = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $web.news"));
$sq = $sql1[0];
if($sq != '0')
{
	$sql1 = mysqli_query($con, "Select * from $web.news order by date desc LIMIT $offset, $rowsperpage");
	while ($sql = mysqli_fetch_object($sql1) )
	{
		$d = strtotime( $sql->date );
		$date = date( 'd-m-Y', $d );
		$titles = $sql->title;
		$text = $sql->text;
		$gm = $sql->gm;
		
		
		echo"
		<div class='news-container'>
			<div class='news-container-title'>
			$titles
			<br><small><i class='fas fa-clock'></i> $date<br>
			<i class='fas fa-user-edit'></i> $gm</small>
			</div>
			
			<div class='news-container-text'>
			$text
			</div>	
		</div>";
		
		
		
	}
		
echo '<ul class="pagination justify-content-center">';
$range = 3;
 
if ($p > 1) {  
 
  echo "<li class='page-item'><a class='page-link' href='index.php?p=1'>&lt;&lt;</a></li>";  

  $prevpage = $p - 1;  

  echo " <li class='page-item'><a class='page-link' href='index.php?p=$prevpage'>&lt;</a></li>";  
} 


for ($x = ($p - $range); $x < (($p + $range) + 1); $x++) { 

  if (($x > 0) && ($x <= $totalpages)) {
		

	 if ($x == $p) {  

		echo "<li class='page-item active'><a class='page-link'>$x</a></li>";  

	 } else {  

	echo " <li class='page-item'><a class='page-link' href='index.php?p=$x'>$x</a></li>";  
	 }
 
  }
}
		  

if ($p != $totalpages) {  

  $nextpage = $p + 1;  
 
  echo "<li class='page-item'><a class='page-link' href='index.php?p=$nextpage'>&gt;</a></li> ";  

  echo "<li class='page-item'><a class='page-link' href='index.php?p=$totalpages'>&gt;&gt;</a></li> ";  
}
echo '</ul>';		
} else {
	echo "<small><h5>".$lang['no_news']."</h5></small>";
}

?>