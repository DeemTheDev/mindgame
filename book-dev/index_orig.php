<?php 
$filename =  './config.php';
$file = file_exists($filename);
if($file){
	if(!filesize($filename) > 0){
		header('location:ct_install.php');
	}
	else{
		include(dirname(__FILE__) . "/objects/class_connection.php");
		$cvars = new cleanto_myvariable();
		$host = trim($cvars->hostnames);
		$un = trim($cvars->username);
		$ps = trim($cvars->passwords); 
		$db = trim($cvars->database);

		$con = new cleanto_db();
		$conn = $con->connect();
		
		if(($conn->connect_errno=='0' && ($host=='' || $db=='')) || $conn->connect_errno!='0' ) {
			header('Location: ./config_index.php');
		}
	}
}else{
	echo "Config file does not exist";
}

session_start();
$service_array = array("method" => array());
$_SESSION['ct_cart'] = $service_array;
$_SESSION['freq_dis_amount'] = '';
$_SESSION['ct_details'] = '';
include(dirname(__FILE__) . '/class_configure.php');
include(dirname(__FILE__) . "/header.php");
include(dirname(__FILE__) . "/objects/class_services.php");
include(dirname(__FILE__) . "/objects/class_users.php");
include(dirname(__FILE__) . '/objects/class_setting.php');
include(dirname(__FILE__) . '/objects/class_frequently_discount.php');
include(dirname(__FILE__) . '/objects/class_service_methods_design.php');
include(dirname(__FILE__) . "/objects/class_version_update.php");

$cvars = new cleanto_myvariable();
$host = trim($cvars->hostnames);
$un = trim($cvars->username);
$ps = trim($cvars->passwords); 
$db = trim($cvars->database);

$con = @new cleanto_db();
$conn = $con->connect();

if(($conn->connect_errno=='0' && ($host=='' || $db=='')) || $conn->connect_errno!='0' ) {
	header('Location: '.BASE_URL.'/config_index.php');
    exit(0);
}

$check_existing_tables_index = $con->check_existing_tables_index($conn);
if($check_existing_tables_index == 'table_not_exist' || $check_existing_tables_index == 'table_exist_but_no_data'){
	?>
		<script type="text/javascript">
			var AdminloginCredentialObj={'site_url':'<?php echo SITE_URL;?>'};
			var AdminloginCredential_url=AdminloginCredentialObj.site_url;
			window.location=AdminloginCredential_url+"config_index.php";
		</script>
	<?php
}

/*
Language
*/
$language_names = array(
"en"=> urlencode("English (United States)"),
"ary"=> urlencode("العربية المغربية"),
"ar"=> urlencode("العربية"),
"az"=> urlencode("Azərbaycan dili"),
"azb"=> urlencode("گؤنئی آذربایجان"),
"bg_BG"=> urlencode("Български"),
"bn_BD"=> urlencode("বাংলা"),
"bs_BA"=> urlencode("Bosanski"),
"ca"=> urlencode("Català"),
"ceb"=> urlencode("Cebuano"),
"cs_CZ"=> urlencode("Čeština‎"),
"cy"=> urlencode("Cymraeg"),
"da_DK"=> urlencode("Dansk"),
"de_CH_informal"=> urlencode("Deutsch (Schweiz, Du)"),
"de_DE_formal"=> urlencode("Deutsch (Sie)"),
"de_DE"=> urlencode("Deutsch"),
"de_CH"=> urlencode("Deutsch (Schweiz)"),
"el"=> urlencode("Ελληνικά"),
"en_CA"=> urlencode("English (Canada)"),
"en_GB"=> urlencode("English (UK)"),
"en_NZ"=> urlencode("English (New Zealand)"),
"en_ZA"=> urlencode("English (South Africa)"),
"en_AU"=> urlencode("English (Australia)"),
"eo"=> urlencode("Esperanto"),
"es_ES"=> urlencode("Español"),
"et"=> urlencode("Eesti"),
"eu"=> urlencode("Euskara"),
"fa_IR"=> urlencode("فارسی"),
"fi"=> urlencode("Suomi"),
"fr_FR"=> urlencode("Français"),
"gd"=> urlencode("Gàidhlig"),
"gl_ES"=> urlencode("Galego"),
"gu"=> urlencode("ગુજરાતી"),
"haz"=> urlencode("هزاره گی"),
"hi_IN"=> urlencode("हिन्दी"),
"hr"=> urlencode("Hrvatski"),
"hu_HU"=> urlencode("Magyar"),
"hy"=> urlencode("Հայերեն"),
"id_ID"=> urlencode("Bahasa Indonesia"),
"is_IS"=> urlencode("Íslenska"),
"it_IT"=> urlencode("Italiano"),
"ja"=> urlencode("日本語"),
"ka_GE"=> urlencode("ქართული"),
"ko_KR"=> urlencode("한국어"),
"lt_LT"=> urlencode("Lietuvių kalba"),
"lv"=> urlencode("Latviešu valoda"),
"mk_MK"=> urlencode("Македонски јазик"),
"mr"=> urlencode("मराठी"),
"ms_MY"=> urlencode("Bahasa Melayu"),
"my_MM"=> urlencode("ဗမာစာ"),
"nb_NO"=> urlencode("Norsk bokmål"),
"nl_NL"=> urlencode("Nederlands"),
"nl_NL_formal"=> urlencode("Nederlands (Formeel)"),
"nn_NO"=> urlencode("Norsk nynorsk"),
"oci"=> urlencode("Occitan"),
"pl_PL"=> urlencode("Polski"),
"pt_PT"=> urlencode("Português"),
"pt_BR"=> urlencode("Português do Brasil"),
"ro_RO"=> urlencode("Română"),
"ru_RU"=> urlencode("Русский"),
"sk_SK"=> urlencode("Slovenčina"),
"sl_SI"=> urlencode("Slovenščina"),
"sq"=> urlencode("Shqip"),
"sr_RS"=> urlencode("Српски језик"),
"sv_SE"=> urlencode("Svenska"),
"szl"=> urlencode("Ślōnskŏ gŏdka"),
"th"=> urlencode("ไทย"),
"tl"=> urlencode("Tagalog"),
"tr_TR"=> urlencode("Türkçe"),
"ug_CN"=> urlencode("Uyƣurqə"),
"uk"=> urlencode("Українська"),
"vi"=> urlencode("Tiếng Việt"),
"zh_TW"=> urlencode("繁體中文"),
"zh_HK"=> urlencode("香港中文版"),
"zh_CN"=> urlencode("简体中文"),
);
/* NAME */
$objservice = new cleanto_services();
$objservice->conn = $conn;
$user = new cleanto_users();
$user->conn = $conn;
$settings = new cleanto_setting();
$settings->conn = $conn;
$frequently_discount = new cleanto_frequently_discount();
$frequently_discount->conn = $conn;
$objservice_method_design = new cleanto_service_methods_design();
$objservice_method_design->conn = $conn;


$objcheckversion = new cleanto_version_update();
$objcheckversion->conn = $conn;
$current = $settings->get_option('ct_version');
if($current == "")
{
    $objcheckversion->insert_option("ct_version","1.1");
}
$current = $settings->get_option('ct_version');
if($current < 1.1)
{
    $settings->set_option("ct_version","1.1");
    $objcheckversion->update1_1();
}
$current = $settings->get_option('ct_version');
if($current < 1.2)
{
    $settings->set_option("ct_version","1.2");
    $objcheckversion->update1_2();
}
$current = $settings->get_option('ct_version');
if($current < 1.3)
{
    $settings->set_option("ct_version","1.3");
    $objcheckversion->update1_3();
}
$current = $settings->get_option('ct_version');
if($current < 1.4)
{
    $settings->set_option("ct_version","1.4");
    $objcheckversion->update1_4();
}
$current = $settings->get_option('ct_version');
if($current < 1.5)
{
    $settings->set_option("ct_version","1.5");
    $objcheckversion->update1_5();
}
$current = $settings->get_option('ct_version');
if($current < 1.6)
{
    $settings->set_option("ct_version","1.6");
    $objcheckversion->update1_6();
}
$current = $settings->get_option('ct_version');
if($current < 2.0)
{
    $settings->set_option("ct_version","2.0");
    $objcheckversion->update2_0();
}


$lang = $settings->get_option("ct_language");
$label_language_values = "";

