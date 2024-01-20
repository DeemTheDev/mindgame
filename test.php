<?
print_r($_POST);

$checksum = "1018448100017TEST1000ZARHTTPS://www.BLA.com2017-12-18 19:19:19enZAFnick@importitall.co.zaNickRuzika";
$checksum = md5($checksum);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://secure.paygate.co.za/payweb3/initiate.trans");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "PAYGATE_ID=1018448100017&REFERENCE=TEST&AMOUNT=1000&CURRENCY=ZAR&RETURN_URL=HTTPS://www.BLA.com&TRANSACTION_DATE=2017-12-18 19:19:19&LOCALE=en&COUNTRY=ZAF&EMAIL=nick@importitall.co.za&CHECKSUM=".$checksum);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

parse_str($server_output, $server_output);
$server_output['PAYGATE_ID'];
$server_output['PAY_REQUEST_ID'];
$server_output['REFERENCE'];
$server_output['CHECKSUM'];
