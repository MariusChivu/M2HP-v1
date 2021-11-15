<?php
echo "<h3><i class='fas fa-user-plus'></i> ".$lang['aff_title']."</h3>";

	$aff = $_SESSION['aff'];
$sql0 = mysqli_query($con, "Select * from $web.affiliate where aff_token='$aff'");

while($sql = mysqli_fetch_object($sql0))
{
	$account_id = $sql->account_id;
	$give_md = $sql->give_md;
	
	$count = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.player where account_id='$account_id'"));
	$count = $count[0];
	if($count != '0') {
	
		echo "<table class='table table-dark'>";
		echo "<th>".$lang['aff_name']."</th>";
		echo "<th>".$lang['aff_time']."</th>";
		
		$query = mysqli_query($con, "Select * from $player.player where account_id='$account_id'");	
		while($sql = mysqli_fetch_object($query))
		{
			
			$name = $sql->name;
			$playtime = $sql->playtime;
				$ore = floor($playtime / 60);
				$minute = $playtime % 60;
			$time = $ore.' '.$lang['info_acc_hour'].' & '.$minute.' '.$lang['info_acc_minute'];	
			
			$total_time = mysqli_fetch_array(mysqli_query($con, "Select sum(playtime) from $player.player where account_id='$account_id'"));	
			$total_time = $total_time[0];
				$ore = floor($total_time / 60);
				$minute = $total_time % 60;
			$total_time = $ore.' '.$lang['info_acc_hour'].' & '.$minute.' '.$lang['info_acc_minute'];

			
			echo "<tr><td><a href='$website/player/$name'>$name</a></td><td>$time</td></tr>";

			
		}

		echo "<tr style='font-weight: bold'><td>".$lang['aff_time_total']."</td><td>$total_time</td></tr>";
		
		echo "</table>";
		
		if($give_md == '1')
		{
			echo "<table class='table table-dark' style='margin-top: -16px;'>";
			echo "<tr style='font-weight: bold;color: #328224'><td>".$lang['aff_give_md']."</td></tr>";
			echo "</table>";
		}
	}
}