<?php
	if($admin_acces['coins'] > $_SESSION['admin'])
	{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
	else { 
	
	if(isset($_POST['add_coins']))
	{
		$id = replace('post', 'accid');
		$md = replace('post', 'md');
		$jd = replace('post', 'jd');
		$gm = $_SESSION['gm'];
		
		if($md == '') $md ='0';
		if($jd == '') $jd ='0';
		
		$query = mysqli_query($con, "Update $account.account set coins=coins+$md, jcoins=jcoins+$jd where id='$id'");
		
		if($query)
		{
			echo "<div class='alert alert-success'>".$lang['admin_panel_coins_success']."</div>";
		mysqli_query($con, "INSERT INTO $web.log_coins (`gm`, `id_account`, `md`, `jd`, `date`) VALUES ('$gm', '$id', '$md', '$jd', NOW())");
		} else {
			echo "<div class='alert alert-danger'>".$lang['admin_panel_coins_danger']."</div>";
		}
		
		
	}

	?>
<form action='<?php print $website; ?>/admin/coins' method='POST'>
<ul class="list-group">
	
	
	
		<li class="list-group-item active"><?php print $lang['admin_panel_coins_title']; ?></li>
		<li class="list-group-item left-text">
			
		
			<input type="number" name="accid" class='form-control' placeholder='<?php print $lang['admin_panel_coins_id']; ?>'><br>
			<input type="number" name="md" class='form-control' placeholder='<?php print $lang['admin_panel_coins_md']; ?>'><br>
			<input type="number" name="jd" class='form-control' placeholder='<?php print $lang['admin_panel_coins_jd']; ?>'><br>

			
		</li>
</ul>
	<br><div class='center'>
		<input type='submit' class='btn btn-info' name='add_coins' value='<?php print $lang['admin_panel_admins_add_btn']; ?>'>
	</div>
</form>
<?php } ?>