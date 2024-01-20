<?php
//ini_set('display_errors', 1);
include(dirname(__FILE__).'/header.php');
include(dirname(dirname(__FILE__))  . "/objects/class_userdetails.php");
include(dirname(dirname(__FILE__))  . "/objects/class_booking.php");
include(dirname(dirname(__FILE__))  . '/objects/class_front_first_step.php');

$con = new cleanto_db();
$conn = $con->connect();
$objuserdetails = new cleanto_userdetails();
$objuserdetails->conn = $conn;
$booking = new cleanto_booking();
$booking->conn = $conn;
$setting = new cleanto_setting();
$setting->conn = $conn;
$general=new cleanto_general();
$general->conn=$conn;
$first_step=new cleanto_first_step();
$first_step->conn=$conn;

$order_id = $_GET['booking'];

$details = $objuserdetails->get_timer_details($order_id);
$timer = mysqli_fetch_array($details);

if ($timer['order_id'] == '') {
	$query="insert IGNORE into ct_bookings_timer (order_id, order_date) values ('".$order_id."',now())";
  mysqli_query($objuserdetails->conn,$query);
	if ($_GET['game'] == 1) $game = 'The Order Of The 9';
	if ($_GET['game'] == 2) $game = 'Bunker 51';
	if ($_GET['game'] == 3) $game = 'Forgotten Temple';
	$query ="insert into admin_logs values ('', '".$_SESSION['adminid']."', 'Game ".$order_id." (".$game.") started...', now())";
  mysqli_query($objuserdetails->conn,$query);
	$uptime = time();
	
	$alreadypaid = 0;
 	$player_query="select * from ct_payments where order_id = '".$order_id."'";
  $players_update = mysqli_query($objuserdetails->conn,$player_query);
  while ($playerss = mysqli_fetch_array($players_update)) {
  	$alreadypaid = $alreadypaid + $playerss['partial_amount'];                       		 
  }
                                                    	
  $player_query="select * from ct_payment_breakdown where order_id = '".$order_id."'";
  $players_update = mysqli_query($objuserdetails->conn,$player_query);
	while ($playerss = mysqli_fetch_array($players_update)) {
  	$alreadypaid = $alreadypaid + $playerss['amount'];                       		 
  }
		
	$query ="select * from ct_payments where order_id = '".$order_id."'";
  $theresult = mysqli_query($objuserdetails->conn,$query);
  while($rdd = mysqli_fetch_array($theresult)){ 
  	if ($rdd['net_amount'] > $alreadypaid) echo '<center><font color="red" size="+3"><b>ERROR: DID THE CUSTOMER PAY AS GAME IS NOT MARKED AS FULLY PAID???</b></font></center>';
  }
} else {
	$uptime = (strtotime($timer['order_date']));
}
$uptime = date("m/d/Y H:i:s",$uptime);

if (($timer['order_date_completed'] <> '')&&($timer['order_date_completed'] <> '0000-00-00 00:00:00')) {
	$end = strtotime($timer['order_date_completed']);
	$start = strtotime($timer['order_date']);

	$seconds = ($end - $start);
	$escaped = 'Escaped in '.gmdate("i", $seconds).' minutes and '.gmdate("s", $seconds).' seconds';
	if ($_GET['game'] == 1) $game = 'The Order Of The 9';
	if ($_GET['game'] == 2) $game = 'Bunker 51';
	if ($_GET['game'] == 3) $game = 'Forgotten Temple';
  if ($_GET['game'] == 4) $game = 'Escape to Treasure Island';
  if ($_GET['game'] == 5) $game = 'The Great Time Escape';
	$query ="insert into admin_logs values ('', '".$_SESSION['adminid']."', 'Game ".$order_id." (".$game.") ended.', now())";
  mysqli_query($objuserdetails->conn,$query);
}

?>
<style>
/* Tooltip container */
.tooltips {
    position: relative;
    display: inline-block;
}

