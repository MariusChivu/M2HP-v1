<?php

	$query = mysqli_query($con, "Select * from $web.side where side='left' && active ='1'");
	
	while($sql = mysqli_fetch_object($query) )
	{
		$widget = $sql->widget;
		
		include("widget/$widget.php");
		
	}

?>