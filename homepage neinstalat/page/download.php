<?php
echo "<h3><i class='fas fa-download'></i> ".$lang['download_title']."</h3>";
$sql1 = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $web.download"));
$sq = $sql1[0];
if($sq != '0')
{
	$sql1 = mysqli_query($con, "Select * from $web.download");
	while ($sql = mysqli_fetch_object($sql1) )
	{
		
		$name = $sql->name;
		$link = $sql->link;
		$size = $sql->size;
		$type = $sql->type;
		
		echo "<div class='download'>";
		echo "<a href='$link'><img src='https://icons.mariuschivu.ro/$type.png' height='100' width='100'/></a><br>";
		echo $name.'<br>';
		echo $lang['size'].': '.$size;
		echo "</div>";
		
	}
} else {
	echo "<small><h5>".$lang['no_download']."</h5></small>";
}

?>

<h3><?php print $lang['important']; ?></h3>
		<p><?php print $lang['msj_important_download']; ?></p>

			

			<table class='table table-dark'>
				<thead>
					<tr>
						<th><?php print $lang['cerinte_sistem']; ?></th>
						<th><?php print $lang['cerinte_minime']; ?></th>
						<th><?php print $lang['cerinte_recomandate']; ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php print $lang['cerinte_procesor']; ?></td>
						<td>Pentium 3 1 GHz</td>
						<td>Pentium 4 1.8 GHz</td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_ram']; ?></td>
						<td>512 MB</td>
						<td>1 GB</td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_spatiu']; ?></td>
						<td>2 GB</td>
						<td>3 GB</td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_video']; ?></td>
						<td>32 MB</td>
						<td>64 MB</td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_windows']; ?></td>
						<td colspan="2">Windows Vista, 7, 8, 8.1, 10</td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_sunet']; ?></td>
						<td colspan="2"><?php print $lang['cerinte_sunet_cerinta']; ?></td>
					</tr>
					<tr>
						<td><?php print $lang['cerinte_periferice']; ?></td>
						<td colspan="2"><?php print $lang['cerinte_periferice_cerinta']; ?></td>
					</tr>
				</tbody>
			</table>