<?php if(!isset($_SESSION['user'])) { ?>

<form class="form-inline" action="<?php print $_SERVER['REQUEST_URI']; ?>" method='POST'>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class='fa fa-user'></i></span>
		 </div>
		 <input type="text" name='user' class="form-control" placeholder="<?php print $lang['user']; ?>" pattern='.{5,16}' maxlength='16'>
		  
		<div class="input-group-prepend">
			<span class="input-group-text"><i class='fa fa-lock'></i></span>
		 </div>
		<input type="password" name='pass' class="form-control" placeholder="<?php print $lang['pass']; ?>" pattern='.{5,16}' maxlength='16'>
		<button type="submit" class='btn' name='connect'><i class="fas fa-sign-in-alt"></i></button>
	</div> 
</form>
<?php } ?>
<form>
		<?php  if(isset($_SESSION['user'])) {
			$id = $_SESSION['id'];
			$sqlmd = mysqli_fetch_object(mysqli_query($con, "Select * from $account.account where id='$id'"));
		echo $_SESSION['name']." (".number_format($sqlmd->coins).' '.$lang['md'].")";
		echo "<a href='$website/logout'><i class='fas fa-sign-out-alt'></i> </a>";
		}	?>
</form>
<div class="form-inline">
	

	<a href='<?php echo $website; ?>/index.php'><i class="fas fa-home"></i> <?php print $lang['home']; ?></a>


	<?php  
	$register = file_get_contents('config/config_file/register.cfg');
	if(!isset($_SESSION['user']) && $register == '1') {
		echo "<a href='$website/register'><i class='fas fa-user-plus'></i> ".$lang['register']."</a>";
	}	
	if(filesize("page/presentation.php") != '0')
		echo "<a href='$website/presentation'><i class='fas fa-file-alt'></i> ".$lang['presentation']."</a>";
	
	?>	
	<!-- LANG -->
	<div class="dropdown">
		  <a href="#" class="menu-link"><span class="fa fa-globe-americas"></span> <?php print lang_name($_COOKIE['lang']); ?></a>
		  <div class="dropdown-content">
			<?php
			$select_lang = "lang/*.lang";
				foreach (glob("lang/*.lang") as $filename)
				{
					
					$lng = basename($filename, ".lang");
					print "<a class='menu-link' href='$website/?lang=$lng'>".lang_name($lng)."</a>";
				}
		   ?>
		  </div>
	</div>	
</div>

