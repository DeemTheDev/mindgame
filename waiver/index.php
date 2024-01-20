<?
$username="mindgsbgbt_1";
$password="H2s27kptcL8";
$database="mindgsbgbt_db1";
$db = mysqli_connect(localhost,$username,$password, $database);
	//@mysqli_select_db($database) or die( "Unable to select database");
$captured = 0;

if ($_POST['booking'] && $_POST['lastName'] && $_POST['email']) {
	$player_template = mysqli_query($db, "select * from ct_order_client_players where order_id = '".$_POST['booking']."'");
		$player = mysqli_fetch_assoc($player_template);
		if ($player['order_id'] >= 1) {
			if ($player['player2'] == "") {
				mysqli_query($db, "update ct_order_client_players set player2 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player3'] == "") {
				mysqli_query($db, "update ct_order_client_players set player3 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player4'] == "") {
				mysqli_query($db, "update ct_order_client_players set player4 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player5'] == "") {
				mysqli_query($db, "update ct_order_client_players set player5 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player6'] == "") {
				mysqli_query($db, "update ct_order_client_players set player6 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player7'] == "") {
				mysqli_query($db, "update ct_order_client_players set player7 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			} else if ($player['player8'] == "") {
				mysqli_query($db, "update ct_order_client_players set player8 = '".$_POST['email']."' where order_id = '".$_POST['booking']."'");
			}
			//echo '<br>Record Exists '.$_POST['booking'];	
		} else {
			mysqli_query($db, "insert into ct_order_client_players (order_id, player1) values ('".$_POST['booking']."','".$_POST['email']."')"); 
			//echo '<br>entering record';
		}
	mysqli_query($db, "insert into ct_hear_about_us (game_id, medium) values ('".$_POST['booking']."','".$_POST['heard']."')"); 
	$captured = 1;
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Mindgame Escape Waiver</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="container">
	<? if ($captured==1) { echo '<center><div class="success" style="color:red; margin-bottom:15px; padding-bottom:15px; font-weight:bold;">Evidence has been captured successfully. Please hand to the next detective!</div></center>'; } ?>
	<header>
		<h1>
			<a href="#">
				<img src="https://www.mindgame.co.za/wp-content/uploads/2017/09/mindgamesmall.fw_-1.png" alt="Mindgame Escape Waiver">
			</a>
		</h1>
	</header>
	<h1 class="text-center">Indemnity Form</h1>
	<form class="registration-form" method="post">
		<label>
			<span class="label-text">Booking</span>
			<select name="booking" required>
				<option disabled selected value> -- select an option -- </option>
			<? $products_query_template = 'select ci.order_id, client_name, booking_date_time, title from ct_services, ct_bookings cb, ct_order_client_info ci where ct_services.id = service_id and cb.order_id = ci.order_id and DATE(`booking_date_time`) = CURDATE() and cb.booking_status="A" order by booking_date_time';
				 $bookings_query = mysqli_query($db, $products_query_template);
				 while ($bookings = mysqli_fetch_assoc($bookings_query)) {
				 	echo '<option value='.$bookings['order_id'].'>'.$bookings['client_name'] . ' at ' . substr($bookings['booking_date_time'],11) . ' in ' . $bookings['title'].'</option>';
				 } ?>
			</select>
		</label>
		<label>
			<span class="label-text">Name and Surname</span>
			<input type="text" name="lastName">
		</label>
		<label>
			<span class="label-text">Email</span>
			<input type="text" name="email">
		</label>
		<label>
			<span class="label-text">How did you hear about us?</span>
			<select name="heard">
				<option disabled selected value> -- select an option -- </option>
				<option value="Facebook">Facebook</option>
				<option value="Instagram">Instagram</option>
				<option value="Pamphlet">Pamphlet</option>
				<option value="Google">Google</option>
				<option value="Friend">Friend</option>
				<option value="Tripadvisor">Tripadvisor</option>
				<option value="Other">Other</option>
			</select>
		</label>
		<label>
			<span style="font-size:0.5em;">
				• You have voluntarily and expressly agreed to participate and/ or play Mindgame Escape Rooms at your sole risk. Mindgame Escape and its employees will not be held responsible for any accident that may arise. <br>
				• Mindgame Escape and its employees shall not be held liable or responsible for any loss of your personal belongings. Please make full use of the lockers provided. <br>
• You undertake to complete the Mindgame Escape Room in accordance to the instruction and rules specified by the employees. Failing which, Mindgame Escape and their employees shall have the right and power to refuse your entry to the site.<br>
• Failure to abide by any of the terms and rules of the games will result in termination of the game. There will be no refund of fees.<br>
• You agree to use the facilities within the premises with care. Mindgame Escape reserves all rights to charge guests for any damage which is intentional or caused by misuse of items.<br>
• You shall not enter the rooms under the influence of drugs or alcohol. Mindgame Escape and its employees reserves all rights and power to refuse your entry to the site.<br>
• Strictly no mobile phones, cameras or recording equipment shall be allowed inside the Mindgame Escape Rooms. <br>
• Due to the nature of the sessions, Mindgame Escape will have full viewing and hearing capabilities of participants whilst they are in the room. <br>
• Mindgame Escape expects our visitors and customers not to disclose any details of the game directly or indirectly to the public.<br>
• Mindgame Escape collects and stores your personal details without disclosing it to any 3rd party and is dedicated to ensuring that the privacy of your personal information is protected.<br>
• Mindgame Escape employees may take photos of participants and you accept and agree that these photos may be posted on social media sites, unless you specifically request that we do not post your image.<br>
• Mindgame Escape may contact you from time to time with offers and promotions via email.</span>
		</label>
		<div class="text-center">
			<button class="submit" name="register">I accept the terms and conditions</button>
		</div>
	</form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
