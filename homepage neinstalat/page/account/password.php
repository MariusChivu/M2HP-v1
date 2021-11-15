<?php
echo "<h3><i class='fas fa-user-lock'></i> ".$lang['pass_title']."</h3>";

if(!isset($_GET['key'])) {
	if(!isset($_POST['changepass'])) {
	echo "<h5>".$lang['pass_text']."
		<form action='' method='POST'>
		<input class='btn btn-info' name='changepass' type='submit' value='".$lang['mail_send_btn']."'>
		</form></h5>";
	}

	if(isset($_POST['changepass']))
	{
		$to = $_SESSION['mail'];
		$subiect = $lang['pass_title'];
		
		$key = md5(rand(1,9999));
		$link = $website."/account/password&$key";
		
		$mesaj = $lang['pass_mail_text']."<br>
		<a href='$link'>".$lang['pass_btn']."</a>";
		
		$id = $_SESSION['id'];
		mysqli_query($con, "UPDATE $account.account SET `token_pw`='$key' WHERE (`id`='$id')");

		mail_corp($to, $subiect, $mesaj);
	}

}

if(isset($_GET['key']))
{
	$key = replace('get', 'key');
	$id = $_SESSION['id'];
	
	$sql = mysqli_fetch_object(mysqli_query($con, "Select * from $account.account where id='$id'"));
	
	$token = $sql->token_pw;
	
	if($key != $token or $token == '0')
	{
		echo "<div class='alert alert-danger'>".$lang['pass_error_token']."</div>";
	} else {
		if(!isset($_POST['pass'])) {
		echo "<h5>
			<form action='' method='POST'>
			<input class='form-control' type='password' name='new_pass' placeholder='".$lang['pass_change_text']."' pattern='.{5,16}' maxlength='16'><br>
			<input class='btn btn-info' name='pass' type='submit' value='".$lang['pass_btn']."'>
			</form></h5>";
		}
			if(isset($_POST['pass']))
			{
				$pass = replace('post', 'new_pass');
				$id = $_SESSION['id'];
				
				$sql = mysqli_query($con, "UPDATE $account.account SET `password`=PASSWORD('$pass'), `token_pw`='0' WHERE (`id`='$id')");
				if($sql) { echo "<div class='alert alert-success'>".$lang['pass_success']."</div>"; }
				else { echo "<div class='alert alert-danger'>".$lang['pass_error']."</div>"; }
			}
	}
	
}