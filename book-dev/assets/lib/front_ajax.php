<?php 

session_start();
include(dirname(dirname(dirname(__FILE__))).'/header.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_users.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_order_client_info.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_setting.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_services.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_addon.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_addon_rates.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_methods.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_service_methods_design.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_methods_units.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_design_settings.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');


$database= new cleanto_db();
$conn=$database->connect();
$database->conn=$conn;


$first_step=new cleanto_first_step();
$first_step->conn=$conn;


$general=new cleanto_general();
$general->conn=$conn;

$user=new cleanto_users();
$order_client_info=new cleanto_order_client_info();
$settings=new cleanto_setting();

$user->conn=$conn;
$order_client_info->conn=$conn;
$settings->conn=$conn;

$objservice = new cleanto_services();
$addons = new cleanto_services_addon();
$addons_rates = new cleanto_services_addon_rates();
$objservice->conn = $conn;
$addons->conn = $conn;
$addons_rates->conn = $conn;

$objservice_method = new cleanto_services_methods();
$objservice_method->conn = $conn;
$objservice_method_design = new cleanto_service_methods_design();
$objservice_method_design->conn = $conn;

$objservice_method_unit = new cleanto_services_methods_units();
$objservice_method_unit->conn = $conn;

$objdesignset = new cleanto_design_settings();
$objdesignset->conn = $conn;

