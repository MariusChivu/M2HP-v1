<div class='login-bar'>
	<div class='inside-login-bar'>
		<?php 
			include("style/$style/login-bar.php"); 
		?>
	</div>
</div>


<div class='body'>
	<!-- LEFT-WIDGET-BAR -->
	<div class='left'>
		<div class='title-bar'>
			<?php echo $lang['right_title']; ?>
		</div>
		<?php include("page/main/left.php"); ?>
	</div>
	
	<!-- CONTENT -->
	<div class='content'>
		<div class='title-bar'>
			<?php include("page/main/menu.php"); ?>
		</div>
		<?php content(); ?>
	</div>
	
	<!-- RIGHT-WIDGET-BAR -->
	<div class='right'>
		<div class='title-bar'>
			<?php echo $lang['right_title']; ?>
		</div>
		<?php include("page/main/right.php"); ?>
	</div>
	
	<!-- BOTTOM -->
	<div class='bottom'>
		<?php include("page/main/bottom.php"); ?>
	</div>

</div><!-- END BODY -->

