<?php
echo "<h3><i class='fas fa-user-plus'></i> ".$lang['register_title']."</h3>";

if(isset($_SESSION['user'])) {
	echo "<div class='alert alert-danger'>".$lang['register_logout']."</div>";
} else {
	
$register = file_get_contents('config/config_file/register.cfg');
if($register != '1') {
	echo "<div class='alert alert-warning'>".$lang['register_disable']."</div>";
} else {
		
if(isset($_POST['register']))
{
	if(isset($_POST['register']) && $_POST['captcha'] == null ) {
		echo "<div class='alert alert-danger'>
			".$lang['register_no_captcha']."
			</div>";
	}		
	else if(isset($_POST['register']) && $_POST['captcha'] != $_SESSION['captcha']['code'] ) {
		echo "<div class='alert alert-danger'>
			".$lang['register_err_captcha']."
			</div>";
	}
	else if(isset($_POST['register']) && $_POST['captcha'] == null  or $_POST['realname'] == null  
	or $_POST['user'] == null  or $_POST['pass'] == null or $_POST['pass2'] == null 
	or $_POST['mail'] == null or $_POST['delchar'] == null ) {
		echo "<div class='alert alert-danger'>
			".$lang['register_empty_input']."
			</div>";
	}		
	else if(isset($_POST['register']) && $_POST['captcha'] == $_SESSION['captcha']['code'] ) 
	{
		$name = replace('post', 'realname');
		$user = replace('post', 'user');
		$pass = replace('post', 'pass');
		$pass2 = replace('post', 'pass2');
		$mail = replace('post', 'mail');
		$delchar = replace('post', 'delchar');
		
		$sql_user = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where login='$user'"));
		$sql_user = $sql_user[0];
		
		if($sql_user > '0') {
			$err_user = '1';
			echo "<div class='alert alert-danger'>
				".$lang['register_exist_user']."
				</div>";
		} else { $err_user = '0'; }
		
		$sql_mail = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where email='$mail'"));
		$sql_mail = $sql_mail[0];
			
		if($sql_mail > '0') {
			$err_mail = '1';
			echo "<div class='alert alert-danger'>
				".$lang['register_exist_mail']."
				</div>";
		} else { $err_mail = '0'; } 

		if($pass != $pass2) {
			$err_pass = '1';
			echo "<div class='alert alert-danger'>
				".$lang['register_err_pass']."
				</div>";
		} else { $err_pass = '0'; } 
		
		$err = $err_user + $err_mail + $err_pass;
		
		if($err == '0') {
			
			$aff = md5($name.$mail);
			
			$register_mail = file_get_contents('config/config_file/register_mail.cfg');
			if($register_mail == '1') {
				$mail_activation = md5(rand(1,99999));
				$sts = 'BLOCK';
				$motiv_ban = 'MAIL_ACTIVATE';
			} else {
				$mail_activation = '0';
				$sts = 'OK';
				$motiv_ban = '0';
			}
				
			$query = mysqli_query($con, "INSERT INTO $account.account 
			(`login`, `password`, `real_name`, `social_id`, `email`, `status`, `motiv_ban`, `mail_activation`, `aff_token`, `create_time`) VALUES 
			('$user', PASSWORD('$pass'), '$name', '$delchar', '$mail', '$sts', '$motiv_ban', '$mail_activation', '$aff', NOW())");
			
			if($query) {
			echo "<div class='alert alert-success'>
				".$lang['register_success']."
				</div>";
				
				if(isset($_GET['aff']))
				{
					$aff = replace('get', 'aff');
					$sql_id = mysqli_fetch_array(mysqli_query($con, "Select id from $account.account where login='$user' and email='$mail'"));
					$sql_id = $sql_id[0];
					mysqli_query($con, "INSERT INTO $web.affiliate (`aff_token`, `account_id`) VALUES ('$aff', '$sql_id')");
				
				}
				
				if($register_mail == '1') {
					echo "<div class='alert alert-warning'>
						".$lang['register_success_mail']."
						</div>";
						
					$to = $mail;
					$subiect = $lang['register_success_mail_title_activate'].' - '.$title;

					$link = $website."/account/activate&$mail&$mail_activation";
					
					$mesaj = "<b>".$name.'</b> '.$lang['register_success_mail_text_1']." <b>$title</b><br>
					<br>
					".$lang['register_success_mail_text_2']."<br><br>
					".$lang['register_success_mail_text_3'].": $user<br>
					".$lang['register_success_mail_text_4'].": $mail<br>
					".$lang['register_success_mail_text_5'].": 000 000<br>
					".$lang['register_success_mail_text_6'].": $delchar<br>
					<br>
					<p style='color: #c31717;font-weight: bold'>".$lang['register_success_mail_text_7']."<br>
					".$lang['register_success_mail_text_8']."</p>
					<br>
					".$lang['register_success_mail_text_9']."<br>
					<a href='$link'>".$lang['register_success_mail_text_btn']."</a>";

					mail_corp($to, $subiect, $mesaj);
				} else {
						
					$to = $mail;
					$subiect = $lang['register_success_mail_title'].' - '.$title;

					$link = $website."/account/activate&$mail&$mail_activation";
					
					$mesaj = "<b>".$name.'</b> '.$lang['register_success_mail_text_1']." <b>$title</b><br>
					<br>
					".$lang['register_success_mail_text_2']."<br><br>
					".$lang['register_success_mail_text_3'].": $user<br>
					".$lang['register_success_mail_text_4'].": $mail<br>
					".$lang['register_success_mail_text_5'].": 000 000<br>
					".$lang['register_success_mail_text_6'].": $delchar<br>
					<br>
					<p style='color: #c31717;font-weight: bold'>".$lang['register_success_mail_text_7']."<br>
					".$lang['register_success_mail_text_8']."</p>";

					mail_corp($to, $subiect, $mesaj);
	
				}
			} else {
			echo "<div class='alert alert-danger'>
				".$lang['register_danger']."
				</div>";
				echo mysqli_error($con);
			}
		}
		
	}
}
		include 'config/captcha/simple-php-captcha.php';
		
		$_SESSION['captcha'] = simple_php_captcha();	
		
	echo "<form action='' method='POST'>
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-user'></i></span>
		 </div>
		<input class='form-control' name='realname' type='text' placeholder='".$lang['register_realname']."' value='".$_POST['realname']."' pattern='.{5,16}' maxlength='16'>
	</div>
	
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-user-lock'></i></span>
		 </div>
		<input class='form-control' name='user' type='text' placeholder='".$lang['register_user']."' value='".$_POST['user']."' pattern='.{5,16}' maxlength='16'><br>
	</div>
	
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-lock'></i></span>
		 </div>
		<input class='form-control' name='pass' type='password' placeholder='".$lang['register_pass']."' pattern='.{5,16}' maxlength='16'>
	</div>
	
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-lock'></i></span>
		 </div>
		<input class='form-control' name='pass2' type='password' placeholder='".$lang['register_pass_re']."' pattern='.{5,16}' maxlength='16'>
	</div>
	
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-envelope'></i></span>
		 </div>
		<input class='form-control' name='mail' type='text' placeholder='".$lang['register_email']."' value='".$_POST['mail']."' pattern='.{5,64}' maxlength='64'>
	</div>
	
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<span class='input-group-text'><i class='fa fa-user-minus'></i></span>
		 </div>
		<input class='form-control' name='delchar' type='text' placeholder='".$lang['register_delchar']."' value='".$_POST['delchar']."' pattern='.{7,7}' maxlength='7'>
	</div>
	<br><div class='input-group'>
		<div class='input-group-prepend'>
			<img src='".$_SESSION['captcha']['image_src']."' style='height:45px;'>
		</div>
		<input AUTOCOMPLETE='off' type='text' style='height:45px;' class='form-control' name='captcha' pattern='.{4,6}' maxlength='5' placeholder='".$lang['register_captcha']."'>
	</div>
	
	<br><div class='center'>
		<input class='btn btn-primary' type='submit' name='register' value='".$lang['register_btn']."'>
	</div>
	

	</form>";
	
	
	
}

}
?>