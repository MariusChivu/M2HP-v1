<?php
echo "<h3><i class='fas fa-unlock'></i> ".$lang['safebox_title']."</h3>";

	$id = $_SESSION['id'];
	
if(!isset($_POST['depozit'])) 
{
	echo "<h5>
		".$lang['safebox_text']."
		</h5>";
			
	echo "<form action='' method='POST'>
		<input type='submit' class='btn btn-primary' name='depozit' value='".$lang['safebox_btn']."' >
		</form>";
}
	if(isset($_POST['depozit'])) 
	{
		$sql0 = mysqli_fetch_object(mysqli_query($con, "select * from $account.account where id='$id'"));
		$email = $sql0->email;
				
		$sql = "select * from $account.account where id='$id'" ;
		$query = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($query) == 1)
		{
			$sqlpass1 = mysqli_query($con, "select * from $player.safebox where account_id='$id'");
			$sqlpass = mysqli_fetch_object($sqlpass1);
			$pass = $sqlpass->password;
					
			if($pass == null) { $dep = '000 000'; }
			else { $dep = $pass; }
					
			$to = $email;
			$subiect = $lang['safebox_title'];
			$mesaj = $lang['safebox_mail_text_1']."<br>
					".$lang['safebox_mail_text_2'].": <b>".$dep. "</b>";
			
			mail_corp($to, $subiect, $mesaj);
		}
			
	}
	