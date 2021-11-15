<?php
echo "<h3><i class='fas fa-info'></i><i class='fas fa-question'></i> ".$lang['right_user_panel_accinfo']."</h3>";

echo "<table class='table table-striped table-bordered table-hover table-dark'>";
	$id = $_SESSION['id'];
	$sql0 = mysqli_query($con, "Select * from $account.account where id='$id'");
	
	$sql = mysqli_fetch_object($sql0);
	$account = $sql->login;
	$real_name = $sql->real_name;
	$email = $sql->email;
	$create_time = $sql->create_time;
	$status = $sql->status;
	$motiv_ban = $sql->motiv_ban;
	$unban_data = $sql->unban_data;
	$gm_ban = $sql->admin_ban;
	$aff = $sql->aff_token;
	$del_char = $sql->social_id;
	$md = number_format($sql->coins);
	$jd = number_format($sql->jcoins);
	
	$admin = $_SESSION['admin'];
	
	
	echo "<tr><td>".$lang['info_acc_account']."</td><td>$account</td></tr>";
	echo "<tr><td>".$lang['info_acc_realname']."</td><td>$real_name</td></tr>";
	echo "<tr><td>".$lang['info_acc_email']."</td><td>$email</td></tr>";
	echo "<tr><td>".$lang['info_acc_createtime']."</td><td>$create_time</td></tr>";
	echo "<tr><td>".$lang['info_acc_delchar']."</td><td>$del_char</td></tr>";
	echo "<tr><td>".$lang['info_acc_md']."</td><td>$md</td></tr>";
	echo "<tr><td>".$lang['info_acc_jd']."</td><td>$jd</td></tr>";
	if($status == 'OK') 
	{
		echo "<tr><td>".$lang['info_acc_status']."</td><td style='color: #328224; font-weight: bold;'>".$lang['info_acc_status_activ']."</td></tr>";
	}
	if($status != 'OK' && $motiv_ban == 'MAIL_ACTIVATE') {
		echo "<tr style='color: #822424; font-weight: bold;'><td>".$lang['info_acc_mail_activate']."</td><td></td></tr>";
	}
	if($status != 'OK' && $motiv_ban != 'MAIL_ACTIVATE') {
		echo "<tr style='color: #822424; font-weight: bold;'><td>".$lang['info_acc_status']."</td><td>".$lang['info_acc_status_block']."</td></tr>";
		echo "<tr style='color: #822424; font-weight: bold;'><td>".$lang['info_acc_reason']."</td><td>$motiv_ban</td></tr>";
		echo "<tr style='color: #822424; font-weight: bold;'><td>".$lang['info_acc_ban_gm']."</td><td>$gm_ban</td></tr>";
		echo "<tr style='color: #328224; font-weight: bold;'><td>".$lang['info_acc_unban']."</td><td>$unban_data</td></tr>";

	}
	if($admin > 0) {
		$gm = $_SESSION['gm'];
		echo "<tr style='color: #328224; font-weight: bold;'><td> </td><td> </td></tr>";
		echo "<tr style='color: #328224; font-weight: bold;'><td>".$lang['info_acc_web_admin']."</td><td>$admin</td></tr>";
		echo "<tr style='color: #328224; font-weight: bold;'><td>".$lang['info_acc_gm_char']."</td><td>$gm</td></tr>";
	
	}

echo "</table>";
if($status == 'OK') {
	echo "<div class='alert alert-info' style='font-weight: bold;'>";
	echo $lang['info_acc_aff_text1'].' ';
	echo file_get_contents('config/config_file/aff_md.cfg').' ';
	echo $lang['info_acc_aff_text2']."<br>";
	echo "<input class='form-control' id='aff_link' value='$website/register&aff=$aff' ><br>";
	echo " <button class='btn btn-info' onclick='tcopy(`aff_link`)'>".$lang['info_acc_copy_link']."</button>";
	echo "</div>";
}
	$total_gameplay_yang = mysqli_fetch_array(mysqli_query($con, "Select sum(playtime), sum(gold) from $player.player where account_id='$id'"));
	$playtime = $total_gameplay_yang[0];
		$ore = floor($playtime / 60);
		$minute = $playtime % 60;
	$time = $ore.' '.$lang['info_acc_hour'].' & '.$minute.' '.$lang['info_acc_minute'];
	$gold = number_format($total_gameplay_yang[1]);
	
	$chars = mysqli_fetch_object(mysqli_query($con, "Select * from $player.player_index where id='$id'"));
	if($chars->pid1 != '0') $pid1 = '1'; else $pid1 = '0';
	if($chars->pid2 != '0') $pid2 = '1'; else $pid2 = '0';
	if($chars->pid3 != '0') $pid3 = '1'; else $pid3 = '0';
	if($chars->pid4 != '0') $pid4 = '1'; else $pid4 = '0';
	$char = $pid1+$pid2+$pid3+$pid4.'/4';
	
	$time2 = $gold/2.1;
	$gold2 = $gold/2;
	$char2 = $gold/2.2;
?>

<!-- Styles -->
<style>
#chartdiv {
	width		: 100%;
	height		: 500px;
	font-size	: 11px;
}					
</style>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ {
    "info": "<?php print $lang['info_acc_playtime']; ?>",
	"text": "<?php print $time; ?>",
    "value": <?php print $time2; ?>
  }, {
    "info": "<?php print $lang['info_acc_gold']; ?>",
	"text": "<?php print $gold; ?>",
    "value": <?php print $gold2; ?>
  }, {
    "info": "<?php print $lang['info_acc_chars']; ?>",
	"text": "<?php print $char; ?>",
    "value": <?php print $char2; ?>
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
<div id="chartdiv"></div>	

<script>
function tcopy(x) {
  var copyText = document.getElementById(x);
  copyText.select();
  document.execCommand("copy");
  alert("<?php print $lang['info_acc_copy']; ?>: " + copyText.value);
}
</script>	
	