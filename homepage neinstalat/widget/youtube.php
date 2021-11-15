<div class='widget'>
	<?php
	$yt = file_get_contents("config/config_file/youtube.cfg");
	?>

	<iframe style="width:243;height:138" src="https://www.youtube-nocookie.com/embed/<?php print $yt; ?>" 
	frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
	allowfullscreen></iframe>

</div>