if(isset($_SESSION['current_lang'])){
	$language_label_arr = $settings->get_all_labelsbyid($_SESSION['current_lang']);
}
else {
	$language_label_arr = $settings->get_all_labelsbyid($lang);
}
if ($language_label_arr[1] != "")
{
    $label_language_arr_first = $language_label_arr[1];
	$label_explode = explode("###",$label_language_arr_first);
	
	$label_decode_front = base64_decode($label_explode[0]);
	$label_decode_admin = base64_decode($label_explode[1]);
	$label_decode_error = base64_decode($label_explode[2]);
	$label_decode_extra = base64_decode($label_explode[3]);
	$label_decode_front_form_errors = base64_decode($label_explode[4]);
    
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
	$label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
else
{
    $default_language_arr = $settings->get_all_labelsbyid("en");
    
	$label_language_arr_first = $default_language_arr[1];
	$label_explode = explode("###",$label_language_arr_first);
	
	$label_decode_front = base64_decode($label_explode[0]);
	$label_decode_admin = base64_decode($label_explode[1]);
	$label_decode_error = base64_decode($label_explode[2]);
	$label_decode_extra = base64_decode($label_explode[3]);
	$label_decode_front_form_errors = base64_decode($label_explode[4]);
    
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
	$label_decode_front_form_errors_unserial = unserialize($label_decode_front_form_errors);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial,$label_decode_front_form_errors_unserial);
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
$frontimage=$settings->get_option('ct_front_image');
if($frontimage!=''){
$imagepath=SITE_URL."assets/images/backgrounds/".$frontimage;
}else{
$imagepath=SITE_URL."assets/images/booking-bg.jpg";
} 
	$english_date_array = array(
"January","Jan","February","Feb","March","Mar","April","Apr","May","June","Jun","July","Jul","August","Aug","September","Sep","October","Oct","November","Nov","December","Dec");
	$selected_lang_label = array(
ucfirst(strtolower($label_language_values['january'])),
ucfirst(strtolower($label_language_values['jan'])),
ucfirst(strtolower($label_language_values['february'])),
ucfirst(strtolower($label_language_values['feb'])),
ucfirst(strtolower($label_language_values['march'])),
ucfirst(strtolower($label_language_values['mar'])),
ucfirst(strtolower($label_language_values['april'])),
ucfirst(strtolower($label_language_values['apr'])),
ucfirst(strtolower($label_language_values['may'])),
ucfirst(strtolower($label_language_values['june'])),
ucfirst(strtolower($label_language_values['jun'])),
ucfirst(strtolower($label_language_values['july'])),
ucfirst(strtolower($label_language_values['jul'])),
ucfirst(strtolower($label_language_values['august'])),
ucfirst(strtolower($label_language_values['aug'])),
ucfirst(strtolower($label_language_values['september'])),
ucfirst(strtolower($label_language_values['sep'])),
ucfirst(strtolower($label_language_values['october'])),
ucfirst(strtolower($label_language_values['oct'])),
ucfirst(strtolower($label_language_values['november'])),
ucfirst(strtolower($label_language_values['nov'])),
ucfirst(strtolower($label_language_values['december'])),
ucfirst(strtolower($label_language_values['dec'])));
	?>
<!Doctype html>

<head>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-30000709-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-30000709-2');
</script>
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
    <title>Mindgame Escape Durban - Book Now!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="refresh" content="300">
	<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>/assets/images/backgrounds/<?php echo $settings->get_option('ct_favicon_image');?>"/>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/ct-main.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/ct-common.css" type="text/css" media="all" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/tooltipster.bundle.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/tooltipster-sideTip-shadow.min.css" type="text/css" media="all" />
	<?php 
	if(in_array($lang,array('ary','ar','azb','fa_IR','haz'))){ ?>	
	<!-- Front RTL style -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/cta-front-rtl.css" type="text/css" media="all" />
	<?php } ?>
	<script>
	var ct_postalcode_statusObj = {'ct_postalcode_status': '<?php echo $settings->get_option('ct_postalcode_status');?>'};
	var scrollable_cartObj = {'scrollable_cart': '<?php echo $settings->get_option('ct_cart_scrollable'); ?>'};
	</script>
	<?php
	$ct_frontend_fonts_val = $settings->get_option('ct_frontend_fonts');
	if($ct_frontend_fonts_val == 'Molle'){
		?>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Molle:400i" />
		<?php
	}else if($ct_frontend_fonts_val == 'Coda Caption'){
		?>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Coda+Caption:800" />
		<?php
	}else{
		?>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=<?php echo $ct_frontend_fonts_val; ?>:300,400,700" />
		<?php
	}
	?>
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/login-style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/ct-responsive.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/ct-reset.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery-ui.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/intlTelInput.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery-ui.theme.min.css" type="text/css" media="all" />
	 <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/font-awesome/css/font-awesome.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/line-icons/simple-line-icons.css" type="text/css" media="all" />
	<?php if($settings->get_option('ct_stripe_payment_form_status') == 'on'){  ?>
	<script src="https://js.stripe.com/v2/" type="text/javascript"></script>	
	<?php } ?>
	<?php if($settings->get_option('ct_2checkout_status') == 'Y'){  ?>
	<script src="https://www.2checkout.com/checkout/api/2co.min.js" type="text/javascript"></script>	
	<?php } ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/ct-common-jquery.js" type="text/javascript"></script>
	
	<script src="<?php echo BASE_URL; ?>/assets/js/tooltipster.bundle.min.js" type="text/javascript"></script>
	
	
    <?php
    include(dirname(__FILE__)."/admin/language_js_objects.php");
    ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/intlTelInput.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery.payment.min.js" type="text/javascript"></script>

    <!-- **Google - Fonts** -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet"> 
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery.validate.min.js"></script>
	<style>
        .error {
            color: red;
        }
		#ct, a, h1, h2, h3, h4, h5, h6, span, p, div, label, li, ul{
			font-family: <?php echo $settings->get_option('ct_frontend_fonts'); ?>  !important;
		}
    </style>
	<style>
		body {
			background: url(<?php echo $imagepath;?>) repeat !important;
		}
	</style>
	<?php
	if($settings->get_option('ct_cart_scrollable') == 'N'){
		$ct_cart_scrollable_position = 'relative !important';
		?>
		<style>#ct .not-scroll-custom{ margin-top: 0 !important; }</style>
		<?php
	}else{
		$ct_cart_scrollable_position = 'relative';
	}
	?>
    <?php
    echo "<style>
	/* primary color */
		.cleanto{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link,
		.cleanto .ct-complete-booking-main .ct-link,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link{
			color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-link:hover,
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link:hover,
		.cleanto .ct-complete-booking-main .ct-link:hover,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link:hover{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto a,
		.cleanto .ct-link,
		.cleanto .ct-addon-count .ct-btn-group .ct-btn-text{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto a.ct-back-to-top i.icon-arrow-up,
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover .icon-arrow-right:before,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover .icon-arrow-left:before{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .calendar-body .ct-week:hover a span,
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover .addon-price{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto #ct-type-2 .service-selection-main .ct-services-dropdown .ct-service-list:hover,
		.cleanto #ct-type-method .ct-services-method-dropdown .ct-service-method-list:hover,
		.cleanto .common-selection-main .common-data-dropdown .data-list:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .selected-is:hover,
		.cleanto #ct-type-2 .service-is:hover,
		.cleanto #ct-type-method .service-method-is:hover{
			border-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover span:before{
			border-top-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover,
		.cleanto .calendar-body .ct-week:hover{
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot{
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected.active_today span,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot,
		.cleanto .calendar-body .dates .ct-week.active span {
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .calendar-header a.previous-date,
		.cleanto .calendar-header a.next-date{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span{
			border:1px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		#ct-login .ct-main-forget-password .ct-info-btn,
		.cleanto button,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn,	
		.cleanto .ct-button{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
			border: 2px solid " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-display-coupon-code .ct-coupon-value{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* for front date legends */
		.cleanto .calendar-body .ct-show-time .time-slot-container .ct-slot-legends .ct-available-new {
			background: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container .ct-slot-legends .ct-selected-new{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* seconday color */
		.nicescroll-cursors{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
				
	    .cleanto .calendar-body .dates .ct-week.active,
	    .cleanto .calendar-body .ct-show-time.shown{
	    	background: " . $settings->get_option('ct_secondary_color') . " !important;
	    }
	/* background color all css  HOVER */
		
		.cleanto .ct-selected,
		.cleanto .ct-selected-data,
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + lable span,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked label span,
		.cleanto .ct-discount-list ul.ct-discount-often li input[type='radio']:checked + .ct-btn-discount,
		.cleanto #ct-tslots .ct-date-time-main .time-slot-selection-main .time-slot.ct-selected,
		.cleanto .ct-button:hover,
		.cleanto-login .ct-main-forget-password .ct-info-btn:hover,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn:hover,
		.cleanto  input[type='submit']:hover,
		.cleanto  input[type='reset']:hover,
		.cleanto  input[type='button']:hover,
		.cleanto  button:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-step-heading{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background: " . $settings->get_option('ct_primary_color') . " !important;
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto #ct-price-scroll{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			box-shadow: 0px 0px 10px " . $settings->get_option('ct_primary_color') . " !important;
			position: ".$ct_cart_scrollable_position.";
		}
		
		.cleanto .ct-cart-wrapper .ct-cart-label-total-amount,
		.cleanto .ct-cart-wrapper .ct-cart-total-amount{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + .ct-service ,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser {
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			box-shadow: 0 0 0 1px " . $settings->get_option('ct_secondary_color') . " inset !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser span:before{
			border-top-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser .addon-price{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		
		.cleanto .border-c:hover,
		.cleanto .ct-list-services ul.services-list li .ct-service:hover,
		.cleanto .ct-list-services ul.addon-service-list li .ct-addon-ser:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn:hover,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn:hover,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-btn:hover,
		.cleanto .ct-discount-list ul.ct-discount-often li .ct-btn-discount:hover,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span,
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			
		}
		
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list input[type='checkbox']:checked + label span{
			border: 1px solid " . $settings->get_option('ct_secondary_color') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-custom-radio ul.ct-radio-list input[type='radio']:checked + label span{
			border:5px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-button.ct-btn-abs,
		.cleanto .calendar-header,
		.cleanto .panel-login .panel-heading .col-xs-6,
		.cleanto a.ct-back-to-top {
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto a.ct-back-to-top:hover,
		.cleanto .weekdays{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected{
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected a span{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.selected_date.active{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
			border-bottom: thin solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot:hover,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot.ct-booked,
		.cleanto .calendar-body .ct-show-time.shown{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			/* background: " . $settings->get_option('ct_secondary_color') . " !important; */
		}
		
		
		
		/* hover inputs */
		.cleanto input[type='text']:hover,
		.cleanto input[type='password']:hover,
		.cleanto input[type='email']:hover,
		.cleanto input[type='url']:hover,
		.cleanto input[type='tel']:hover,
		.cleanto input[type='number']:hover,
		.cleanto input[type='range']:hover,
		.cleanto input[type='date']:hover,
		.cleanto textarea:hover,
		.cleanto select:hover,
		.cleanto input[type='search']:hover,
		.cleanto input[type='submit']:hover,
		.cleanto input[type='button']:hover{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		
		/* Focus inputs */
		.cleanto input[type='text']:focus,
		.cleanto input[type='password']:focus,
		.cleanto input[type='email']:focus,
		.cleanto input[type='url']:focus,
		.cleanto input[type='tel']:focus,
		.cleanto input[type='number']:focus,
		.cleanto input[type='range']:focus,
		.cleanto input[type='date']:focus,
		.cleanto textarea:focus,
		.cleanto select:focus,
		.cleanto input[type='search']:focus,
		.cleanto input[type='submit']:focus,
		.cleanto input[type='button']:focus{
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			/* box-shadow: 0 0 0 1.5px " . $settings->get_option('ct_secondary_color') . " inset !important; */
		}
		.cleanto .ct-tooltip-link {color: " . $settings->get_option('ct_secondary_color') . " !important;}
	    /* for custom css option */
		".$settings->get_option('ct_custom_css')."
		
	</style>";
    ?>
    <script>
        jQuery(document).ready(function () {
            var $sidebar = jQuery("#ct-price-scroll"),
                $window = jQuery(window),
                offset = $sidebar.offset(),
                topPadding = 250;
            fulloffset = jQuery("#ct").offset();

            $window.scroll(function () {
                var color = jQuery('#color_box').val();
                jQuery("#ct-price-scroll").css({'box-shadow': '0px 0px 10px ' + color + '', 'position': 'absolute'});
            });
        });
    </script>
    <script type="text/javascript">
        function myFunction() {
            var input = document.getElementById('coupon_val')
            var div = document.getElementById('display_code');
            div.innerHTML = input.value;
        }
    </script>
</head>
<body>
<div class="ct-wrapper cleanto" id="ct"> <!-- main wrapper -->
	<div class="ct-loading-main">
		<div class="loader">Loading...</div>
	</div>
    <div class="ct-main-wrapper">
	    <div class="container">
		    <!-- left side main booking form -->

            <div class="ct-main-left ct-sm-7 ct-md-7 ct-xs-12 mt-30 br-5 np">
                <div class="ct-sm-12 ct-md-12 ta-c ct-location-header">
				<?php if($settings->get_option('ct_company_logo') != "" &&  $settings->get_option('ct_company_logo_display') == "Y"){?>
				
				<div id="ct-logo">
				 <a href="<?php echo SITE_URL; ?>">
				  <img src="<?php echo SITE_URL."assets/images/services/".$settings->get_option('ct_company_logo');?>" />
				 </a>
				</div>
				<?php } ?>
                    <?php
					if($settings->get_option('ct_company_header_address') == "Y"){
						$address = $settings->get_option('ct_company_address');
                    $city = $settings->get_option('ct_company_city');
                    $state = $settings->get_option('ct_company_state');
					$phone = $settings->get_option('ct_company_phone');
                    ?>
                    
                    <h6 class="header6"><?php if ($address == '') {
                            echo '';
                        } else {
                            echo $address . ', ';
                        } ?><?php if ($city == '') {
                            echo '';
                        } else {
                            echo $city . ', ';
                        } ?><?php if ($state == '') {
                            echo '';
                        } else {
                            echo $state;
                        } ?><span class="ct-company-phone">
							<?php if ($phone == '' || strlen($phone) <= 6 ) {
								echo '';
							} else {
								echo $phone;
							} ?>
						</span>
					
					</h6>
					<?php }
					if($settings->get_option("ct_front_language_selection_dropdown") == "Y"){ ?>
					<div id="cus-select" class="pull-left">
						<div class="common-selection-main">
								<?php 
									$langs_select = $settings->get_all_languages();
								?>
							<div class="selected-is select-language">
								<div class="data-list" id="ct_selected_language">
									<p class="ct-count"><?php if(isset($_SESSION['current_lang'])){ echo urldecode($language_names[$_SESSION['current_lang']]); }else{ echo urldecode($language_names[$settings->get_option("ct_language")]); }?></p>
								</div>
							</div>
							<div class="common-data-dropdown ct-language-dropdown">
								<?php 
								while($res = mysqli_fetch_array($langs_select)){
									?>
									<div class="data-list select_language_view" data-langs="<?php echo $res['language'];?>">
										<p class="ct-count"><?php echo urldecode($language_names[$res['language']]);?></p>
									</div>
									<?php 
								}
								?>
							</div>
						</div>
					</div>
					<?php }?>
                </div>
				<?php if($settings->get_option("ct_postalcode_status") == 'Y'){ ?>
                <div class="ct-list-services ct-common-box">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php echo $label_language_values['where_would_you_like_us_to_provide_service']; ?></h3>
                        <!--<p class="ct-sub">Choose your service and property size</p>-->
                    </div>
                    <div class="ct-address-area-main">

                        <div class="ct-postal-code">
                            <h6 class="header6"><?php echo $label_language_values['your_postal_code']; ?>
							<?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_postal_code")!=''){?>
								 <a class="ct-tooltip" href='#' title="<?php echo $settings->get_option("ct_front_tool_tips_postal_code");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
								<?php } ?></h6>
                            <div class="ct-md-3 ct-sm-6 ct-xs-12 remove_show_error_class">
                                <?php
                                $postalcode_placeholder = explode(',',$settings->get_option_postal("ct_postal_code"));
                                ?>
                                <input type="text" class="ct-postal-input" name="ct_postal_code" id="ct_postal_code" placeholder="<?php echo $postalcode_placeholder[0]; ?>"/>
                                <label class="postal_code_error error"></label>
                                <label class="postal_code_available"></label>
                            </div>
                        </div>
                    </div>
                </div>
				<?php } ?>
				
                <!-- end area based -->
                <div class="ct-list-services ct-common-box fl hide_allsss">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php echo $label_language_values['choose_service']; ?>
						 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_services")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_services");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php } ?>
						</h3>
						
                        <p class="ct-sub"><?php echo $label_language_values['choose_your_service_and_property_size']; ?></p>
                        <label class="service_not_selected_error" id="service_not_selected_error"></label>
                    </div>
                    <input id="total_cart_count" type="hidden" name="total_cart_count" value='1'/>
                    <!-- area based select cleaning -->
                    <?php
                    if ($settings->get_option('ct_service_default_design') == 1) {
                        ?>
                        <!-- 1.box style services selection radio selection -->
                        <ul class="services-list">
                            <?php
                            $services_data = $objservice->readall_for_frontend_services();
                            if (mysqli_num_rows($services_data) > 0) {
                                while ($s_arr = mysqli_fetch_array($services_data)) {
                                    ?>
                                    <li 
									<?php if($settings->get_option('ct_company_service_desc_status') != "" &&  $settings->get_option('ct_company_service_desc_status') == "Y"){ ?>
									
									
									title='<?php echo $s_arr['description'];?>' class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details ct-tooltip-services tooltipstered"
									<?php } else {
										echo "class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details'";										
									}  ?>
                                        data-servicetitle="<?php echo $s_arr['title']; ?>"
                                        data-id="<?php echo $s_arr['id']; ?>">
                                        <input type="radio" name="service-radio"
                                               id="ct-service-<?php echo $s_arr['id']; ?>"
                                               class="make_service_disable"/>
                                        <label class="ct-service border-c" for="ct-service-<?php echo $s_arr['id']; ?>">
                                            <?php
                                            if ($s_arr['image'] == '') {
                                                $s_image = 'default_service.png';
                                            } else {
                                                $s_image = $s_arr['image'];
                                            }
                                            ?>
                                            <div class="ct-service-img"><img class="ct-image"
                                                    src="<?php echo SITE_URL; ?>assets/images/services/<?php echo $s_image; ?>"/>
                                            </div>

                                        </label>
										
                                        <div class="service-name fl ta-c"><?php echo $s_arr['title']; ?></div>
                                        
										
										
                                    </li>
                                <?php
                                }?>
								
								
								
								
								
								
                           <?php  } else {
                                ?>
                                <li class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <!--  1 end box style service selection -->
						<?php
						if (mysqli_num_rows($services_data) === 1){
							$ser_arry = mysqli_fetch_array($services_data)
							?>
							<script>
							/** Make Service Selected **/
							jQuery(document).ready(function() {
								jQuery('.ser_details').trigger('click');
							});
							</script>
							<?php
						}
                    } else {
                        ?>
						<input type="radio" style="display:none;" name="service-radio" id="ct-service-0" value='off' class="make_service_disable"/>
                        <!-- 2. sevice dropdown selection -->
					<?php
                        $services_data = $objservice->readall_for_frontend_services();
                        if (mysqli_num_rows($services_data) > 0) {
                            ?>
                            <label class="service_not_selected_error_d2" id="service_not_selected_error_d2"><?php echo $label_language_values['please_select_service']; ?></label>
                            <div class="services-list-dropdown fl" id="ct-type-2">
                            <div class="service-selection-main">
                                <div class="service-is" title="<?php echo $label_language_values['choose_your_service'];?>">
                                    <div class="ct-service-list" id="ct_selected_service">
                                        <i class="icon-settings service-image icons"></i>

                                        <h3 class="service-name ser_name_for_error"><?php echo $label_language_values['cleaning_service']; ?></h3>
                                    </div>
                                </div>
                                <div class="ct-services-dropdown remove_service_data"> <?php
                                    while ($s_arr = mysqli_fetch_array($services_data)) { ?>
                                        <div class="ct-service-list select_service remove_service_class ser_details"
                                             data-servicetitle="<?php echo $s_arr['title']; ?>"
                                             data-id="<?php echo $s_arr['id']; ?>">
                                            <?php
                                            if ($s_arr['image'] == '') {
                                                $s_image = 'default_service.png';
                                            } else {
                                                $s_image = $s_arr['image'];
                                            }
                                            ?>
                                            <img class="service-image"
                                                 src="<?php echo SITE_URL; ?>assets/images/services/<?php echo $s_image; ?>"
                                                 title="<?php echo $label_language_values['service_image']; ?>"/>

                                            <h3 class="service-name"><?php echo $s_arr['title']; ?></h3>
                                        </div>
                                    <?php }
                                ?></div>
                            </div> </div><?php
							if (mysqli_num_rows($services_data) === 1){
									$st_arry = mysqli_fetch_array($services_data)
									?>
									<script>
									/** Make Service Selected **/
									jQuery(document).ready(function() {
										jQuery('.select_service').trigger('click');
									});
									</script>
									<?php
								}
                        } else {
                            ?>
                            <div class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?></div>
                        <?php
                        }
                        ?>
                    <!-- 2. end service dropdown selection -->
                    <?php
                    }
                    ?>
					<div class="ct-scroll-meth-unit"></div>	
                    <label class="method_not_selected_error show_methods_after_service_selection" id="method_not_selected_error"><?php echo $label_language_values['please_select_method']; ?></label>

                    <div class="services-method-list-dropdown fl show_methods_after_service_selection show_single_service_method" id="ct-type-method">
                        <div class="service-method-selection-main">
                            <div class="service-method-is" title="<?php echo $label_language_values['choose_your_service'];?>">
                                <div class="ct-service-method-list" id="ct_selected_servic_method">
                                    <h3 class="service-method-name"><?php echo $label_language_values['service_usage_methods'];?></h3>
                                </div>
                            </div>

                            <div class="ct-services-method-dropdown s_method_names">
                            </div>
                        </div>
                    </div>
                         
                    <label class="empty_cart_error" id="empty_cart_error"></label>
					<label class="no_units_in_cart_error" id="no_units_in_cart_error"></label>
                    <input type='hidden' id="no_units_in_cart_err" value=''>
                    <input type='hidden' id="no_units_in_cart_err_count" value=''>
                    <!-- hrs selected  -->
                    <div class="ct-service-duration ct-md-12 ct-sm-12 s_m_units_design_1" id="ct-duration-main">
                        <div class="ct-inner-box border-c">

                            <div class="fl ct-md-12 mt-5 mb-15 np duration_hrs">
                            </div>
                            <!-- end duration hrs  -->
                        </div>
                    </div>
                    <!-- 1. bedroom and bathroom counting dropdown -->
                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np hidden fl s_m_units_design_2"
                         id="ct-meth-unit-type-1">
                        <div class="ct-inner-box border-c ser_design_2_units">

                        </div>
                    </div>
                    <!-- 1.end dropdown list bathroom bedroom -->
                    <!-- 2. boxed bathroom bedroom  -->
                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 np s_m_units_design_3" id="ct-meth-unit-type-2">
                        <div class="ct-inner-box border-c ser_design_3_units">

                        </div>
                    </div>
                    <!-- 2. end boxed bathroom bedroom -->

                    <div class="ct-meth-unit-count ct-md-12 ct-sm-12 s_m_units_design_4" id="ct-meth-unit-type-3">
                        <div class="ct-inner-box border-c ">
                            <div class="fl ct-bedrooms ct-btn-group ct-md-12 mt-5 mb-15 np">
                                <div class="ct-inner-box border-c ser_design_4_units">

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end service list -->


                <!-- Module third area based -->
                <div class="ct-list-services ct-common-box s_m_units_design_5 ser_design_5_units">

                </div>
                <!-- end area based -->
                <!-- end module third area based -->

                <div class="ct-extra-services-list ct-common-box add_on_lists hide_allsss_addons">

                </div>


                <!-- how often discount -->
                <?php $d_data = $frequently_discount->readall_front();
                $fd_data = $frequently_discount->readall_freq_dis_for_display_in_scrollbar();
                $freq_dis_title = mysqli_fetch_array($fd_data);
                if (mysqli_num_rows($d_data) > 0) {
                    ?>
                    <div class="ct-discount-list ct-common-box">
                        <div class="ct-list-header">
                            <h3 class="header3"><?php echo $label_language_values['how_often_would_you_like_us_provide_service']; ?>
							 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_frequently_discount")!=''){?>
							<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_frequently_discount");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
							<?php } ?>
							</h3>
							
                            <p class="ct-sub"><?php echo $label_language_values['recurring_discounts_apply_from_the_second_cleaning_onward']; ?></p>
                            <label class="freq_disc_empty_cart_error error" style="color:red"></label>
                        </div>

                        <ul class="ct-discount-often">
                            <?php
                            while ($f_discount = mysqli_fetch_array($d_data)) {
                                ?>
                                <li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
                                    <div class="discount-text f-l"><span
                                            class="discount-price"><?php if ($f_discount['labels'] != '') { ?> <?php echo ucwords($f_discount['labels']); } ?></span>
                                    </div>
									
                                    <input type="radio" name="frequently_discount_radio" <?php if (ucwords($freq_dis_title['discount_typename']) == 'Once') {
                                        echo 'checked';
                                    } else if (ucwords($freq_dis_title['discount_typename']) == 'Weekly') {
                                        echo 'checked';
                                    } else if (ucwords($freq_dis_title['discount_typename']) == 'Bi-Weekly') {
                                        echo 'checked';
                                    } else if (ucwords($freq_dis_title['discount_typename']) == 'Monthly') {
                                        echo 'checked';
                                    } ?> data-id='<?php echo $f_discount['id']; ?>' class="cart_frequently_discount"
                                           id="discount-often-<?php echo $f_discount['id']; ?>"
                                           data-name="<?php echo ucwords($label_language_values[strtolower(str_replace("-","_",$f_discount['discount_typename']))]); ?> "/>
                                    <label class="ct-btn-discount border-c"
                                           for="discount-often-<?php echo $f_discount['id']; ?>">
                                        <span
                                            class="float-left"><?php echo ucwords($label_language_values[strtolower(str_replace("-","_",$f_discount['discount_typename']))]); ?></span>
                                        <span class="ct-discount-check float-right"></span>
                                    </label>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div><!-- how often discount end -->
                <?php
                } else {
                    ?>
                    <input type="radio" name="frequently_discount_radio" checked data-id='0' class="cart_frequently_discount" id="discount-often-0" data-name="" style="display:none;"/>
                <?php
                }
                ?>
                <!-- date time selection -->
                <div class="ct-date-time-main ct-common-box hide_allsss">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php echo $label_language_values['when_would_you_like_us_to_come']; ?>
						 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_time_slots")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_time_slots");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php } ?>
						</h3>
						
                        <!-- <p class="ct-sub">Choose a date for your cleaning session. Time can not be guaranteed</p> -->
                    </div>


                    <div class="ct-md-12 ct-sm-12 ct-xs-12 ct-datetime-select-main">
                        <div class="ct-datetime-select">
                            <label class="date_time_error" id="date_time_error_id" for="complete_bookings"></label>

														<div class="show_calendar_after_method_selection">
                            	<div class="calendar-wrapper cal_info">
                            </div>
                            
                            <label class="date_time_error" id="date_time_error_id" for="complete_bookings"></label>
                            </div>
                            <!-- end calendar-wrapper -->
                        </div>
                    </div>
                </div>
                <!-- date and time slots end  -->

                <!-- personal details -->
				<div class="ct-user-info-main ct-common-box existing_user_details hide_allsss">
                    <div class="ct-list-header">
                        <h3 class="header3"><?php echo $label_language_values['your_personal_details']; ?>
						 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_personal_details")!=''){?>
						<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_personal_details");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
						<?php } ?>
						</h3>
						
                        <p class="ct-sub"><?php echo $label_language_values['please_provide_your_address_and_contact_details']; ?></p>

                        <!--<div class="client_logout">-->
						<div class="ct-logged-in-user client_logout">
                            <p class="welcome_msg_after_login pull-left"><?php echo $label_language_values['you_are_logged_in_as']; ?> <span class='fname'></span> <span class='lname'></span></p>
                            <a href="javascript:void(0)" class="ct-link ml-10" id="logout" data-id="<?php if (isset($_SESSION['login_user_id'])) { echo $_SESSION['login_user_id']; } ?>" title="<?php echo $label_language_values['log_out']; ?>"><?php echo $label_language_values['log_out']; ?></a>
                        </div>
                        <!--</div>-->
                    </div>
				    <div class="ct-main-details">
                            <div class="ct-login-exist" id="ct-login">
                                <div class="ct-custom-radio">
                                    <ul class="ct-radio-list hide_radio_btn_after_login">
										<?php
										if($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'on'){
										?>
										<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
                                            <label for="existing-user" class=""><span></span><?php echo $label_language_values['existing_user']; ?></label>
                                        </li>
                                        <li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
                                            <label for="new-user" class=""><span></span><?php echo $label_language_values['new_user']; ?>
                                            </label>
                                        </li>
										<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" name="user-selection" value="Guest-User"/>
                                            <label for="guest-user" class=""><span></span><?php echo $label_language_values['guest_user']; ?></label>
                                        </li>
										<?php
										}else if($settings->get_option('ct_existing_and_new_user_checkout') == 'off' && $settings->get_option('ct_guest_user_checkout') == 'on'){
										?>
										<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12" style='display:none;'>
                                            <input id="guest-user" type="radio" class="input-radio guest-user user-selection" checked="checked"  name="user-selection" value="Guest-User"/>
                                            <label for="guest-user" class=""><span></span><?php echo $label_language_values['guest_user']; ?></label>
                                        </li>						
										<?php
										}else if($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'off'){
										?>
										<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
                                            <label for="existing-user" class=""><span></span><?php echo $label_language_values['existing_user']; ?></label>
                                        </li>
                                        <li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
                                            <input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
                                            <label for="new-user" class=""><span></span><?php echo $label_language_values['new_user']; ?>
                                            </label>
                                        </li>
										<?php
										}
										?>
                                    </ul>
                                </div>

                                <div class="ct-login-existing hidden">
                                    <form id="user_login_form" class="" method="POST">
                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_login_email">
                                            <label for="ct-user-name"><?php echo $label_language_values['your_email']; ?></label>
                                            <input type="text" class="add_show_error_class_for_login error" name="ct_user_name" id="ct-user-name" placeholder="<?php echo $label_language_values['enter_email_to_login']; ?>" onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>
                                        </div>
                                        <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row hide_password">
                                            <label for="ct-user-pass"><?php echo $label_language_values['your_password']; ?>
                                            </label>
                                            <input type="password" class="add_show_error_class_for_login error" name="ct_user_pass" id="ct-user-pass" placeholder="<?php echo $label_language_values['enter_your_password']; ?>"  onkeydown="if (event.keyCode == 13) document.getElementById('login_existing_user').click()"/>
                                        </div>
                                        <label class="login_unsuccessfull"></label>

                                        <div class="ct-md-12 ct-xs-12 mb-15 hide_login_btn">
											<input type="hidden" value='not' id="check_login_click" />
                                            <a href="javascript:void(0)" class="ct-button" id="login_existing_user" title="<?php echo $label_language_values['log_in']; ?>"><?php echo $label_language_values['log_in']; ?></a>
                                            <a href="javascript:void(0)" id="ct_forget_password" class="ct-link" title="<?php echo $label_language_values['forget_password']; ?>?"><?php echo $label_language_values['forget_password']; ?></a>
                                        </div>
                                    </form>
                                </div>
                            </div>                        
                        <input type="hidden" id="color_box" data-id="<?php echo $settings->get_option('ct_secondary_color'); ?>" value="<?php echo $settings->get_option('ct_secondary_color'); ?>"/>

                        <form id="user_details_form" class="" method="post">
								<div class="ct-new-user-details remove_preferred_password_and_preferred_email">
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-email"><?php echo $label_language_values['preferred_email']; ?></label>
                                        <input type="text" name="ct_email" id="ct-email" class="add_show_error_class error" placeholder="<?php echo $label_language_values['your_valid_email_address']; ?>"/>
                                    </div>
                                    <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                        <label for="ct-preffered-pass"><?php echo $label_language_values['preferred_password']; ?></label>
                                        <input type="password" name="ct_preffered_pass" id="ct-preffered-pass" class="add_show_error_class error" placeholder="<?php echo $label_language_values['password']; ?>"/>
                                    </div>
                                </div>
                            <div class="ct-peronal-details">
								<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_guest_user_preferred_email">
									<label for="ct-email-guest"><?php echo $label_language_values['preferred_email']; ?>
									</label>
									<input type="text" name="ct_email_guest" class="add_show_error_class error" id="ct-email-guest" placeholder="<?php echo $label_language_values['your_valid_email_address'];?>"/>
								</div>
								<?php $fn_check = explode(",",$settings->get_option("ct_bf_first_name"));if($fn_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                    <label for="ct-first-name"><?php echo $label_language_values['first_name']; ?></label>
                                    <input type="text" name="ct_first_name" class="add_show_error_class error" id="ct-first-name" placeholder="<?php echo $label_language_values['your_first_name']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_first_name" id="ct-first-name" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $ln_check = explode(",",$settings->get_option("ct_bf_last_name"));if($ln_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                    <label for="ct-last-pass"><?php echo $label_language_values['last_name']; ?></label>
                                    <input type="text" class="add_show_error_class error" name="ct_last_name" id="ct-last-name" placeholder="<?php echo $label_language_values['your_last_name']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_last_name" id="ct-last-name" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $phone_check = explode(",",$settings->get_option("ct_bf_phone")); if($phone_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                    <label for="ct-user-phone"><?php echo $label_language_values['phone']; ?></label>
                                    <input type="tel" value="" id="ct-user-phone" class="add_show_error_class error" name="ct_user_phone"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_user_phone" id="ct-user-phone" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $address_check = explode(",",$settings->get_option("ct_bf_address"));if($address_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
                                    <label for="ct-street-address"><?php echo $label_language_values['street_address']; ?></label>
                                    <input type="text" name="ct_street_address" id="ct-street-address" class="add_show_error_class error" placeholder="<?php echo $label_language_values['street_address_placeholder']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_street_address" id="ct-street-address" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $zip_check = explode(",",$settings->get_option("ct_bf_zip_code"));if($zip_check[0] == 'on'){ ?>
								<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_zip_code_class">
                                    <label for="ct-zip-code"><?php echo $label_language_values['zip_code']; ?></label>
                                    <input type="text" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" placeholder="<?php echo $label_language_values['zip_code_placeholder']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $city_check = explode(",",$settings->get_option("ct_bf_city")); if($city_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_city_class">
                                    <label for="ct-city"><?php echo $label_language_values['city']; ?></label>
                                    <input type="text" name="ct_city" id="ct-city" class="add_show_error_class error" placeholder="<?php echo $label_language_values['city_placeholder']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_city" id="ct-city" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $state_check = explode(",",$settings->get_option("ct_bf_state")); if($state_check[0] == 'on'){ ?>
                                <div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_state_class">
                                    <label for="ct-state"><?php echo $label_language_values['state']; ?></label>
                                    <input type="text" name="ct_state" id="ct-state" class="add_show_error_class error" placeholder="<?php echo $label_language_values['state_placeholder']; ?>"/>
                                </div>
								<?php } else {
									?>
									<input type="hidden" name="ct_state" id="ct-state" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								<?php $notes_check = explode(",",$settings->get_option("ct_bf_notes")); if($notes_check[0] == 'on'){ ?>
								<div class="ct-md-12 ct-xs-12 ct-form-row">
                                    <label for="ct-notes"><?php echo $label_language_values['special_requests_notes']; ?></label>
                                    <textarea id="ct-notes" class="add_show_error_class error" rows="10"></textarea>
                                </div>
								<?php } else {
									?>
									<input type="hidden" id="ct-notes" class="add_show_error_class error" value=""/>
									<?php 
								} ?>
								

								<?php 
								if($settings->get_option('ct_vc_status')=="Y"){
									?>
                                <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-15">
                                    <label><?php echo $label_language_values['do_you_have_a_vaccum_cleaner']; ?></label>
                                    <ul class="ct-radio-list">
                                        <li>
                                            <input id="vaccum-yes" type="radio" checked="checked" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-Yes"/>
                                            <label for="vaccum-yes"><span></span><?php echo $label_language_values['yes']; ?></label>
                                        </li>
                                        <li>
                                            <input id="vaccum-no" type="radio" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-No"/>
                                            <label for="vaccum-no"><span></span><?php echo $label_language_values['no']; ?></label>
                                        </li>
                                    </ul>
                                </div>
								<?php }?>
								<?php 
								if($settings->get_option('ct_p_status')=="Y"){
									?>
                                <div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-10">
                                    <label><?php echo $label_language_values['do_you_have_parking']; ?></label>
                                    <ul class="ct-radio-list">
                                        <li>
                                            <input id="parking-yes" type="radio" checked="checked" class="input-radio p_status" name="parking" value="Parking-Yes"/>
                                            <label for="parking-yes"><span></span><?php echo $label_language_values['yes']; ?></label>
                                        </li>
                                        <li>
                                            <input id="parking-no" type="radio" class="input-radio p_status"
                                                   name="parking" value="Parking-No"/>
                                            <label for="parking-no"><span></span><?php echo $label_language_values['no']; ?></label>
                                        </li>

                                    </ul>
                                </div>
								<?php }?>
								<?php if($settings->get_option('ct_company_willwe_getin_status') != "" &&  $settings->get_option('ct_company_willwe_getin_status') == "Y"){?>
                                <div class="ct-options-new ct-md-12 ct-xs-12 mb-10 ct-form-row">
                                    <label><?php echo $label_language_values['how_will_we_get_in']; ?></label>

                                    <div class="ct-option-select">
                                        <select class="ct-option-select" id="contact_status">
                                            <option value="I'll be at home"><?php echo $label_language_values['i_will_be_at_home']; ?></option>
                                            <option value="Please call me"><?php echo $label_language_values['please_call_me']; ?></option>
                                            <option value="The key is with the doorman"><?php echo $label_language_values['the_key_is_with_the_doorman']; ?></option>
                                            <option value="Other"><?php echo $label_language_values['other']; ?></option>
                                        </select>
                                    </div>
                                    <div class="ct-option-others ct-md-12 pt-10 np ct-xs-12 hidden">
                                        <input type="text" name="other_contact_status" class="add_show_error_class error" id="other_contact_status" placeholder="<?php echo $label_language_values['enter_your_other_option']; ?>"/>
                                    </div>
                                </div>
								<?php } ?>
								<div>
									
									<!--<label style="padding-left:18px;margin-top:7px;margin-bottom:7px;"><input id="app_copy_check" type="checkbox"> &nbsp; Same as physical address </label>-->
								
									
										<input type="hidden" value= "04031" name="app_zip_code" id="app-zip-code" class="add_show_error_class error" placeholder="<?php echo $label_language_values['zip_code_placeholder']; ?>"/>
										<input type="hidden" value="City Not Needed" name="app_city" id="app-city" class="add_show_error_class error" placeholder="<?php echo $label_language_values['city_placeholder']; ?>"/>
										<input type="hidden" value="State Not needed" name="app_state" id="app-state" class="add_show_error_class error" placeholder="<?php echo $label_language_values['state_placeholder']; ?>"/>
										<input type="hidden" value="Address Not Needed" id="app-street-address" name="app_street_address" class="add_show_error_class error" placeholder="<?php echo $label_language_values['street_address_placeholder']; ?>">
									</div>
                            </div>
                    </div>
                    <!-- main details end -->
                </div>
                <!-- end personal details -->
                <!-- payment details -->

                <div class="ct-payment-main ct-common-box hide_allsss">
                    <!-- Promocodes -->
                    <?php
                    if ($settings->get_option('ct_show_coupons_input_on_checkout') == 'on') {
                        ?>
                        <div class="ct-discount-coupons ct-md-12">
                            <div class="ct-form-rown">
                                <div class="ct-coupon-input ct-md-6 ct-sm-12 ct-xs-12 mt-10 mb-15 np">
                                    <input id="coupon_val" type="text" name="coupon_apply"
                                           class="ct-coupon-input-text hide_coupon_textbox"
                                           placeholder="<?php echo $label_language_values['have_a_promocode']; ?>" maxlength="22" onchange="myFunction()"/>
                                    <a href="javascript:void(0);" class="ct-apply-coupon ct-link hide_coupon_textbox"
                                       name="apply-coupon" id="apply_coupon"><?php echo $label_language_values['apply']; ?></a>
									      <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_promocode")!=''){?>
										<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_promocode");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
										<?php } ?>
                                    <label class="ct-error ofh coupon_invalid_error"></label>
                                    <!-- display coupon -->
                                    <div class="ct-display-coupon-code">
                                        <div class="ct-form-rown">
                                            <div class="ct-column ct-md-7 ct-xs-12 ofh">
                                                <label><?php echo $label_language_values['applied_promocode']; ?></label>
                                            </div>
                                            <div class="ct-coupon-value-main ct-md-5 ct-xs-12">
                                                <span class="ct-coupon-value border-2" id="display_code"></span>
                                                <img id="ct-remove-applied-coupon"
                                                     src="<?php echo SITE_URL; ?>/assets/images/ct-close.png"
                                                     class="reverse_coupon" title="<?php echo $label_language_values['remove_applied_coupon']; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
							<div class="ct-list-header">
                                <h3 class="header3"><?php echo $label_language_values['preferred_payment_method']; ?>
								  <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_payment_method")!=''){?>
								<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_payment_method");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
								<?php } ?>
								</h3>
								
                            </div>
                       
                        <div class="ct-main-payments fl">
                            <div class="payments-container f-l" id="ct-payments">
                                <label class="ct-error-msg"><?php echo $label_language_values['please_select_one_payment_method']; ?></label>
                                <label class="ct-error-msg ct-paypal-error" id="paypal_error"></label>

                                <div class="ct-custom-radio ct-payment-methods f-l">
                                    <ul class="ct-radio-list ct-all-pay-methods">
										<?php  if ($settings->get_option('ct_pay_locally_status') == 'on') { ?>
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
											<input type="radio" name="payment-methods" value="pay at venue" class="input-radio payment_gateway" id="pay-cash"  checked="checked"/>
											<label for="pay-cash" class="locally-radio"><span></span><?php echo $label_language_values['pay_locally']; ?></label>
                                        </li>
										
										<?php } ?>	
										
										<!-- bank transfer -->
										<?php  if ($settings->get_option('ct_bank_transfer_status') == 'Y' && ($settings->get_option('ct_bank_name') != '' || $settings->get_option('ct_account_name') != ''  || $settings->get_option('ct_account_number') != '' || $settings->get_option('ct_branch_code') != '' || $settings->get_option('ct_ifsc_code') != '' || $settings->get_option('ct_bank_description') != '')) { ?>
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="ct-bank-transer">
											<input type="radio" name="payment-methods" value="bank transfer" class="input-radio bank_transfer payment_gateway" id="bank-transer"  />
											<label for="bank-transer" class="locally-radio"><span></span><?php echo $label_language_values['bank_transfer']; ?></label>
                                        </li>
										<?php }?>
								
                                        <?php
                                        if ($settings->get_option('ct_paypal_express_checkout_status') == 'on') {
                                            ?>
                                           
                                            <li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
                                                <input type="radio" name="payment-methods" value="paypal"
                                                       class="input-radio payment_gateway" id="pay-paypal" checked="checked" />
                                                <label for="pay-paypal"  class="locally-radio"><span></span><?php echo $label_language_values['paypal']; ?><img src="<?php echo SITE_URL; ?>/assets/images/cards/paypal.png" class="ct-paypal-image" alt="PayPal"></label>
                                            </li>
                                        <?php
                                        } ?>
										
										<?php
										if ($settings->get_option('ct_payumoney_status') == 'Y') {
                                            ?>
                                           
                                            <li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
                                                <input type="radio" name="payment-methods" value="payumoney"
                                                       class="input-radio payment_gateway" id="payumoney" checked="checked" />
                                                <label for="payumoney"  class="locally-radio"><span></span> <?php echo $label_language_values['payumoney']; ?><!--<img src="<?php //echo SITE_URL; ?>/assets/images/cards/paypal.png" class="ct-paypal-image" alt="PayPal">--></label>
                                            </li>
                                        <?php
                                        } ?>
										 <?php if($settings->get_option('ct_authorizenet_status') == 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="card-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php  }  ?>
										<?php if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') == 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="stripe-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php  }  ?>
										<?php if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') == 'Y'){  ?>
										<!-- new added -->
										<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
											<input type="radio" name="payment-methods" value="2checkout-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
											<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
										</li>
										<?php  } ?>
	                                  </ul>
                                </div>
                            </div>
							
							
						  
							<div id="ct-pay-methods" class="payment-method-container f-l">

                                <div class="card-type-center f-l">
                                    <div class="common-payment-style hidden" <?php if ($settings->get_option('ct_authorizenet_status') == 'on' || $settings->get_option('ct_stripe_payment_form_status') == 'on' || $settings->get_option('ct_2checkout_status') == 'Y') { echo " style='display:block;' "; } ?> >
                                        <div class="payment-inner">
											<?php if($settings->get_option('ct_2checkout_status') == 'Y'){ ?>
											<input id="token" name="token" type="hidden" value="">
											<?php } ?>
                                            <div id="card-payment-fields" style="">
                                                <div class="ct-md-12 ct-xs-12 ct-header-bg">
                                                    <h4 class="header4"><?php echo $label_language_values['card_details']; ?></h4>
                                                    <img src="<?php echo SITE_URL; ?>/assets/images/cards/card-images.png" class="ct-stripe-image float-right" alt="Stripe" />
                                                </div>
                                                <div class="ct-md-12">
                                                    <label id="ct-card-payment-error" class="ct-error-msg ct-payment-error"><?php echo $label_language_values['invalid_card_number']; ?><?php echo $label_language_values['expiry_date_or_csv']; ?></label>  
												</div>
                                                <div class="ct-md-9 ct-sm-9 ct-xs-12 ct-card-details">
                                                    <div class="ct-form-row ct-md-12 ct-xs-12">
                                                        <label><?php echo $label_language_values['card_number']; ?></label>
                                                        <i class="icon-credit-card icons"></i>
                                                        <input class="cc-number ct-card-number" maxlength="20" size="20" data-stripe="number" type="tel">
                                                        <span class="card" aria-hidden="true"></span>

                                                    </div>

                                                    <div class="ct-form-row ct-md-8 ct-sm-8 ct-xs-12 ct-exp-mnyr">
                                                        <label><?php echo $label_language_values['expiry']; ?><?php echo $label_language_values['mm_yyyy']; ?></label>
                                                        <i class="icon-calendar icons"></i>
                                                        <input data-stripe="exp-month" class="cc-exp-month ct-exp-month" maxlength="2" type="tel" />/

                                                        <input data-stripe="exp-year" class="cc-exp-year ct-exp-year" maxlength="4" type="tel" />
                                                    </div>
                                                    <div class="ct-form-row ct-md-4 ct-sm-4 ct-xs-12 ct-stripe-cvc">
                                                        <label><?php echo $label_language_values['cvc']; ?></label>
                                                        <i class="icon-lock icons"></i>
                                                        <input type="password" maxlength="4" size="4" data-stripe="cvc" class="cc-cvc ct-cvc-code" type="tel"/>

                                                    </div>
                                                </div>
                                                <div class="ct-md-3 ct-sm-3 ct-xs-12 ct-lock-image">
                                                    <div class="ct-lock-img"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div> 	
							<!--  bank details popup -->
							<div id="ct-bank-transfer-box" class="payment-method-container f-l">
								<div class="card-type-center f-l">
                                    <div class="common-payment-style-bank-transfer hidden">
                                        <div class="payment-inner">
											<div id="card-payment-fields" style="">
                                                <div class="ct-md-12 ct-xs-12 ct-header-bg">
                                                    <h4 class="header4"><?php echo $label_language_values['bank_details']; ?></h4>
                                                </div>
                                                <div class="ct-md-12">
                                                    <table>
														<tbody>
															<?php if($settings->get_option('ct_bank_name') != "")
                {?>
                <tr class="dc_acc_name">
                 <th><strong><?php echo $label_language_values['bank_name']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_bank_name');?></span></td>
                </tr>
               <?php } 
               if($settings->get_option('ct_account_name') != "")
                {?>
                <tr class="dc_acc_name">
                 <th><strong><?php echo $label_language_values['account_name']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_account_name');?></span></td>
                </tr>
               <?php }
               if($settings->get_option('ct_account_number') != "")
                {?>
                <tr class="dc_acc_number">
                 <th><strong><?php echo $label_language_values['account_number']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_account_number');?></span></td>
                </tr>
               <?php } 
               if($settings->get_option('ct_branch_code') != "")
                {?>
                <tr class="dc_branch_code">
                 <th><strong><?php echo $label_language_values['branch_code']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_branch_code');?></span></td>
                </tr>
               <?php }
               if($settings->get_option('ct_ifsc_code') != "")
                {?>
                <tr class="dc_ifc_code">
                 <th><strong><?php echo $label_language_values['ifsc_code']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_ifsc_code');?></span></td>
                </tr>
               <?php }
               if($settings->get_option('ct_bank_description') != "")
                {?>
                <tr class="dc_ifc_code">
                 <th><strong><?php echo $label_language_values['bank_description']; ?></strong></th>
                 <td><span class="amount"><?php echo $settings->get_option('ct_bank_description');?></span></td>
                </tr>
                <?php } ?>				
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>	
                         
                        </div>
                  
                </div>
                <!-- end payment detials -->
            </div>
            <!-- left side end -->


            <!-- right side cart -->
            <div class="ct-main-right ct-sm-4 ct-md-4 ct-xs-12 mt-30 mb-30 br-5 pull-right hide_allsss">

         
                <div class="fl">
                    <div class="main-inner-container border-c ct-price-scroll" id="ct-price-scroll">
                        <div class="ct-step-heading"><h3 class="header3"><?php echo $label_language_values['booking_summary']; ?></h3></div>
                        <div class="ct-cart-wrapper f-l" id="">
                            <div class="ct-summary hideservice_name">
                             <p class="ct-text sel-service"></p>
                            </div>
                            <div class="ct-summary hidedatetime_value">
                                <div class="ct-image">
                                    <img src="<?php echo SITE_URL; ?>/assets/images/icon-calendar.png" alt="">
                                </div>
                                <p class="ct-text sel-datetime"><span class='cart_date' data-date_val=""></span><span
                                        class="space_between_date_time"> @ </span><span class='cart_time'
                                                                                        data-time_val=""></span></p>
                            </div>
                            <div class="ct-summary">
                                <div class="ct-image f_dis_img">
                                    <img src="<?php echo SITE_URL; ?>/assets/images/icon-frequency.png" alt="">
                                </div>
                                <p class="ct-text sel-datetime f_discount_name"></p>
                            </div>
                            <div class="ct-form-rown ct-addons-list-main">
                                <div class="step_heading f-l"><h6 class="header6 ct-item-list"><?php echo $label_language_values['your_cart_items']; ?></h6>
                                </div>
                                <div class="cart-items-main f-l">
                                    <label class="cart_empty_msg"><?php echo $label_language_values['your_cart_is_empty']; ?></label>
                                    <ul class="ct-addon-items-list cart_item_listing">

                                    </ul>
                                </div>
                            </div>
                            <div class="ct-form-rown">
                                <div class="ct-cart-label-common ofh"><?php echo $label_language_values['sub_total']; ?></div>
                                <div class="ct-cart-amount-common ofh">
                                    <span class="ct-sub-total cart_sub_total"></span>
                                </div>
                            </div>
                            <?php
                            $count_f_dis = $frequently_discount->readall_front();
                            if (mysqli_num_rows($count_f_dis) > 0) {
                                ?>
                                <div class="ct-form-rown freq_discount_display">
                                    <div class="ct-cart-label-common ofh"><?php echo ucwords(strtolower($label_language_values['frequently_discount'])); ?></div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-frequently-discount frequent_discount"></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($settings->get_option('ct_show_coupons_input_on_checkout') == 'on') {
                                ?>
                                <div class="ct-form-rown coupon_display">
                                    <div class="ct-cart-label-common ofh"><?php echo $label_language_values['coupon_discount']; ?></div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-coupon-discount cart_discount"></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if ($settings->get_option('ct_tax_vat_status') == 'Y') {
                                ?>
                                <div class="ct-form-rown">
                                    <div class="ct-cart-label-common ofh"><?php echo $label_language_values['tax']; ?></div>
                                    <div class="ct-cart-amount-common ofh">
                                        <span class="ct-tax-amount cart_tax"></span>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="ct-clear"></div>
                            <div id="ct-line"></div>
                            <div class="ct-form-rown">
                                <div class="ct-cart-label-total-amount ofh"><?php echo $label_language_values['total']; ?></div>
                                <div class="ct-cart-total-amount ofh">
                                    <span class="ct-total-amount cart_total"></span>
                                </div>
                            </div>

                            <div class="ct-clear"></div>
                            <!-- discount coupons -->
                        </div>
                        <!-- cart wrapper end here -->


                    </div>
                </div>
                <!-- features -->
                <?php
                if ($settings->get_option('ct_partial_deposit_status') == 'Y' || $settings->get_option('ct_allow_front_desc') == 'Y') {
                    ?>
                    <div
                        class="main-inner-container ct-static-right-side border-c <?php if ($settings->get_option('ct_partial_deposit_status') == 'Y' && $settings->get_option('ct_allow_front_desc') == 'N') {
                            echo ' hide_right_side_box';
                        } ?>" id="ct-not-scroll">

                        <div class="ct-cart-wrapper f-l">
                            <div class="main-inner-container">
                                <!--  partial amount pay -->
                                <?php
                                if ($settings->get_option('ct_partial_deposit_status') == 'Y' && $settings->get_option('ct_stripe_payment_form_status') == 'off' && $settings->get_option('ct_pay_locally_status') == 'on' && $settings->get_option('ct_paypal_express_checkout_status') == 'off' && $settings->get_option('ct_2checkout_status') == 'N' && $settings->get_option('ct_payumoney_status') == 'N' && $settings->get_option('ct_authorizenet_status') != 'on'){
                                    echo '';
                                } else {
                                    if ($settings->get_option('ct_partial_deposit_status') == 'Y') {
                                        ?>
                                        <div class="ct-form-rown partial_amount_hide_on_load mb-15">
                                            <div class="ct-partial-amount-wrapper border-c border-2">
                                                <div class="ct-partial-amount-message">
                                                    <?php echo $settings->get_option('ct_partial_deposit_message'); ?>
                                                </div>
                                                <div class="ct-form-rown">
                                                    <div class="ct-cart-label-common ofh"><?php echo $label_language_values['partial_deposit']; ?></div>
                                                    <div class="ct-cart-amount-common ofh">
                                                        <span class="ct-partial-deposit partial_amount"></span>
                                                    </div>
                                                </div>
                                                <div class="ct-form-rown">
                                                    <div class="ct-cart-label-common ofh"><?php echo $label_language_values['remaining_amount']; ?></div>
                                                    <div class="ct-cart-amount-common ofh">
                                                        <span class="ct-remaining-amount remain_amount"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                                ?>
                                <div class="mb-30"></div>
                                <?php if ($settings->get_option('ct_allow_front_desc') == 'Y') { ?>
                                    <div class="features-list">
                                        <?php 
                                        $var = $settings->get_option('ct_front_desc');
                                        echo eval("?>" . $var . "<?php "); ?>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- right side card end -->

            <!-- conditions and complete booking details -->
            <div class="ct-complete-booking-main ct-sm-7 ct-md-7 mb-30 ct-xs-12 hide_allsss">

                <div class="ct-list-header">
   
                    <p class="ct-sub-complete-booking"></p>
                </div>
				<?php if ($settings->get_option('ct_cancelation_policy_status') == 'Y') { ?>

                <div class="ct-complete-booking ct-md-12">
                    <h5 class="ct-cancel-booking"><?php echo $label_language_values['cancellation_policy']; ?></h5>

                    <div class="ct-cancel-policy">
                        <p><?php echo $settings->get_option('ct_cancel_policy_header'); ?></p>
                        <span class="show-more-toggler ct-link"><?php echo $label_language_values['show_more']; ?></span>
                        <ul class="bullet-more">
                            <li><?php echo $settings->get_option('ct_cancel_policy_textarea'); ?></li>
                        </ul>
                    </div>
                </div>
				<?php } ?>

                <?php if ($settings->get_option('ct_allow_terms_and_conditions') == 'Y' || $settings->get_option('ct_allow_privacy_policy') == 'Y') { ?>
                    <div class="bi-terms-agree ct-md-12">
                        <div class="ct-custom-checkbox">
                            <ul class="ct-checkbox-list">
                                <li>
                                    <input type="checkbox" name="accept-conditions" class="input-radio"
                                           id="accept-conditions"/>
                                    <label for="accept-conditions" class="">
                                        <span></span>
                                        <?php echo $label_language_values['i_have_read_and_accepted_the']; ?>
                                        <?php if ($settings->get_option('ct_allow_terms_and_conditions') == 'Y' && $settings->get_option('ct_allow_privacy_policy') == 'N') { ?>
                                            <a href="<?php if ($settings->get_option('ct_terms_condition_link') != '') { echo $settings->get_option('ct_terms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php if ($settings->get_option('ct_terms_condition_link') != ''){ ?> target="-BLANK" <?php } ?> class="ct-link">
                                                <?php echo $label_language_values['terms_and_condition']; ?>
                                            </a>.
                                        <?php } else if ($settings->get_option('ct_allow_terms_and_conditions') == 'N' && $settings->get_option('ct_allow_privacy_policy') == 'Y') { ?>
                                            <a href="<?php if ($settings->get_option('ct_privacy_policy_link') != ''){ echo $settings->get_option('ct_privacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php if ($settings->get_option('ct_privacy_policy_link') != ''){ ?> target="-BLANK" <?php } ?> class="ct-link"><?php echo $label_language_values['privacy_policy']; ?></a>.
                                        <?php } else { ?>
                                            <a href="<?php if ($settings->get_option('ct_terms_condition_link') != ''){ echo $settings->get_option('ct_terms_condition_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php if ($settings->get_option('ct_terms_condition_link') != ''){ ?> target="-BLANK" <?php } ?> class="ct-link"><?php echo $label_language_values['terms_and_condition']; ?></a>
                                            <?php echo $label_language_values['and']; ?>
                                            <a href="<?php if ($settings->get_option('ct_privacy_policy_link') != '') { echo $settings->get_option('ct_privacy_policy_link'); }else{ echo 'javascript:void(0)'; } ?>" <?php if ($settings->get_option('ct_privacy_policy_link') != ''){ ?> target="-BLANK" <?php } ?> class="ct-link"><?php echo $label_language_values['privacy_policy']; ?></a>.
                                        <?php } ?>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <label class="terms_and_condition"></label>
                    </div>
                <?php } ?>
                <div class="ta-center fl">
					<div class="ct-loading-main-complete_booking">
						<div class="loader-complete_booking">Loading...</div>
					</div>
                    <a href="javascript:void(0)" type='submit' data-currency_symbol="<?php echo $settings->get_option('ct_currency_symbol'); ?>" id='complete_bookings' class="ct-button ct-btn-big ct_remove_id"><?php echo $label_language_values['complete_booking'];?></a>
                </div>
            </div>

            </form>
            <a href="javascript:void(0)" class="ct-back-to-top br-2"><i class="icon-arrow-up icons"></i></a>
            <?php
			if($settings->get_option('ct_payumoney_status') == 'Y'){
			?>
            <form action="https://secure.paygate.co.za/payweb3/process.trans" method="post" name="payuForm" id="payuForm">
            <!--<form action="https://test.payu.in/_payment" method="post" name="payuForm" id="payuForm">-->
				<input type="hidden" name="PAY_REQUEST_ID" id="payu_email" value="" />
				<input type="hidden" name="CHECKSUM" id="payu_hash" value=""/>
			</form>
			<?php
			}
			?>
        </div>
        <!-- end container -->
    </div>
    
    <!-- forget password -->
    <div class="main">
        <div id="ct-front-forget-password">

            <div class="vertical-alignment-helper">
                <div class="vertical-align-center">
                    <div class="ct-front-forget-password visible">
                        <div class="form-container">
                            <div class="tab-content">
                                <form id="forget_pass" name="" method="POST">
                                    <h1 class="forget-password"><?php echo $label_language_values['reset_password']; ?></h1>
                                    <h4><?php echo $label_language_values['enter_your_email_and_we_send_you_instructions_on_resetting_your_password']; ?></h4>

                                    <div class="form-group fl mt-15">
                                        <label for="userEmail"><i class="icon-envelope-alt"></i><?php echo $label_language_values['email']; ?></label>
                                        <input type="email" class="add_show_error_class error" id="rp_user_email" name="rp_user_email" placeholder="<?php echo $label_language_values['registered_email']; ?>">
                                    </div>
                                    <label class="forget_pass_correct"></label>
                                    <label class="forget_pass_incorrect"></label>

                                    <div class="clearfix">
                                        <a class="btn ct-info-btn btn-lg ct-xs-12" href="javascript:void(0)"
                                           id="reset_pass"><?php echo $label_language_values['send_mail']; ?></a>
                                    </div>
                                    <div class="clearfix">
                                        <a class="btn btn-link ct-xs-12" id="ct_login_user" href="javascript:void(0)"><?php echo $label_language_values['back_to_login']; ?></a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
	
    var baseurlObj = {'base_url': '<?php echo BASE_URL;?>','stripe_publishkey':'<?php echo $settings->get_option('ct_stripe_publishablekey');?>','stripe_status':'<?php echo $settings->get_option('ct_stripe_payment_form_status');?>'};
    var siteurlObj = {'site_url': '<?php echo SITE_URL;?>'};
    var ajaxurlObj = {'ajax_url': '<?php echo AJAX_URL;?>'};
    var fronturlObj = {'front_url': '<?php echo FRONT_URL;?>'};
    var termsconditionObj = {'terms_condition': '<?php echo $settings->get_option('ct_allow_terms_and_conditions');?>'};
    var privacypolicyObj = {'privacy_policy': '<?php echo $settings->get_option('ct_allow_privacy_policy');?>'};
    <?php
    
	if($settings->get_option('ct_thankyou_page_url') == ''){
        $thankyou_page_url = SITE_URL.'front/thankyou.php';
    }else{
        $thankyou_page_url = $settings->get_option('ct_thankyou_page_url');
    }
	$phone = explode(",",$settings->get_option('ct_bf_phone'));
	$check_password = explode(",",$settings->get_option('ct_bf_password'));
	$check_fn = explode(",",$settings->get_option('ct_bf_first_name'));
	$check_ln = explode(",",$settings->get_option('ct_bf_last_name'));
	$check_addresss = explode(",",$settings->get_option('ct_bf_address'));
	$check_zip_code = explode(",",$settings->get_option('ct_bf_zip_code'));
	$check_city = explode(",",$settings->get_option('ct_bf_city'));
	$check_state = explode(",",$settings->get_option('ct_bf_state'));
	$check_notes = explode(",",$settings->get_option('ct_bf_notes'));
	
    ?>
	var thankyoupageObj = {'thankyou_page': '<?php echo $thankyou_page_url;?>'};
    
	var phone_status = {'statuss' : '<?php echo $phone[0];?>','required' : '<?php echo $phone[1];?>','min' : '<?php echo $phone[2];?>','max' : '<?php echo $phone[3];?>'};  
	
    var check_password = {'statuss' : '<?php echo $check_password[0];?>','required' : '<?php echo $check_password[1];?>','min' : '<?php echo $check_password[2];?>','max' : '<?php echo $check_password[3];?>'};
    
	var check_fn = {'statuss' : '<?php echo $check_fn[0];?>','required' : '<?php echo $check_fn[1];?>','min' : '<?php echo $check_fn[2];?>','max' : '<?php echo $check_fn[3];?>'};
    
	var check_ln = {'statuss' : '<?php echo $check_ln[0];?>','required' : '<?php echo $check_ln[1];?>','min' : '<?php echo $check_ln[2];?>','max' : '<?php echo $check_ln[3];?>'};
    
	var check_addresss = {'statuss' : '<?php echo $check_addresss[0];?>','required' : '<?php echo $check_addresss[1];?>','min' : '<?php echo $check_addresss[2];?>','max' : '<?php echo $check_addresss[3];?>'};
    
	var check_zip_code = {'statuss' : '<?php echo $check_zip_code[0];?>','required' : '<?php echo $check_zip_code[1];?>','min' : '<?php echo $check_zip_code[2];?>','max' : '<?php echo $check_zip_code[3];?>'};
    
	var check_city = {'statuss' : '<?php echo $check_city[0];?>','required' : '<?php echo $check_city[1];?>','min' : '<?php echo $check_city[2];?>','max' : '<?php echo $check_city[3];?>'};
    
	var check_state = {'statuss' : '<?php echo $check_state[0];?>','required' : '<?php echo $check_state[1];?>','min' : '<?php echo $check_state[2];?>','max' : '<?php echo $check_state[3];?>'};
    
	var check_notes = {'statuss' : '<?php echo $check_notes[0];?>','required' : '<?php echo $check_notes[1];?>','min' : '<?php echo $check_notes[2];?>','max' : '<?php echo $check_notes[3];?>'}; 
    <?php
	$nacode = explode(',',$settings->get_option("ct_company_country_code"));
	$allowed = $settings->get_option("ct_phone_display_country_code");
	?>
	var countrycodeObj = {'numbercode': '<?php echo $nacode[0];?>', 'alphacode': '<?php echo $nacode[1];?>', 'countrytitle': '<?php echo $nacode[2];?>', 'allowed': '<?php echo $allowed;?>'};
 
    var subheaderObj = {'subheader_status': '<?php echo $settings->get_option('ct_subheaders');?>'};
    var twocheckout_Obj = {'sellerId': '<?php echo $settings->get_option('ct_2checkout_sellerid');?>', 'publishKey': '<?php echo $settings->get_option('ct_2checkout_publishkey');?>', 'twocheckout_status': '<?php echo $settings->get_option('ct_2checkout_status'); ?>'};
</script>
</body>
</html>