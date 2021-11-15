<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['presentation']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['presentation'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			if(isset($_POST['update_text']))
			{
				$text = $_POST['text'];
				$update = file_put_contents('page/presentation.php', $text);
				
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_presentation_update', '".$_SESSION['gm']."', NOW())");
				if($update)
					echo "<div class='alert alert-success'>".$lang['admin_panel_presentation_update_success']."</div>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_presentation_update_danger']."</div>";
				
			}
			
			if(isset($_POST['del_text']))
			{
				$text = '';
				$update = file_put_contents('page/presentation.php', $text);
				
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_presentation_delete', '".$_SESSION['gm']."', NOW())");
				
				if($update)
					echo "<div class='alert alert-danger'>".$lang['admin_panel_presentation_delete_danger']."</div>";
				else
					echo "<div class='alert alert-success'>".$lang['admin_panel_presentation_delete_success']."</div>";
				
			}
			
			echo "<form action='' method='POST'>
			<textarea name='text'>
			".file_get_contents('page/presentation.php')."
			</textarea><br>
			<div class='center'>
			<input type='submit' name='update_text' class='btn btn-success' value='".$lang['admin_panel_presentation_update']."'> 
			<input type='submit' name='del_text' class='btn btn-danger' value='".$lang['admin_panel_presentation_delete']."'>
			</div>
			
			";
			
			
			
			
			
			
		}
?>
	</li>
</ul>