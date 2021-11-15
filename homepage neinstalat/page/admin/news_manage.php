<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['manage_news_title']; ?></li>
	<li class="list-group-item">
<?php
		if($admin_acces['news'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
				if(isset($_GET['edit']) && isset($_POST['news_update']))
				{
					$id = replace('get','edit');
					$gm = $_SESSION['gm'];
					$title = $_POST['news_title'];
					$text = $_POST['news_text'];
					
					$query  = mysqli_query($con, "UPDATE $web.news SET `date`=NOW(), `title`='$title', `text`='$text', `gm`='$gm' WHERE (`id`='$id')");
					
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `news_title`, `gm`, `date`) VALUES ('admin_log_general_news_update', '$title', '$gm', NOW())");
					if($query)
						echo "<div class='alert alert-success'>".$lang['manage_news_edit_success']."</div><br>";
					else
						echo "<div class='alert alert-danger'>".$lang['manage_news_edit_danger']."</div><br>";
				}
				if(isset($_GET['edit']) && isset($_POST['news_delete']))
				{
					$id = replace('get','edit');
					
					$ntitle = mysqli_fetch_object(mysqli_query($con, "Select * from $web.news where id = '$id'"));
					$ntitle = $ntitle->title;
					
					mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `news_title`, `gm`, `date`) VALUES ('admin_log_general_news_delete', '$ntitle', '".$_SESSION['gm']."', NOW())");
					
					$query  = mysqli_query($con, "DELETE FROM $web.news WHERE (`id`='$id')");
					if($query)
						echo "<div class='alert alert-success'>".$lang['manage_news_del_success']."</div><br>";
					else
						echo "<div class='alert alert-danger'>".$lang['manage_news_del_danger']."</div><br>";
				}
			
			if(isset($_GET['edit']) && isset($_POST['news_edit']))
			{

					$id = replace('get','edit');
					$sql = mysqli_fetch_object(mysqli_query($con, "Select * from $web.news where id='$id'"));
					$gm = $_SESSION['gm'];
					$title = $sql->title;
					$text = $sql->text;
					
				echo "
				<form action='' method='POST'>
					<input class='form-control' name='news_title' placeholder='".$lang['news_add_title2']."' value='$title'><br>
					<textarea name='news_text'>$text</textarea><br>
					<div class='center'><input name='news_update' class='btn btn-primary' type='submit' value='".$lang['manage_news_edit_btn']."'></div>
					
				</form>";
			}
			else
			{
				echo "<table class='table'>
					<th>".$lang['manage_news_title2']."</th>
					<th>".$lang['manage_news_gm']."</th>
					<th>".$lang['manage_news_edit']."</th>
					<th>".$lang['manage_news_del']."</th>
					";
				$sql1 = mysqli_query($con, "Select * from $web.news order by date desc");
				while($sql = mysqli_fetch_object($sql1))
				{
					$id = $sql->id;
					$d = strtotime( $sql->date );
					$date = date( 'd-m-Y', $d );
					$title = $sql->title;
					$gm = $sql->gm;
					
					$edit = "<form action='$website/admin/news/manage/$id' method='POST'><input type='submit' name='news_edit' class='btn btn-primary' value='".$lang['manage_news_edit_btn']."'></form>";
					$del = "<form action='$website/admin/news/manage/$id' method='POST'><input type='submit' name='news_delete' class='btn btn-danger' value='".$lang['manage_news_del_btn']."'></form>";
					
					echo "
					<tr>
						<td>$title</td>
						<td>$gm</td>
						<td>$edit</td>
						<td>$del</td>
					</tr>";
					
				}
				
				echo "</table>";
				
			}
		}
?>
	</li>
</ul>