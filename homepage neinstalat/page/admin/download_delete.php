<ul class="list-group">
	<li class="list-group-item active"><?php print $lang['admin_panel_download']; ?></li>
	<li class="list-group-item left-text">
	<?php	
		if($admin_acces['download'] > $_SESSION['admin'])
		{ echo "<div class='alert alert-warning'>".$lang['error_no_admin']."</div>"; }
		else {
			
			if(isset($_GET['del']) && isset($_POST['link_del']))
			{
				$id = replace('get', 'del');
				
				$query = mysqli_query($con, "DELETE FROM $web.download WHERE (`id`='$id')");
				
				mysqli_query($con, "INSERT INTO $web.log_general (`action_lang`, `gm`, `date`) VALUES ('admin_log_general_deletelink', '".$_SESSION['gm']."', NOW())");
				
				if($query)
					echo "<div class='alert alert-success'>".$lang['admin_panel_download_del_success']."</div><br>";
				else
					echo "<div class='alert alert-danger'>".$lang['admin_panel_download_del_danger']."</div><br>";
				
				
			}
			
			
			echo "<table class='table table-dark'>
			<th>#</th>
			<th>".$lang['admin_panel_download_title']."</th>
			<th>".$lang['admin_panel_download_size']."</th>
			<th>".$lang['admin_panel_download_type']."</th>
			<th>".$lang['admin_panel_download_del']."</th>";
			
			$sql0 = mysqli_query($con, "Select * from $web.download");
			$i = 0;
			while($sql = mysqli_fetch_object($sql0))
			{
				$i = $i+1;
				$id = $sql->id;
				$name = $sql->name;
				$size = $sql->size;
				$type = $sql->type;
				
				
				
				echo "
				<tr>
						<form action='$website/admin/download/delete/$id' method='POST'>
					<td>$i</td>
					<td>$name</td>
					<td>$size</td>
					<td>.$type</td>
					<td>
						<input type='submit' name='link_del' class='btn btn-danger' value='".$lang['admin_panel_download_del']."'>	
					</td>
					</form>";
				
			}
			
			echo "</table>";
		}
	?>
	</li>
</ul>