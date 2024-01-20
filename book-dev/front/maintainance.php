<?php 

$filename =  '../config.php';
$file = file_exists($filename);
if($file){
	if(!filesize($filename) > 0){
		header('location:../ct_install.php');
	}	
}else{
	echo "Config file does not exist";
}

session_start();
include(dirname(dirname(__FILE__)).'/header.php');
include(dirname(dirname(__FILE__))."/objects/class_adminprofile.php");
include(dirname(dirname(__FILE__)).'/objects/class_connection.php');
include(dirname(dirname(__FILE__))."/objects/class_dayweek_avail.php");
include(dirname(dirname(__FILE__)).'/objects/class_setting.php');
$database= new cleanto_db();
$conn=$database->connect();
$database->conn=$conn;
$settings=new cleanto_setting();
$settings->conn=$conn;
$adminprofile = new cleanto_adminprofile();
$adminprofile->conn = $conn;
$timeavailability= new cleanto_dayweek_avail();
$timeavailability->conn = $conn;
$check_for_products  = "select * from ct_services,ct_services_method,ct_service_methods_units";
$hh = mysqli_query($conn,$check_for_products);
$t = $timeavailability->get_timeavailability_check();
$last = "";
if($settings->get_option('ct_company_address')=="" ||
    $settings->get_option('ct_company_city')=="" ||
    $settings->get_option('ct_company_state')=="" ||
    $settings->get_option('ct_company_name')=="" ||
    $settings->get_option('ct_company_email')=="" ||
    $settings->get_option('ct_company_zip_code')=="" ||
    $settings->get_option('ct_company_country')=="" ||
    mysqli_num_rows($hh)=="" ||
    mysqli_num_rows($t)==""){
    $last = "Please complete configurations before you created website embed code. ";
}else{	 header("Location:".BASE_URL); 
}
$lang = $settings->get_option("ct_language");
$label_language_values = "";
$language_label_arr = $settings->get_all_labelsbyid($lang);
if ($language_label_arr[1] != "")
{    
	$label_language_arr_first = $language_label_arr[1];	
	$label_explode = explode("###",$label_language_arr_first);	
	$label_decode_front = base64_decode($label_explode[0]);	
	$label_decode_admin = base64_decode($label_explode[1]);	
	$label_decode_error = base64_decode($label_explode[2]);	
	$label_decode_extra = base64_decode($label_explode[3]);	
	$label_decode_front_unserial = unserialize($label_decode_front);	
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);	
	$label_decode_extra_unserial = unserialize($label_decode_extra); 	
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}else{
    $default_language_arr = $settings->get_all_labelsbyid("en");
	$label_language_arr_first = $default_language_arr[1];
	$label_explode = explode("###",$label_language_arr_first);
	$label_decode_front = base64_decode($label_explode[0]);
	$label_decode_admin = base64_decode($label_explode[1]);
	$label_decode_error = base64_decode($label_explode[2]);
    $label_decode_extra = base64_decode($label_explode[3]);
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Cleanto | Maintainance</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>/assets/images/backgrounds/<?php echo $settings->get_option('ct_favicon_image');?>"/>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/ct-thankyou.css" type="text/css" media="all"/> 
<!-- **Google - Fonts** -->
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   </head>
<body>
    <div id="ct" class="ct-wrapper">
		<div class="ct-container">
			<div class="booking-tankyou">	
			<h1 class="header1"><?php echo $label_language_values['warning']; ?></h1>	
			<h3 class="header3"><?php echo $label_language_values['please_fill_all_the_company_informations_and_add_some_services_and_addons']; ?></h3>
			<p class="thankyou-text"><?php echo $label_language_values['try_later']; ?></p>	
			<?php 
			if(isset($_SESSION['adminid']) && $_SESSION['adminid'] != "")
			{
				?>
				<div class="ct-col-12"><a href="<?php echo SITE_URL; ?>admin" class="ct-button"><?php echo $label_language_values['configure_now_new']; ?></a></div>
				<?php 
			}
			?>
			
			
			
			</div>
		</div>
	</div>
</body>
</html>