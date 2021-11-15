<?php
echo "<h3><i class='fas fa-unlock'></i> ".$lang['activ_title']."</h3>";

if(!isset($_GET['mail']) or !isset($_GET['key']))
{
	echo "<div class='alert alert-danger'>".$lang['activ_error']."</div>";
} else {
	if(!isset($_COOKIE['lang'])) { }
	else {
		$mail = replace('get', 'mail');
		$key = replace('get', 'key');
		
		$count = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where email='$mail' and mail_activation='$key'"));
		$count = $count[0];
		
		if($count != '0')
		{
			
			$query = mysqli_query($con, "UPDATE $account.account SET `status`='OK', `motiv_ban`='0', `mail_activation`='0' WHERE email='$mail' and mail_activation='$key'");
			if($query)
			{
				echo "<div class='alert alert-success'>".$lang['activ_success']."</div>";
			} else {
				echo "<div class='alert alert-danger'>".$lang['activ_danger']."</div>";
			}
		} else {
			echo "<div class='alert alert-danger'>".$lang['activ_err_mail_key']."</div>";
		}
	}

}