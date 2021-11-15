<div class='widget'>
	<div class='title'>
		<?php print $lang['account_stats_title']; ?>
	</div>
	<?php
		$acc = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account"));
		$acc = $acc[0];
		
		$char = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.player"));
		$char = $char[0];
		
		$guild = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $player.guild"));
		$guild = $guild[0];
		
		$acc_ok = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where status ='OK'"));
		$acc_ok = $acc_ok[0];
		
		$acc_block = mysqli_fetch_array(mysqli_query($con, "Select count(*) from $account.account where status !='OK'"));
		$acc_block = $acc_block[0];
		
		/*echo "<table class='table'>
		<tr><td>".$lang['account_stats_account']."</td><td>$acc</td></tr>
		<tr><td>".$lang['account_stats_char']."</td><td>$char</td></tr>
		<tr><td>".$lang['account_stats_guild']."</td><td>$guild</td></tr>
		<tr><td>".$lang['account_stats_acc_ok']."</td><td>$acc_ok</td></tr>
		<tr><td>".$lang['account_stats_acc_block']."</td><td>$acc_block</td></tr>
		</table>";*/
	
	?>

<style>
#chartdiv2 {
  width: 100%;
  height: 270px;
}						
</style>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv2", {
  "type": "serial",
     "theme": "light",
  "categoryField": "info",
  "rotate": true,
  "startDuration": 1,
  "categoryAxis": {
    "gridPosition": "start",
    "position": "left"
  },
  "trendLines": [],
  "graphs": [
    {
      "balloonText": "[[category]]: <b>[[value]]</b>",
      "fillAlphas": 0.8,
      "id": "AmGraph-1",
      "lineAlpha": 0.2,
      "title": "Income",
      "type": "column",
      "valueField": "value",
	  "labelText": "[[value]]",
	  "showBalloon": true
    }
  ],
  "guides": [],
  "valueAxes": [
    {
      "id": "ValueAxis-1",
      "position": "top",
      "axisAlpha": 0
    }
  ],
  "allLabels": [],
  "balloon": {},
  "titles": [],
  "dataProvider": [
    {
    "info": "<?php print $lang['account_stats_account']; ?>",
    "value": <?php print $acc; ?>
  }, {
    "info": "<?php print $lang['account_stats_char']; ?>",
    "value": <?php print $char; ?>
  }, {
    "info": "<?php echo $lang['account_stats_account'].'<br>'.$lang['account_stats_acc_ok']; ?>",
    "value": <?php print $acc_ok; ?>
  }, {
    "info": "<?php echo $lang['account_stats_account'].'<br>'.$lang['account_stats_acc_block']; ?>",
    "value": <?php print $acc_block; ?>
  }
  ],
    "export": {
    	"enabled": true
     }

});
</script>

<!-- HTML -->
<div id="chartdiv2"></div>		


</div>
