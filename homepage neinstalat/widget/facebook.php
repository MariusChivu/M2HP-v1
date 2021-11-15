<div class='widget'>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v3.2&appId=600208757060967&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<?php
	$fb = file_get_contents("config/config_file/facebook.cfg");
	?>
	<div class="fb-page" data-href="https://www.facebook.com/<?php print $fb; ?>/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
		<blockquote cite="https://www.facebook.com/<?php print $fb; ?>/" class="fb-xfbml-parse-ignore">
			<a href="https://www.facebook.com/<?php print $fb; ?>/"></a>
		</blockquote>
	</div>
</div>