/* Tooltip text */
.tooltips .tooltiptexts {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    border-radius: 6px;

    /* Position the tooltip text - see examples below! */
    position: absolute;
    z-index: 9999;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltips:hover .tooltiptexts {
    visibility: visible;
}
</style>

<script type="text/javascript" src="vxgplayer-1.8.31.min.js"></script>
<link href="vxgplayer-1.8.31.min.css" rel="stylesheet"/>
<script type="text/javascript" language="JavaScript">
	TargetDate = "<?php echo $uptime; ?>";
	CountActive = true;
	</script>
<?
if ($_GET['game'] == 1) $game = 'The Order Of The 9';
if ($_GET['game'] == 2) $game = 'Bunker 51';
if ($_GET['game'] == 3) $game = 'Forgotten Temple';
if ($_GET['game'] == 4) $game = 'Escape to Treasure Island';
if ($_GET['game'] == 5) $game = 'The Great Time Escape';
?>
<div style="width:400px; float:left;">
<div style="text-align: center; background-color: white; position:fixed; z-index: 1; width:440px; height:90px;"><strong><?=$game;?></strong>
<?
if ($escaped <> '') {
		echo '<div style="text-align: center; margin-top:20px; color:green;"><strong>'.$escaped.'</strong></div><br>';
} else {
	echo '<div style="text-align: center; margin-top:20px;"><b>TIMER:</b> <script type="text/javascript"  language="JavaScript" src="../assets/js/time.js"></script>	</div>';
}
echo '</div><div style="margin-top:90px;">';
$objuserdetails->id = 0;
$details = $objuserdetails->get_hints_clues('');
while($dd = mysqli_fetch_array($details)){
	if ($dd['room'] == $_GET['game']) {
		$existing = $objuserdetails->get_existinghints_clues($order_id, $dd['hint_no']);
		$doesitexist = mysqli_fetch_array($existing);
		if ($doesitexist['id'] <> '') { 
			echo '<div class="tooltips" style="margin-left:20px; margin-top:5px;"><input class="StepComplete" type="checkbox" checked name="'.$order_id.'" id="'.$dd['hint_no'].'"/>&nbsp;&nbsp;'.$dd['hint'] . '<span class="tooltiptexts">'.$dd['clue'] .'</span></div>';
		} else {
			echo '<div class="tooltips" style="margin-left:20px; margin-top:5px;"><input class="StepComplete" type="checkbox" name="'.$order_id.'" id="'.$dd['hint_no'].'"/>&nbsp;&nbsp;'.$dd['hint'] . '<span class="tooltiptexts">'.$dd['clue'] .'</span></div>';
		}
	}
}
?>
</div>
<br><br>
<div style="text-align: center; margin-top:20px;"><button type="button" name="<?php echo $order_id;?>" class="btn btn-info my_user_btn_for_escaped">LOG ESCAPE</button></div>
</div>

<?
if ($_GET['game'] == 1) $url = "rtsp://admin:nick1981@192.168.0.103:90/videoMain";
if ($_GET['game'] == 2) $url = "";
?> 


<? /*<div id="dynamicallyPlayers" style="float:right; position:fixed;"></div>*/?>

<iframe src="http://192.168.0.101:88/" width="1730" height="880" style="position:fixed; clip:rect(50px,1930px,1000px,250px); left:200px; top:50px;"></iframe>

<? /*<div style="position:fixed;" class="vxgplayer"
    id="vxg_media_player1"
    width="1000"
    height="700"
    url="<?=$url;?>"
    nmf-src="pnacl/Release/media_player.nmf"
    nmf-path="media_player.nmf"
    useragent-prefix="MMP/3.0"
    latency="10000"
    autohide="2"
    volume="0.7"
    avsync
    controls
    mute
    aspect-ratio
    aspect-ratio-mode="1"
    auto-reconnect
    connection-timeout="5000"
    connection-udp="0"
    custom-digital-zoom>
</div>*/?>

<?
include(dirname(__FILE__).'/footer.php');
?>
