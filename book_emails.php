<?php /*
$username="mindgsbgbt_1";
$password="H2s27kptcL8";
$database="mindgsbgbt_db1";
mysql_connect(localhost,$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

$products_query_template = "select * from test;";
$bookings_query = mysql_query($products_query_template);

while ($bookings = mysql_fetch_assoc($bookings_query)) {
	$exist['order_id'] = 0;
	$exist_template = mysql_query("select ci.order_id from ct_order_client_info ci, ct_bookings b where b.order_id = ci.order_id and client_name = '".$bookings['booking_name']."' and booking_date_time = '".$bookings['booking_date']."'");
	$exist = mysql_fetch_assoc($exist_template);
	if ($exist['order_id'] >= 1) {
		$player_template = mysql_query("select * from ct_order_client_players where order_id = '".$exist['order_id']."'");
		$player = mysql_fetch_assoc($player_template);
		if ($player['order_id'] >= 1) {
			if ($player['player2'] == "") {
				mysql_query("update ct_order_client_players set player2 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player3'] == "") {
				mysql_query("update ct_order_client_players set player3 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player4'] == "") {
				mysql_query("update ct_order_client_players set player4 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player5'] == "") {
				mysql_query("update ct_order_client_players set player5 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player6'] == "") {
				mysql_query("update ct_order_client_players set player6 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player7'] == "") {
				mysql_query("update ct_order_client_players set player7 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			} else if ($player['player8'] == "") {
				mysql_query("update ct_order_client_players set player8 = '".$bookings['email']."' where order_id = '".$exist['order_id']."'");
			}
			mysql_query("delete from test where ID = ".$bookings['ID']);
			echo '<br>Record Exists '.$player['order_id'];	
		} else {
			mysql_query("insert into ct_order_client_players (order_id, player1) values ('".$exist['order_id']."','".$bookings['email']."')"); 
			mysql_query("delete from test where ID = ".$bookings['ID']);
			echo '<br>entering record';
		}
	}
} */
?> 