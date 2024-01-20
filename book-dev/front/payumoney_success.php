<?php
session_start();
include(dirname(dirname(__FILE__)).'/header.php');
include(dirname(dirname(__FILE__)).'/objects/class_connection.php');
include(dirname(dirname(__FILE__)).'/objects/class_setting.php');

$database= new cleanto_db();
$conn=$database->connect();
$database->conn=$conn;
$settings=new cleanto_setting();
$settings->conn=$conn;

$TRANSACTION_STATUS=$_POST['TRANSACTION_STATUS'];
$_SESSION['ct_details']['paumoney_transaction_id'] = $_POST["PAY_REQUEST_ID"];
$_SESSION['ct_details']['partial_amount'] = $_SESSION['ct_details']['net_amount'];;

if ($TRANSACTION_STATUS == "1") {
// If transaction is successful; then auth code should be non-zero and resultcode should be 990017.
	$pgsuccess=1;
	$amountpg = substr_replace($amountpg, '.', -2, 0); 
	$transactionidpg;
	$REFERENCE = substr($REFERENCE, 0, 6);
					

  } elseif ($TRANSACTION_STATUS == "0") {
	// Transaction status of 0 means problem with PayGate server.
   if ($pgResultCode == "990024" || $pgResultCode == "990028") {
   	$pgerror="<b>Transaction not successful</b><br><b>ResultCode:</b> ".$RESULT_CODE."<br><b>Description:</b> ".$RESULT_DESC;
	 }	else {
   	$pgerror="Transaction not successful";
	}
 } else {
	// Transaction is declined so print error message
	 $pgerror="<b>Transaction not successful</b>";
}

if ($pgsuccess==1) {
	?>
	<script>window.location = '<?php echo FRONT_URL; ?>booking_complete.php'; </script>
	<?
} else {
echo "<h3>Your payment status returned by your bank: ". $pgerror .".</h3>";
echo "<h4>Your transaction id for this transaction is ".$_POST['PAY_REQUEST_ID'].". You may try again by clicking the link below.</h4>";?>
<p><a href="<?php echo SITE_URL; ?>"> Try Again</a></p><?
}
/*



$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$_SESSION['ct_details']['paumoney_transaction_id'] = $_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt=$settings->get_option('ct_payumoney_salt');

If (isset($_POST["additionalCharges"])) {
	$additionalCharges=$_POST["additionalCharges"];
	$retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}else {	  
	$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}
$hash = hash("sha512", $retHashSeq);
if ($hash != $posted_hash) {
	echo "Invalid Transaction. Please try again";
}else{
	?>
	<script>window.location = '<?php echo FRONT_URL; ?>booking_complete.php'; </script>
	<?php
}
?>