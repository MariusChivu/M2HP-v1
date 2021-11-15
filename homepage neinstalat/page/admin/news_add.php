<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['news_add_title']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['news'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_POST['news_add']))
			{
				$gm = $_SESSION['gm'];
				$title = $_POST['news_title'];
				$text = $_POST['news_text'];
				
				$query  = mysqli_query($con, "INSERT INTO $web.news (`title`, `text`, `gm`) VALUES ('$title', '$text', '$gm')");
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `news_title`, `gm`, `date`) VALUES ('admin_log_general_news_add', '$title', '$gm', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['news_add_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['news_add_danger']."</div><br>";
			}
			
			echo "
			<form action='' method='POST'>
				<input class='form-control' name='news_title' placeholder='".$lang['news_add_title2']."'><br>
				<textarea name='news_text'></textarea><br>
				<div class='center'><input name='news_add' class='btn btn-primary' type='submit' value='".$lang['news_add_btn']."'></div>
				
			</form>";
			
		}
?>
	</li>
</ul>