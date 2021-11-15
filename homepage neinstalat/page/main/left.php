
<div class='widget'>
	<div class='title'>
		<?php print $lang['general_title']; ?>
	</div>
<?php
		$mod = file_get_contents('config/config_file/game_mod.cfg');
		$level = file_get_contents('config/config_file/max_level.cfg');
		$exp = file_get_contents('config/config_file/exp.cfg');
		$drop = file_get_contents('config/config_file/drop.cfg');
		$yang = file_get_contents('config/config_file/yang.cfg');
		$open = file_get_contents('config/config_file/open.cfg');
		
		$online5 = file_get_contents('config/config_file/online_5min.cfg');
		$online24 = file_get_contents('config/config_file/online_24h.cfg');
		
		$o5 = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) FROM $player.player WHERE DATE_SUB(NOW(), INTERVAL 5 MINUTE) < last_play;"));
		$o5 = number_format($o5[0]);
		if($o5 >= 1) {
			$o5 = $o5;
		} else {
			$o5 = '0';
		}

		$o24 = mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) FROM $player.player WHERE DATE_SUB(NOW(), INTERVAL 24 HOUR) < last_play;"));
		$o24 = number_format($o24[0]);
		if($o24 >= 1) {
			$o24 = $o24;
		} else {
			$o24 = '0';
		}		
		
		echo "<table class='table'>
		<tr><td>".$lang['general_gamemod']."</td><td>$mod</td></tr>
		<tr><td>".$lang['general_maxlevel']."</td><td>$level</td></tr>
		<!--<tr><td>".$lang['general_rate_exp']."</td><td>$exp</td></tr>
		<tr><td>".$lang['general_rate_drop']."</td><td>$drop</td></tr>
		<tr><td>".$lang['general_rate_yang']."</td><td>$yang</td></tr>-->";
		
		if($online5 == '1') echo "<tr><td>".$lang['general_online_5']."</td><td>$o5</td></tr>";
		if($online24 == '1') echo "<tr><td>".$lang['general_online_24']."</td><td>$o24</td></tr>";
		
		
		echo "</table>";
		echo "<table class='table'><tr><td>".$lang['general_open']." $open</td></tr></table>";

?>
<style>
#chartdiv3 {
  width: 100%;
  height: 240px;
}					
</style>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv3", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "info": "<?php print $lang['general_rate'].'<br>'.$lang['general_rate_exp']; ?>",
	"text": "<?php print $exp.'%'; ?>",
    "value": <?php print $exp; ?>
  }, {
    "info": "<?php print $lang['general_rate'].'<br>'.$lang['general_rate_drop']; ?>",
	"text": "<?php print $drop.'%'; ?>",
    "value": <?php print $drop; ?>
  }, {
    "info": "<?php print $lang['general_rate'].'<br>'.$lang['general_rate_yang']; ?>",
	"text": "<?php print $yang.'%'; ?>",
    "value": <?php print $yang; ?>
  }

  ],
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[text]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "value",
	"labelText": "[[text]]",
	"showBalloon": true
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "info",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 20
  },
  "export": {
    "enabled": true
  }

} );
</script>


<!-- HTML -->
<div id="chartdiv3"></div>


<?php
echo "</div>";

include("functii/widget_leftside.php");
?>
