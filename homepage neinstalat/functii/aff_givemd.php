<?php

$sql0 = mysqli_query($con, "Select * from $web.affiliate where give_md='0'");

while($sql = mysqli_fetch_object($sql0))
{
	$md = get_cfg('aff_md');
	$aff = $sql->aff_token;
	$account_id = $sql->account_id;
	
	$time = mysqli_fetch_array(mysqli_query($con, "Select sum(playtime) from $player.player where account_id='$account_id'"));
	$time = $time[0];
		
	if($time >= 3000)
	{
		mysqli_query($con, "UPDATE $account.account SET `coins`=coins+$md WHERE (`aff_token`='$aff')");
		//mysqli_query($con, "UPDATE $web.affiliate SET `give_md`='1' WHERE (`account_id`='$account_id')");
		echo mysqli_error($con);
		debug();
	}
	

}