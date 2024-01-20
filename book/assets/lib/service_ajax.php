<?php include(dirname(dirname(dirname(__FILE__)))."/objects/class_connection.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_services.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_addon.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_services_addon_rates.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_design_settings.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_setting.php");include(dirname(dirname(dirname(__FILE__)))."/header.php");$con = new cleanto_db();$conn = $con->connect();$objservice = new cleanto_services();$objservice->conn = $conn;$objservice_addon = new cleanto_services_addon();$objservice_addon->conn = $conn;$objservice_addon_rate = new cleanto_services_addon_rates();$objservice_addon_rate->conn = $conn;$objdesignset = new cleanto_design_settings();$objdesignset->conn = $conn;$settings = new cleanto_setting();$settings->conn = $conn;$lang = $settings->get_option("ct_language");$label_language_values = "";$language_label_arr = $settings->get_all_labelsbyid($lang);if ($language_label_arr[1] != ""){    $label_language_arr_first = $language_label_arr[1];	$label_explode = explode("###",$label_language_arr_first);		$label_decode_front = base64_decode($label_explode[0]);	$label_decode_admin = base64_decode($label_explode[1]);	$label_decode_error = base64_decode($label_explode[2]);    $label_decode_extra = base64_decode($label_explode[3]);				$label_decode_front_unserial = unserialize($label_decode_front);	$label_decode_admin_unserial = unserialize($label_decode_admin);	$label_decode_error_unserial = unserialize($label_decode_error);	$label_decode_extra_unserial = unserialize($label_decode_extra);    	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);		$label_language_values = array();	foreach($label_language_arr as $key => $value){		$label_language_values[$key] = urldecode($value);	}}else{    $default_language_arr = $settings->get_all_labelsbyid("en");    	$label_language_arr_first = $default_language_arr[1];	$label_explode = explode("###",$label_language_arr_first);		$label_decode_front = base64_decode($label_explode[0]);	$label_decode_admin = base64_decode($label_explode[1]);	$label_decode_error = base64_decode($label_explode[2]);    $label_decode_extra = base64_decode($label_explode[3]);				$label_decode_front_unserial = unserialize($label_decode_front);	$label_decode_admin_unserial = unserialize($label_decode_admin);	$label_decode_error_unserial = unserialize($label_decode_error);	$label_decode_extra_unserial = unserialize($label_decode_extra);    	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);		$label_language_values = array();	foreach($label_language_arr as $key => $value){		$label_language_values[$key] = urldecode($value);	}}if(isset($_POST['pos']) && isset($_POST['ids'])){    echo "yes in ";    echo count($_POST['ids']);    for($i=0;$i<count($_POST['ids']);$i++)    {        $objservice->position=$_POST['pos'][$i];        $objservice->id=$_POST['ids'][$i];        $objservice->updateposition();    }}else if(isset($_POST['deleteid'])){    $objservice->id=$_POST['deleteid'];    chmod(dirname(dirname(dirname(__FILE__)))."/assets/images/services", 0777);	    /* CODE TO DELETE ADDONS AND SERVICE IMAGE BEFORE DELETE SERVICE FORM TABLE */    $addons = $objservice->get_exist_addons_by_serviceid($_POST['deleteid']);	$methods = $objservice->get_exist_methods_by_serviceid($_POST['deleteid']);	while($r = mysqli_fetch_array($addons)){		unlink(dirname(dirname(dirname(__FILE__)))."/assets/images/services/".$r['image']);		$addons_rates = $objservice->get_exist_addons_rate_by_addonid($r['id']);		while($t = mysqli_fetch_array($addons_rates))		{			/* DELETE ADDONS RATE */			$objservice->delete_addons_rate($t['id']);		}		/* DELETE ADDONS */		$objservice->delete_addons_of_service($r['id']);	}	while($r = mysqli_fetch_array($methods)){		$methods_units = $objservice->get_exist_methods_units_by_methodid($r['id']);		while($t = mysqli_fetch_array($methods_units))		{			$methods_units_rate = $objservice->get_exist_methods_units_rate_by_unitid($t['id']);			while($mur = mysqli_fetch_array($methods_units_rate))			{				/* Service method unit rate delete */				$objservice->delete_service_method_unit_rate($mur['id']);			}			/* Service method unit delete */			$objservice->delete_method_unit($t['id']);		}	   		/* Service method delete */		$objservice->delete_method($r['id']);	}    $objservice->delete_service();}elseif(isset($_POST['changestatus'])){    $objservice->id=$_POST['id'];    $objservice->status = $_POST['changestatus'];    $objservice->changestatus();	if($objservice){		if($_POST['changestatus']=='E'){             echo $label_language_values['service_enable'];		}else{             echo $label_language_values['service_disable'];		}	}}elseif(isset($_POST['operationadd'])){    chmod(dirname(dirname(dirname(__FILE__)))."/assets/images/services", 0777);    $objservice->title = $_POST['title'];    $t = $objservice->check_same_title();    $cnt = mysqli_num_rows($t);    if($cnt == 0){        $objservice->color = $_POST['color'];        $objservice->title = mysqli_real_escape_string($conn,ucwords($_POST['title']));        $objservice->description = mysqli_real_escape_string($conn,$_POST['description']);        $objservice->status = $_POST['status'];        $objservice->position = $_POST['position'];        $insertid = $objservice->add_service();        $objservice->image = $_POST['image'];        $objservice->update_recordfor_image($insertid);        /* REMOVE UNSED IMAGES FROM FOLDER */        $used_images = $objservice->get_used_images();        $imgarr = array();        while($img  = mysqli_fetch_array($used_images)){            $filtername = preg_replace('/\\.[^.\\s]{3,4}$/', '', $img[0]);            array_push($imgarr,$filtername);        }        array_push($imgarr,"default");        array_push($imgarr,"default_service");        array_push($imgarr,"default_service1");        print_r($imgarr);        $dir = dirname(dirname(dirname(__FILE__)))."/assets/images/services/";        $cnt = 1;        if ($dh = opendir($dir)) {            while (($file = readdir($dh)) !== false) {                if($cnt > 2){                    $filtername = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);                    if (in_array($filtername, $imgarr)) {                    }                    else{                        unlink(dirname(dirname(dirname(__FILE__)))."/assets/images/services/".$file);                    }                }                $cnt++;            }            closedir($dh);        }    }    else{       echo "1";    }}elseif(isset($_POST['operationedit'])){    chmod(dirname(dirname(dirname(__FILE__)))."/assets/images/services", 0777);    $objservice->id = $_POST['id'];    $objservice->color = $_POST['color'];    $objservice->title = mysqli_real_escape_string($conn,ucwords($_POST['title']));    $objservice->description = mysqli_real_escape_string($conn,$_POST['description']);    $objservice->image = $_POST['image'];    $objservice->update_service();    /* REMOVE UNSED IMAGES FROM FOLDER */    $used_images = $objservice->get_used_images();    $imgarr = array();    while($img  = mysqli_fetch_array($used_images)){        $filtername = preg_replace('/\\.[^.\\s]{3,4}$/', '', $img[0]);        array_push($imgarr,$filtername);    }    array_push($imgarr,"default");    array_push($imgarr,"default_service");    array_push($imgarr,"default_service1");    print_r($imgarr);    $dir = dirname(dirname(dirname(__FILE__)))."/assets/images/services/";    $cnt = 1;    if ($dh = opendir($dir)) {        while (($file = readdir($dh)) !== false) {            if($cnt > 2){                $filtername = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);                if (in_array($filtername, $imgarr)) {                }                else{                    unlink(dirname(dirname(dirname(__FILE__)))."/assets/images/services/".$file);                }            }            $cnt++;        }        closedir($dh);    }}elseif(isset($_POST['assigndesign'])){    $objdesignset->title=$_POST['divname'];    $objdesignset->design=$_POST['designid'];    $having = $objdesignset->readone();    if(count($having[0])>0)    {        $objdesignset->update_setting_design();    }    else    {        $objdesignset->add_setting_design();    }}/*Delete Service Image*/if(isset($_POST['action']) && $_POST['action']=='delete_image'){    $objservice->id=$_POST['service_id'];    $objservice->image="";    $del_image=$objservice->update_image();}?>