$symbol_position=$settings->get_option('ct_currency_symbol_position');
$decimal=$settings->get_option('ct_price_format_decimal_places');

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
		
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
$calculation_policy = $settings->get_option("ct_calculation_policy");
if(isset($_POST['s_m_units_maxlimit_5'])){
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $maxx_limitts = $objservice_method_unit->get_maxlimit_by_service_methods_ids();
	$mmnameee = 'ad_unit'.$maxx_limitts['id'];
    ?>
    <div class="ct-list-header">
        <h3 class="header3"><?php echo $label_language_values['your']; ?> <?php echo $maxx_limitts['units_title'] ?></h3>
    </div>
    <div class="ct-address-area-main">
        <div class="ct-area-type">
            <span class="area-header"><?php echo ucwords($maxx_limitts['units_title']); ?></span>
            <input maxlength="5" type="text" class="ct-area-input ct_area_m_units_rattee" id="ct_area_m_units" data-service_id="<?php echo $_POST['service_id']; ?>" data-units_id="<?php echo $maxx_limitts['id']; ?>"  data-method_id="<?php echo $_POST['method_id']; ?>" data-rate="" data-method_name="<?php echo $maxx_limitts['units_title'] ?>" data-maxx_limit="<?php echo $maxx_limitts['maxlimit']; ?>" placeholder="<?php echo ucwords($maxx_limitts['units_title']); ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"/>
            <span class="area-type"></span>
        </div>
    </div>
    <span class="error_of_max_limitss error"></span>
    <span class="error_of_invalid_area error"></span>

<?php
}else if(isset($_POST['action']) && $_POST['action']=='get_existing_user_data'){
    $user->existing_username=trim(strip_tags(mysqli_real_escape_string($conn,$_POST['existing_username'])));
    $user->existing_password=md5($_POST['existing_password']);
    $existing_login=$user->check_login();
    if(!$existing_login){
        $u_msg=array();
        $u_msg['status']="Incorrect Email Address or Password";
        echo json_encode($u_msg);die();
    }else{
        unset($_SESSION['adminid']);
        $_SESSION['login_user_id']=$existing_login[0];
        $_SESSION['user_email']=$existing_login[1];

        $u_msg=array();
        $u_msg['status']="Login Sucessfull";
        $u_msg['id']=$existing_login[0];
        $u_msg['email']=$existing_login[1];
        $u_msg['password']=$_POST['existing_password'];
        $u_msg['firstname']=$existing_login[3];
        $u_msg['lastname']=$existing_login[4];
        $u_msg['phone']=$existing_login[5];
        $u_msg['zip']=$existing_login[6];
        $u_msg['address']=$existing_login[7];
        $u_msg['city']=$existing_login[8];
        $u_msg['state']=$existing_login[9];
        $u_msg['notes']=$existing_login[10];
        $u_msg['vc_status']=$existing_login[11];
        $u_msg['p_status']=$existing_login[12];
        $u_msg['contact_status']=$existing_login[13];

        echo json_encode($u_msg);die();
    }
}/* code for logout frontend */
elseif(isset($_POST['action']) && $_POST['action']=='logout'){
    if(isset($_SESSION['login_user_id'])){
        unset($_SESSION['login_user_id']);
        unset($_SESSION['user_email']);
        echo "logout successful";
    }
}
/* get methods in dropdown on click of service */
elseif(isset($_POST['operationgetmethods']))
{
	$service_array = array("method"=>array());
    $_SESSION['ct_cart'] = $service_array;
    $objservice_method->service_id = $_POST['service_id'];
    $res = $objservice_method->methodsbyserviceid_front();

    $json_array=array();
    if(mysqli_num_rows($res) <= 1){
        $arr = mysqli_fetch_array($res);
        $json_array['m_html'] = "<div class='service-method-selection-main'>
			<div class='service-method-is' title='".$label_language_values['choose_your_service']."'>
				<div class='ct-service-method-list select_service_method s_method_names'>
					<h3 class='service-method-name s_m_units_design ser_mthd_units dis_metd_name".$arr['id']."' data-id='".$arr['id']."' data-methoddss='".$arr['method_title']."' data-service_id='".$_POST['service_id']."' >".$arr['method_title']."</h3>
				</div>
			</div>
		</div>";
        $json_array['status']='single';
        echo json_encode($json_array);
    }else{
        $html = "";
        $html .='<div class="service-method-selection-main">
							<div class="service-method-is" title="'.$label_language_values['choose_your_service'].'">
								<div class="ct-service-method-list" id="ct_selected_servic_method">
									<h3 class="service-method-name">'.$label_language_values['service_usage_methods'].'</h3>
								</div>
							</div>
							
							<div class="ct-services-method-dropdown s_method_names">';
        while($arr = mysqli_fetch_array($res)){

            $html .="<div class='ct-service-method-list select_service_method s_method_names'>
			<h3 class='service-method-name s_m_units_design ser_mthd_units dis_metd_name".$arr['id']."' data-id='".$arr['id']."' data-methoddss='".$arr['method_title']."' data-service_id='".$_POST['service_id']."' >".$arr['method_title']."</h3>
		</div>";
        }
        $html .= '</div></div>';
        $json_array['m_html'] = $html;
        $json_array['status']='multiple';
        echo json_encode($json_array);
    }
}
/* get add-on on click of service */
elseif(isset($_POST['get_service_addons'])) {
	
    $addons->service_id=$_POST['service_id'];
    $addons_data=$addons->readall_from_service();
    if(mysqli_num_rows($addons_data) > 0){
		?>
		<script>
		jQuery(document).ready(function() {
			jQuery('.ct-tooltip-addon').tooltipster({
				animation: 'grow',
				delay: 20,
				theme: 'tooltipster-shadow',
				trigger: 'hover'
			});
		});
		</script>
        <div class="ct-list-header">
            <h3 class="header3"><?php echo $label_language_values['extra_services']; ?></h3>
			 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_addons_services")!=''){?>
			<a class="ct-tooltip-addon" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_addons_services");?>."><i class="fa fa-info-circle fa-lg"></i></a>	
			<?php } ?>
            <p class="ct-sub"><?php echo $label_language_values['for_initial_cleaning_only_contact_us_to_apply_to_recurrings']; ?></p>
        </div>
        <?php
        if($settings->get_option('ct_addons_default_design') == 1){
            ?>

            <ul class="addon-service-list fl remove_addonsss">
                <?php
                if(mysqli_num_rows($addons_data) > 0){
                    while($adonsdata =mysqli_fetch_array($addons_data)){
                        $addons_rates->addon_service_id=$adonsdata['service_id'];
                        $addonrates_data=$addons_rates->readone_from_serviceid();
                        /* CHANGED BY ME FROM Y TO N */
                        if($adonsdata['multipleqty'] == 'N'){
                            $mmnameee = 'ad_unit'.$adonsdata['id'];

                            ?>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox add_addon_in_cart_for_multipleqty" data-status="2" data-duration_value="-1" data-id="<?php echo $adonsdata['id']; ?>" id="ct-addon-<?php echo $adonsdata['id']; ?>" data-rate="<?php echo $adonsdata['base_price']; ?>" data-service_id="<?php echo $adonsdata['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $adonsdata['addon_service_name']; ?>" data-units_id="<?php echo $adonsdata['id']; ?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>" />
                                <label class="ct-addon-ser border-c ct_addon_ser<?php echo $adonsdata['id']; ?>" for="ct-addon-<?php echo $adonsdata['id']; ?>"><span></span>
                                    <div class="addon-price"><?php echo $general->ct_price_format($adonsdata['base_price'],$symbol_position,$decimal); ?></div>
                                    <div class="ct-addon-img">
                                        <img src="
                                        <?php
                                        if($adonsdata['image'] == '' && $adonsdata['predefine_image'] == ''){
                                            echo SITE_URL.'/assets/images/services/default.png';
                                        }
                                        else if($adonsdata['image'] == '')
                                        {
                                            echo SITE_URL.'/assets/images/addons-images/'.$adonsdata['predefine_image'];
                                        }
                                        else
                                        {
                                            echo SITE_URL.'/assets/images/services/'.$adonsdata['image'];
                                        } ?>" /></div>


                                </label>
                                <div class="addon-name fl ta-c"><?php echo $adonsdata['addon_service_name']; ?></div>
                            </li>
                        <?php
                        }else{
                            $mmnameee = 'ad_unit'.$adonsdata['id'];
                            ?>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess" data-status="2" data-id="<?php echo $adonsdata['id']; ?>" id="ct-addon-<?php echo $adonsdata['id']; ?>" data-mnamee="<?php echo $mmnameee; ?>" data-service_id="<?php echo $adonsdata['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $adonsdata['addon_service_name']; ?>"/>
                                <label class="ct-addon-ser border-c ct_addon_ser<?php echo $adonsdata['id']; ?>" for="ct-addon-<?php echo $adonsdata['id']; ?>"><span></span>
                                    <div class="addon-price"><?php echo $general->ct_price_format($adonsdata['base_price'],$symbol_position,$decimal); ?></div>
                                    <div class="ct-addon-img">
                                        <img src="
                                        <?php
                                        if($adonsdata['image'] == '' && $adonsdata['predefine_image'] == ''){
                                            echo SITE_URL.'/assets/images/services/default.png';
                                        }
                                        else if($adonsdata['image'] == '')
                                        {
                                            echo SITE_URL.'/assets/images/addons-images/'.$adonsdata['predefine_image'];
                                        }
                                        else
                                        {
                                            echo SITE_URL.'/assets/images/services/'.$adonsdata['image'];
                                        }?>" /></div>


                                </label>
                                <div class="addon-name fl ta-c"><?php echo $adonsdata['addon_service_name']; ?></div>
                            </li>
                        <?php
                        }
                    }
                }else{
                    ?>
                    <p class="ct-sub"><?php echo $label_language_values['extra_services_not_available']; ?></p>
                <?php
                }
                ?>
            </ul>
            <div class="addons_counting">
            </div>
        <?php
        }else{
            ?>
            <ul class="addon-service-list fl remove_addonsss">
                <?php
                if(mysqli_num_rows($addons_data) > 0){
                    while($adonsdata =mysqli_fetch_array($addons_data)){
                        $addons_rates->addon_service_id=$adonsdata['service_id'];
                        $addonrates_data=$addons_rates->readone_from_serviceid();
                        /* CHANGED BY ME FROM Y TO N */
                        if($adonsdata['multipleqty'] == 'N'){
                            $mmnameee = 'ad_unit'.$adonsdata['id'];
                            ?>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15">
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox add_addon_in_cart_for_multipleqty" data-status="2" data-duration_value="-1" data-id="<?php echo $adonsdata['id']; ?>" id="ct-addon-<?php echo $adonsdata['id']; ?>" data-rate="<?php echo $adonsdata['base_price']; ?>" data-service_id="<?php echo $adonsdata['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $adonsdata['addon_service_name']; ?>" data-units_id="<?php echo $adonsdata['id']; ?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>" />
                                <label class="ct-addon-ser border-c ct_addon_ser<?php echo $adonsdata['id']; ?>" for="ct-addon-<?php echo $adonsdata['id']; ?>"><span></span>
                                    <div class="addon-price"><?php echo $general->ct_price_format($adonsdata['base_price'],$symbol_position,$decimal); ?></div>
                                    <div class="ct-addon-img">
                                        <img src="<?php
                                        if($adonsdata['image'] == '' && $adonsdata['predefine_image'] == ''){
                                            echo SITE_URL.'/assets/images/services/default.png';
                                        }
                                        else if($adonsdata['image'] == '')
                                        {
                                            echo SITE_URL.'/assets/images/addons-images/'.$adonsdata['predefine_image'];
                                        }
                                        else
                                        {
                                            echo SITE_URL.'/assets/images/services/'.$adonsdata['image'];
                                        }
                                        ?>" /></div>
                                </label>
                                <div class="addon-name fl ta-c"><?php echo $adonsdata['addon_service_name']; ?></div>
                            </li>
                        <?php
                        }else{
                            ?>
                            <li class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 mb-15 add_addon_class_selected">
                                <?php
                                $mmnameee = 'ad_unit'.$adonsdata['id'];
                                ?>
                                <input type="checkbox" name="addon-checkbox" class="addon-checkbox addons_servicess_2" data-id="<?php echo $adonsdata['id']; ?>" id="ct-addon-<?php echo $adonsdata['id']; ?>"  data-mnamee="<?php echo $mmnameee; ?>"/>
                                <label class="ct-addon-ser border-c" for="ct-addon-<?php echo $adonsdata['id']; ?>"><span></span>
                                    <div class="addon-price"><?php echo $general->ct_price_format($adonsdata['base_price'],$symbol_position,$decimal); ?></div>
                                    <div class="ct-addon-img"><img src="<?php
                                        if($adonsdata['image'] == '' && $adonsdata['predefine_image'] == ''){
                                            echo SITE_URL.'/assets/images/services/default.png';
                                        }
                                        else if($adonsdata['image'] == '')
                                        {
                                            echo SITE_URL.'/assets/images/addons-images/'.$adonsdata['predefine_image'];
                                        }
                                        else
                                        {
                                            echo SITE_URL.'/assets/images/services/'.$adonsdata['image'];
                                        } ?>" /></div>

                                </label>
                                <div class="ct-addon-count border-c  add_minus_button add_minus_buttonid<?php echo $adonsdata['id']; ?>">

                                    <?php
                                    $addons_rates->maxlimit=1;
                                    $addons_rates->addon_service_id=$adonsdata['id'];
                                    $unt_ratess = $addons_rates->get_rate_by_service_addon_ids();
                                    if($unt_ratess){
                                        $uniitt_rate=$unt_ratess['rate'];
                                    }else{
                                        $uniitt_rate=$adonsdata['base_price'];
                                    }
									$mmnameee = 'ad_unit'.$adonsdata['id'];
                                    ?>
                                    <div class="ct-btn-group">
                                        <button data-ids="<?php echo $adonsdata['id']; ?>" id="minus<?php echo $adonsdata['id']; ?>" class="minus ct-btn-left ct-small-btn" type="button" data-units_id="<?php echo $adonsdata['id']; ?>" data-duration_value="" data-mnamee="<?php echo $mmnameee; ?>" data-method_name="<?php echo $adonsdata['addon_service_name'] ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-rate="" data-method_id="0" data-type="<?php echo "addon"; ?>">-</button>

                                        <input type="text" value="0" class="ct-btn-text addon_qty data_addon_qtyrate qtyyy_<?php echo $mmnameee; ?>" data-rate="<?php echo $uniitt_rate; ?>"/>

                                        <button data-ids="<?php echo $adonsdata['id']; ?>" id="add<?php echo $adonsdata['id']; ?>" data-db-qty="<?php echo $adonsdata["maxqty"]; ?>" data-mnamee="<?php echo $mmnameee; ?>" class="add ct-btn-right float-right ct-small-btn" type="button" data-units_id="<?php echo $adonsdata['id']; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="0" data-duration_value="" data-method_name="<?php echo $adonsdata['addon_service_name'] ?>" data-rate="" data-type="<?php echo "addon"; ?>">+</button>
                                    </div>
                                </div>
                                <div class="addon-name fl ta-c"><?php echo $adonsdata['addon_service_name']; ?></div>
                            </li>
                        <?php
                        }
                    }
                }else{
                    ?>
                    <p class="ct-sub"><?php echo $label_language_values['extra_services_not_available']; ?></p>
                <?php
                }
                ?>
            </ul>
        <?php
        }
    }else{
        echo "Extra Services Not Available";
    }
} else if(isset($_POST['get_service_addons_qtys'])){
    $addons->id=$_POST['addon_id'];
    $addon_dataaa=$addons->readone();
    ?>
    <div class="addon-services-count remove_addonsss remove_addon_intensive<?php echo $_POST['addon_id']; ?>">
        <div class="ct-addon-extra-count fl ct-md-12 mb-15 mt-5 np">
            <h5 class="header5"><?php echo $addon_dataaa["addon_service_name"]; ?></h5>
            <div class="ct-common-addon-list">
                <?php
                $mmnameee = 'ad_unit'.$addon_dataaa['id'];
                if($addon_dataaa["maxqty"] == 0){
                    ?>
                    <span class="ct-addon-box">
						<a class="br-3"><?php echo $label_language_values['no_intensive']; ?></a>
					</span>
                <?php
                }else{
                    $fe = 0;
                    $fg= 0;
                    $strate = 1;
                    for($i = 1; $i <= $addon_dataaa["maxqty"]; $i++) {
                        $addons_rates->maxlimit=$i;
                        $addons_rates->addon_service_id=$addon_dataaa['id'];
                        $unt_ratess = $addons_rates->get_rate_by_service_addon_ids();

                        if($unt_ratess['rules']=='G')
                        {
                            $strate=$unt_ratess['rate'];
                            $fg = 1;
                            $fe=0;
                        }
                        if($fg == 1)
                        {
                            if($unt_ratess['rules'] == 'E')
                            {
                                ?>
                                <span class="ct-addon-box">
									<a href="javascript:void(0);" class="br-3 ct-addon-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rate']*$i : $unt_ratess['rates']; ?>" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $addon_dataaa['id']; ?>" data-service_id="<?php echo $addon_dataaa['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $addon_dataaa['addon_service_name'];?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>" ><?php echo $i; ?></a>
								</span>
                            <?php
                            }else{
                                ?>
                                <span class="ct-addon-box">
									<a href="javascript:void(0);" class="br-3 ct-addon-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $strate*$i : $strate; ?>" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $addon_dataaa['id']; ?>" data-service_id="<?php echo $addon_dataaa['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $addon_dataaa['addon_service_name'];?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
								</span>
                            <?php
                            }
                        }
                        else if($unt_ratess['rules'] == 'E')
                        {
                            ?>
                            <span class="ct-addon-box">
								<a href="javascript:void(0);" class="br-3 ct-addon-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rate']*$i : $unt_ratess['rate']; ?>" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $addon_dataaa['id']; ?>" data-service_id="<?php echo $addon_dataaa['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $addon_dataaa['addon_service_name'];?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
							</span>
                        <?php
                        }
                        else
                        {
							if($calculation_policy == "M")
							{
								$base_rates=$addon_dataaa['base_price']*$i;
							}
							else 
							{
								$base_rates=$addon_dataaa['base_price'];
							}
                            
                            ?>
                            <span class="ct-addon-box">
								<a href="javascript:void(0);" class="br-3 ct-addon-btn add_item_in_cart" data-rate="<?php echo $base_rates; ?>" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $addon_dataaa['id']; ?>" data-service_id="<?php echo $addon_dataaa['service_id']; ?>" data-method_id="0" data-method_name="<?php echo $addon_dataaa['addon_service_name'];?>" data-type="<?php echo "addon"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
							</span>
                        <?php
                        }
                    }
                    ?>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
} elseif(isset($_POST['select_s_m_units_design'])){
    $service_array = array("method"=>array());
    $_SESSION['ct_cart'] = $service_array;
    echo $design_values = $objservice_method_design->get_service_methods_design($_POST['service_methods_id']);
} elseif(isset($_POST['s_m_units_maxlimit'])){
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $unt_values = $objservice_method_unit->get_maxlimit_by_service_methods_ids();
	$mmnameee = 'ad_unit'.$unt_values['id'];

    $fe = 0;
    $fg= 0;
    $strate = 1;
    ?>
    <h5 class="header5"><?php echo $unt_values['units_title'];?></h5>
    <div class="ct-duration-list">
        <?php
        for($i = 1; $i <= $unt_values['maxlimit']; $i++) {
            $objservice_method_unit->maxlimit=$i;
            $objservice_method_unit->units_id=$unt_values['id'];
            $unt_ratess = $objservice_method_unit->get_rate_by_service_methods_ids();

            if($unt_ratess['rules']=='G')
            {
                $strate=$unt_ratess['rates'];
                $fg = 1;
                $fe=0;
            }
            if($fg == 1)
            {
                if($unt_ratess['rules'] == 'E')
                {
					?>
                    <span class="duration-box">
						<a href="javascript:void(0);" class="br-3 ct-duration-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-units_id="<?php echo $unt_values['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values['units_title'] ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
					</span>
                    <?php
                    /* print the rate given in db*/
                }else{
                    /* print the rate of the previous one */
                    ?>
                    <span class="duration-box">
						<a href="javascript:void(0);" class="br-3 ct-duration-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $strate*$i : $strate; ?>" data-units_id="<?php echo $unt_values['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values['units_title'] ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
					</span>
                <?php
                }
            }
            else if($unt_ratess['rules'] == 'E')
            {
                ?>
                <span class="duration-box">
					<a href="javascript:void(0);" class="br-3 ct-duration-btn add_item_in_cart" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-units_id="<?php echo $unt_values['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values['units_title'] ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
				</span>
                <?php
            }
            else
            {
				if($calculation_policy == "M")
				{
					$base_rates=$unt_values['base_price']*$i; 
				}
				else 
				{
					$base_rates=$unt_values['base_price'];
				} 
                ?>
				<span class="duration-box">
					<a href="javascript:void(0);" class="br-3 ct-duration-btn add_item_in_cart" data-rate="<?php echo $base_rates; ?>" data-units_id="<?php echo $unt_values['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values['units_title'] ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
				</span>
            <?php
            }
        }
        ?>
    </div>
<?php
} elseif(isset($_POST['s_m_units_maxlimit_2'])){
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $unt_valuess_2 = $objservice_method_unit->getunits_by_service_methods_front();
    while($unt_values_2 = mysqli_fetch_array($unt_valuess_2)){
        $mmnameee = 'ad_unit'.$unt_values_2['id'];

        $fe = 0;
        $fg= 0;
        $strate = 1;
        ?>

        <div class="ct-bedrooms ct-btn-group ct-md-6 ct-sm-6 mb-15 ">
            <label> <?php echo $unt_values_2['units_title']; ?></label>
            <div class="common-selection-main">
                <div class="selected-is select-bedrooms" data-mnamee="<?php echo $mmnameee; ?>" data-un_title="<?php echo $unt_values_2['units_title']; ?>" data-un_id="<?php echo $unt_values_2['id']; ?>" title="<?php echo $label_language_values['choose_your']." ".$unt_values_2['units_title']; ?>">
                 
                    <div class="data-list" id="ct_selected_<?php echo $unt_values_2['id']; ?>">
                        <p class="ct-count"><?php echo $unt_values_2['units_title']; ?></p>
                    </div>
                </div>
             
                <div class="common-data-dropdown ct-<?php echo $unt_values_2['id']; ?>-dropdown">
                    <?php
                    for($i = 1; $i <= $unt_values_2['maxlimit']; $i++) {
                        $objservice_method_unit->maxlimit=$i;
                        $objservice_method_unit->units_id=$unt_values_2['id'];
                        $unt_ratess = $objservice_method_unit->get_rate_by_service_methods_ids();

                        if($unt_ratess['rules']=='G')
                        {
                            $strate=$unt_ratess['rates'];
                            $fg = 1;
                            $fe=0;
                        }
                        if($fg == 1)
                        {
                            if($unt_ratess['rules'] == 'E')
                            {
                                ?>
                                <div class="data-list select_bedroom add_item_in_cart" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $unt_values_2['id']; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_2['units_title'] ?>" data-un_title="<?php echo $unt_values_2['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">
                                    <p class="ct-count"><?php echo $i; ?></p>
                                </div>
                                <?php
                                /* print the rate given in db */
                            }else{
                                /* print the rate of the previous one */
                                ?>
                                <div class="data-list select_bedroom add_item_in_cart" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $unt_values_2['id']; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_2['units_title'] ?>" data-un_title="<?php echo $unt_values_2['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $strate*$i : $strate; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">
                                    <p class="ct-count"><?php echo $i; ?></p>
                                </div>
                            <?php
                            }
                        }
                        else if($unt_ratess['rules'] == 'E')
                        {
                            ?>
                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $unt_values_2['id']; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_2['units_title'] ?>" data-un_title="<?php echo $unt_values_2['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">
                                <p class="ct-count"><?php echo $i; ?></p>
                            </div>
                            <?php
                        }
                        else
                        {
							if($calculation_policy == "M")
							{
								$base_rates=$unt_values_2['base_price']*$i; 
							}
							else 
							{
								$base_rates=$unt_values_2['base_price'];
							} 
                            ?>
                            <div class="data-list select_bedroom add_item_in_cart" data-duration_value="<?php echo $i; ?>" data-units_id="<?php echo $unt_values_2['id']; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_2['units_title'] ?>" data-un_title="<?php echo $unt_values_2['units_title']; ?>" data-rate="<?php echo $base_rates; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">
                                <p class="ct-count"><?php echo $i; ?></p>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    <?php
    }
} elseif(isset($_POST['s_m_units_maxlimit_3'])){
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $unt_valuess_3 = $objservice_method_unit->getunits_by_service_methods_front();
    while($unt_values_3 = mysqli_fetch_array($unt_valuess_3)){
        $fe = 0;
        $fg= 0;
        $strate = 1;
        ?>

        <div class="ct-bedrooms ct-btn-group fl ct-md-12 mt-5 mb-15 np">
            <h5 class="header5"> <?php echo $unt_values_3['units_title']; ?></h5>
            <div class="ct-bedroom-list" >
                <?php
                for($i = 1; $i <= $unt_values_3['maxlimit']; $i++) {
                    $objservice_method_unit->maxlimit=$i;
                    $objservice_method_unit->units_id=$unt_values_3['id'];
                    $unt_ratess = $objservice_method_unit->get_rate_by_service_methods_ids();

                    $mmnameee = 'ad_unit'.$unt_values_3['id'];
                    if($unt_ratess['rules']=='G')
                    {
                        $strate=$unt_ratess['rates'];
                        $fg = 1;
                        $fe=0;
                    }
                    if($fg == 1)
                    {
                        if($unt_ratess['rules'] == 'E')
                        {
                            ?>
                            <span class="ct-box bedroom-box">
								<a href="javascript:void(0);" class="br-3 ct-bedroom-btn select_m_u_btn u_<?php echo $unt_values_3['id']; ?>_btn add_item_in_cart" data-units_id="<?php echo $unt_values_3['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_3['units_title'] ?>" data-un_title="<?php echo $unt_values_3['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
							</span>
                        <?php
                        }else{
                            ?>
                            <span class="ct-box bedroom-box">
								<a href="javascript:void(0);" class="br-3 ct-bedroom-btn select_m_u_btn u_<?php echo $unt_values_3['id']; ?>_btn add_item_in_cart" data-units_id="<?php echo $unt_values_3['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_3['units_title'] ?>" data-un_title="<?php echo $unt_values_3['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $strate*$i : $strate; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
							</span>
                        <?php
                        }
                    }
                    else if($unt_ratess['rules'] == 'E')
                    {
                        ?>
                        <span class="ct-box bedroom-box">
							<a href="javascript:void(0);" class="br-3 ct-bedroom-btn select_m_u_btn u_<?php echo $unt_values_3['id']; ?>_btn add_item_in_cart" data-units_id="<?php echo $unt_values_3['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_3['units_title'] ?>" data-un_title="<?php echo $unt_values_3['units_title']; ?>" data-rate="<?php echo ($calculation_policy == "M") ? $unt_ratess['rates']*$i : $unt_ratess['rates']; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
						</span>
                    <?php
                    }
                    else
                    {
						if($calculation_policy == "M")
						{
							$base_rates=$unt_values_3['base_price']*$i; 
						}
						else 
						{
							$base_rates=$unt_values_3['base_price'];
						}
                        ?>
                        <span class="ct-box bedroom-box">
							<a href="javascript:void(0);" class="br-3 ct-bedroom-btn select_m_u_btn u_<?php echo $unt_values_3['id']; ?>_btn add_item_in_cart" data-units_id="<?php echo $unt_values_3['id']; ?>" data-duration_value="<?php echo $i; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" data-method_name="<?php echo $unt_values_3['units_title'] ?>" data-un_title="<?php echo $unt_values_3['units_title']; ?>" data-rate="<?php echo $base_rates; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>"><?php echo $i; ?></a>
						</span>
                    <?php
                    }
                }
                ?>
            </div>
        </div>

    <?php
    }
} elseif(isset($_POST['s_m_units_maxlimit_4'])){
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $unt_values_4 = $objservice_method_unit->getunits_by_service_methods_front();
    while($u_value_4 = mysqli_fetch_array($unt_values_4)){
        $objservice_method_unit->maxlimit=1;
        $objservice_method_unit->units_id=$u_value_4['id'];
        $unt_ratess = $objservice_method_unit->get_rate_by_service_methods_ids();

        if($unt_ratess){
            $uniitt_rate=$unt_ratess['rates'];
        }else{
            $uniitt_rate=$u_value_4['base_price'];
        }
        ?>
        <div class="ct-bedrooms ct-btn-group ct-md-6 ct-sm-6">
            <label> <?php echo $u_value_4['units_title']; ?></label>
            <?php
            $mmnameee = 'ad_unit'.$u_value_4['id'];
            ?>
            <button id="minus-addon-<?php echo $u_value_4['id']; ?>" data-ids="<?php echo $u_value_4['id']; ?>" class="minuss ct-btn-left ct-small-btn" data-units_id="<?php echo $u_value_4['id']; ?>" data-duration_value="" data-method_name="<?php echo $u_value_4['units_title'] ?>" type="button" data-service_id="<?php echo $_POST['service_id']; ?>" data-rate="" data-method_id="<?php echo $_POST['method_id']; ?>" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">-</button>
            <input id="qty<?php echo $u_value_4['id']; ?>" type="text" value="0" class="qty<?php echo $u_value_4['id']; ?> ct-btn-text data_qtyrate" data-rate="<?php echo $uniitt_rate; ?>" />
            <button id="add-addon-<?php echo $u_value_4['id']; ?>" data-units_id="<?php echo $u_value_4['id']; ?>"  data-ids="<?php echo $u_value_4['id']; ?>" data-db-qty="<?php echo $u_value_4["maxlimit"]; ?>" data-service_id="<?php echo $_POST['service_id']; ?>" data-method_id="<?php echo $_POST['method_id']; ?>" class="addd ct-btn-right float-right ct-small-btn" data-duration_value="" data-method_name="<?php echo $u_value_4['units_title'] ?>" data-rate="" type="button" data-type="<?php echo "method_units"; ?>" data-mnamee="<?php echo $mmnameee; ?>">+</button>
        </div>
    <?php
    }
}
elseif(isset($_POST['s_m_units_maxlimit_4_ratesss'])){
    $objservice_method_unit->id = $_POST['units_id'];
    $objservice_method_unit->services_id = $_POST['service_id'];
    $objservice_method_unit->methods_id = $_POST['method_id'];
    $unt_values_4_rate = $objservice_method_unit->get_maxlimit_by_service_methods_ids_baseratess();

    $fe = 0;
    $fg= 0;
    $strate = 1;
    $finalvalue=0;
	$calculation_policy = $settings->get_option("ct_calculation_policy");
    for($i = 1; $i <= $_POST['qty_vals']; $i++) {
        $objservice_method_unit->maxlimit=$i;
        $objservice_method_unit->units_id=$_POST['units_id'];
        $unt_ratess = $objservice_method_unit->get_rate_by_service_methods_ids();

        if($unt_ratess['rules']=='G')
        {
            $strate=$unt_ratess['rates'];
            $fg = 1;
            $fe=0;
        }
        if($fg == 1)
        {
            if($unt_ratess['rules'] == 'E')
            {
				if($calculation_policy == "M"){
					$finalvalue=$unt_ratess['rate']*$i;
				}
				else {
					$finalvalue=$unt_ratess['rate'];
				}
            }else{
                if($calculation_policy == "M"){
					$finalvalue=$strate*$i;
				}
				else {
					$finalvalue=$strate;
				}
				
            }
        }
        else if($unt_ratess['rules'] == 'E')
        {
            if($calculation_policy == "M"){
				$finalvalue=$unt_ratess['rates']*$i;
			}
			else {
				$finalvalue=$unt_ratess['rates'];
			}
			
        }
        else
        {
			if($calculation_policy == "M"){
				$base_rates=$unt_values_4_rate['base_price']*$i;
			}
			else {
				$base_rates=$unt_values_4_rate['base_price'];
			}
            $finalvalue=$base_rates;
        }
    }
    echo $finalvalue;
} elseif(isset($_POST['s_addon_units_maxlimit_4_ratesss'])){
    $addons->id=$_POST['addon_id'];
    $addon_dataaa=$addons->readone();

    $fe = 0;
    $fg= 0;
    $strate = 1;
    $finalvalue=0;
	$calculation_policy = $settings->get_option("ct_calculation_policy");
    for($i = 1; $i <= $_POST['qty_vals']; $i++) {
        $addons_rates->maxlimit=$i;
        $addons_rates->addon_service_id=$addon_dataaa['id'];
        $unt_ratess = $addons_rates->get_rate_by_service_addon_ids();

        if($unt_ratess['rules']=='G')
        {
            $strate=$unt_ratess['rate'];
            $fg = 1;
            $fe=0;
        }
        if($fg == 1)
        {
            if($unt_ratess['rules'] == 'E')
            {
				if($calculation_policy == "M"){
					$finalvalue=$unt_ratess['rate']*$i;
				}
				else {
					$finalvalue=$unt_ratess['rate'];
				}
            }else{
				if($calculation_policy == "M"){
					$finalvalue=$strate*$i;
				}
				else {
					$finalvalue=$strate;
				}
            }
        }
        else if($unt_ratess['rules'] == 'E')
        {
			if($calculation_policy == "M"){
				$finalvalue=$unt_ratess['rate']*$i;
			}
			else {
				$finalvalue=$unt_ratess['rate'];
			}
        }
        else
        {
			if($calculation_policy == "M"){
				$base_rates=$addon_dataaa['base_price']*$i;
			}
			else {
				$base_rates=$addon_dataaa['base_price'];
			}
            
            $finalvalue=$base_rates;
        }
    }
    echo $finalvalue;
} elseif(isset($_POST['get_postal_code'])){
    @ob_clean();
    ob_start();
    $postal_code_list =$settings->get_option_postal();
    $res = explode(',',strtolower($postal_code_list));
	$check = 1;
	$p_code = strtolower($_POST['postal_code']);
	
	for($i = 0;$i<=(count($res)-1);$i++){
		if($res[$i] == $p_code){
			 $j = 10;
			 echo "found";
			 break;
		}
		elseif(substr($p_code, 0, strlen($res[$i])) === $res[$i]){
			$j = 10;
			echo "found";
			break;
		}
		else{
			$j = 20;
		}
	}
	if($j==20){
		echo "not found";	
	}
}
if(isset($_POST['select_language'])){
	$_SESSION['current_lang'] = $_POST['set_language'];
}
?>