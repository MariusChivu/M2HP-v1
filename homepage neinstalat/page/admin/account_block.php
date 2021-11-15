<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_account_block']; ?></li>
	<li class="list-group-item">
<?php
	if($admin_acces['account'] > $_SESSION['admin'])
	{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
	else { 
	
		if($style == 'default')
		{
			echo "<style>
				.left {display: none; }
				.right {display: none; }
				.body {width: 1356px; }
				.content {width: 99%; }
			</style>";
		}
	if(isset($_GET['acc'])) {
		$a = replace('get', 'acc');
		$sql0 = mysqli_query($con, "Select count(*) from $account.account where status!='OK' and id ='$a'");
	} else {
		$sql0 = mysqli_query($con, "Select count(*) from $account.account where status!='OK'");
	}
	
	status_acc();
	
$r = mysqli_fetch_row($sql0);  
$numrows = $r[0];  
 
// Stabileste numarul de linii din tabel afisate in pagina 
$rowsperpage = 20;  
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
	
		echo "<table class='table table-dark'>";
		echo "<th>".$lang['admin_panel_account_id']."</th>";
		echo "<th>".$lang['admin_panel_account_acc']."</th>";
		echo "<th>".$lang['admin_panel_account_name']."</th>";
		echo "<th>".$lang['admin_panel_account_email']."</th>";
		//echo "<th>".$lang['admin_panel_account_create']."</th>";
		echo "<th>".$lang['admin_panel_account_status']."</th>";
		echo "<th>".$lang['admin_panel_account_motiv_ban']."</th>";
		echo "<th>".$lang['admin_panel_account_admin_ban']."</th>";
		echo "<th>".$lang['admin_panel_account_exp_ban']."</th>";
		echo "<th>".$lang['admin_panel_account_ban_unblock']."</th>";
		
	if(isset($_GET['acc'])) {
		$a = replace('get', 'acc');
		$query = mysqli_query($con, "Select * from $account.account where status!='OK' and id ='$a'");
	} else {
		$query = mysqli_query($con, "Select * from $account.account where status!='OK' LIMIT $offset, $rowsperpage");
	}	
		while($sql = mysqli_fetch_object($query) )
		{
			$id = $sql->id;
			$acc = $sql->login;
			$name = $sql->real_name;
			$email = $sql->email;
			$create = $sql->create_time;
			$status = $sql->status;
			$motiv_ban = $sql->motiv_ban;
			$admin_ban = $sql->admin_ban;
			$exp_ban = $sql->exp_ban;
			
			if($motiv_ban == '0') $motiv_ban = '-';
				else $motiv_ban = $motiv_ban;
			if($motiv_ban == 'MAIL_ACTIVATE' && $status != 'OK') { $motiv = $lang['admin_panel_account_motiv_ban_mail']; $admin_ban = '-'; }
			elseif($motiv_ban != 'MAIL_ACTIVATE' && $status != 'OK') $motiv = $motiv_ban;
			elseif($status != 'OK' && $motiv_ban == 'MAIL_ACTIVATE')  $exp_ban = '-';
			elseif($status == 'OK') { $motiv = '-'; $admin_ban = '-'; }
			
			if($status == 'OK' ) $exp_ban = '-';
				else $exp_ban = $exp_ban;
			
			if($status != 'OK' && $motiv_ban == 'MAIL_ACTIVATE')  $exp_ban = '-';
				
			if($status == 'OK') $sts = "<font style='color:#328224; font-weight:bold'>".$lang['admin_panel_account_status_ok']."</font>";
			if($status != 'OK') $sts = "<font style='color:#822424; font-weight:bold'>".$lang['admin_panel_account_status_block']."</font>";
			
			$char = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.player where account_id = '$id'"));
			$char = $char[0];


			if($admin_acces['account_unblock'] >= $_SESSION['admin'] && $status != 'OK' && $motiv_ban != 'MAIL_ACTIVATE') {
				$unblock = "<font style='color:#822424; font-weight:bold'>".$lang['admin_panel_account_ban_unblock_no']."</font>";
			}
			if($admin_acces['account_unblock'] >= $_SESSION['admin'] && $status != 'OK' && $motiv_ban == 'MAIL_ACTIVATE') {
				$unblock = "<font style='color:#822424; font-weight:bold'>".$lang['admin_panel_account_ban_unblock_no']."</font>";
			} 
			 if($admin_acces['account_unblock'] <= $_SESSION['admin'] && $status != 'OK' && $motiv_ban == 'MAIL_ACTIVATE') {
				$unblock = "<font style='color:#822424; font-weight:bold'>".$lang['admin_panel_account_ban_unblock_no']."</font>";
			}
			 if($admin_acces['account_unblock'] <= $_SESSION['admin'] && $status == 'OK' && $motiv_ban != 'MAIL_ACTIVATE') {
				$unblock = '-';
			}
			 if($admin_acces['account_unblock'] <= $_SESSION['admin'] && $status != 'OK' && $motiv_ban != 'MAIL_ACTIVATE') {
				$unblock = "
					<form action='' method='POST'>
						<input type='hidden' name='unblock_id' value='$id'>
						<input type='submit' name='unblock_acc' class='btn btn-success  btn-sm' value='".$lang['admin_panel_account_ban_unblock_btn']."'>
					</form>
				
				";
			}
			
			
			if($admin_acces['account_block'] > $_SESSION['admin'] && $status == 'OK') {
				$block = "<font style='color:#822424; font-weight:bold'>".$lang['admin_panel_account_ban_block_no']."</font>";
			}
			 if($admin_acces['account_block'] <= $_SESSION['admin'] && $status == 'BLOCK') {
				$block = '-';
			}
			 if($admin_acces['account_block'] <= $_SESSION['admin'] && $status == 'OK') {
				$block = "
					<form action='' method='POST' class='input-group-sm'>
						<input type='hidden' name='block_id' value='$id'>
						<input type='text' name='block_motiv'  class='form-control' placeholder='".$lang['admin_panel_account_ban_block_motiv']."' pattern='.{1,}'><br>
						<input type='date' name='block_data'  class='form-control' data-toggle='tooltip' data-placement='left' title='".$lang['admin_panel_account_ban_block_setdata']."'><br>
						<input type='submit' id='submit' name='block_acc' class='btn btn-danger btn-sm' value='".$lang['admin_panel_account_ban_block_btn']."'>
					</form>
				
				";
			}
				
			echo '<tr style="font-weight:bold" title="'.$lang['admin_panel_account_list_char'].'" data-toggle="popover" data-placement="bottom" data-html="true" data-trigger="hover"data-content="';
			
			if($char > '0') {
				$sql_char = mysqli_query($con, "Select * from $player.player where account_id = '$id'");
				while($schar = mysqli_fetch_object($sql_char))
				{
					echo $schar->name.'<br>';
				}
			} else {
			
				$sql_char = mysqli_fetch_object(mysqli_query($con, "Select * from $player.player where account_id = '$id'"));
				if($sql_char)
					$txtchar = $sql_char->name;
				else echo $lang['admin_panel_account_list_char_no'];
			}
			
			echo'"">';
			
			echo "<td>$id</td>";
			echo "<td>$acc</td>";
			echo "<td>$name</td>";
			echo "<td>$email</td>";
			//echo "<td>$create</td>";
			echo "<td>$sts</td>";
			echo "<td>$motiv</td>";
			echo "<td>$admin_ban</td>";
			echo "<td>$exp_ban</td>";
			echo "<td>$unblock</td>";
			echo "</tr>";
			
			
		}
		echo "</table>";
echo '<ul class="pagination justify-content-center">';
$range = 3;
 
if ($p > 1) {  
 
  echo "<li class='page-item'><a class='page-link' href='$website/admin/account/list&p=1'>&lt;&lt;</a></li>";  

  $prevpage = $p - 1;  

  echo " <li class='page-item'><a class='page-link' href='$website/admin/account/list&p=$prevpage'>&lt;</a></li>";  
} 


for ($x = ($p - $range); $x < (($p + $range) + 1); $x++) { 

  if (($x > 0) && ($x <= $totalpages)) {
		

	 if ($x == $p) {  

		echo "<li class='page-item active'><a class='page-link'>$x</a></li>";  

	 } else {  

	echo " <li class='page-item'><a class='page-link' href='$website/admin/account/list&p=$x'>$x</a></li>";  
	 }
 
  }
}
		  

if ($p != $totalpages) {  

  $nextpage = $p + 1;  
 
  echo "<li class='page-item'><a class='page-link' href='$website/admin/account/list&p=$nextpage'>&gt;</a></li> ";  

  echo "<li class='page-item'><a class='page-link' href='$website/admin/account/list&p=$totalpages'>&gt;&gt;</a></li> ";  
}
echo '</ul>';
 } ?>
	</li>
</ul>