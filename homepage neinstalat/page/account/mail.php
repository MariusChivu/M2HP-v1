<?php
echo "<h3><i class='fas fa-envelope'></i> ".$lang['mail_title']."</h3>";

if(!isset($_GET['key'])) {
	if(!isset($_POST['changemail'])) {
	echo "<h5>".$lang['mail_text']."
		<form action='' method='POST'>
		<input class='btn btn-info' name='changemail' type='submit' value='".$lang['mail_send_btn']."'>
		</form></h5>";
	}

	if(isset($_POST['changemail']))
	{
		$to = $_SESSION['mail'];
		$subiect = $lang['mail_title'];
		
		$key = md5(rand(1,9999));
		$link = $website."/account/mail&$key";
		
		$mesaj = $lang['mail_mail_text']."<br>
		<a href='$link'>".$lang['mail_btn']."</a>";
		
		$id = $_SESSION['id'];
		mysqli_query($con, "UPDATE $account.account SET `token_email`='$key' WHERE (`id`='$id')");

		mail_corp($to, $subiect, $mesaj);
	}

}

if(isset($_GET['key']))
{
	$key = replace('get', 'key');
	$id = $_SESSION['id'];
	
	$sql = mysqli_fetch_object(mysqli_query($con, "Select * from $account.account where id='$id'"));
	
	$token = $sql->token_email;
	
	if($key != $token or $token == '0')
	{
		echo "<div class='alert alert-danger'>".$lang['mail_error_token']."</div>";
	} else {
		if(!isset($_POST['mail'])) {
		echo "<h5>
			<form action='' method='POST'>
			<input class='form-control' type='text' name='new_mail' placeholder='".$lang['mail_change_text']."' pattern='.{5,64}' maxlength='64'><br>
			<input class='btn btn-info' name='mail' type='submit' value='".$lang['mail_btn']."'>
			</form></h5>";
		}
			if(isset($_POST['mail']))
			{
				$mail = replace('post', 'new_mail');
				$id = $_SESSION['id'];
				
				$sql = mysqli_query($con, "UPDATE $account.account SET `email`='$mail', `token_email`='0' WHERE (`id`='$id')");
				if($sql) { echo "<div class='alert alert-success'>".$lang['mail_success']."</div>"; }
				else { echo "<div class='alert alert-danger'>".$lang['mail_error']."</div>"; }
			}
	}
	
}