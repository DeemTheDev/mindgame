<?

$URL = 'http://mindgame.co.za/book/admin/my-appointment_payments.php';
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2.13) Gecko/20101206 Ubuntu/10.10 (maverick) Firefox/3.6.13');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);        
$page = curl_exec($ch);

$page = strstr($page, '<div class="table-responsive">');

echo $page;

$to = "bookings@mindgame.co.za";
$subject = "Daily Report";

$message = $page;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@mindgame.co.za>' . "\r\n";

mail($to,$subject,$message,$headers);


?>