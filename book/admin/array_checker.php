<?php 

$extra_labels = array(
"please_enter_minimum_3_chars"=>urlencode("Please enter minimum 3 Characters"),
"invoice"=>urlencode("août"),
"invoice_to"=>urlencode("INVOICE TO"),
"invoice_date"=>urlencode("Invoice Date"),
"cash"=>urlencode("CASH"),
"service_name"=>urlencode("Service Name"),
"qty"=>urlencode("Qty"),
"booked_on"=>urlencode("Booked On"));
$language_extra_arr = base64_encode(serialize($extra_labels));
$language_admin_arr = base64_encode(serialize($extra_labels));
$languagearr = $language_extra_arr."###".$language_admin_arr;

echo "<br>";

$label_language_arr_first = $languagearr;
$label_explode = explode("###",$label_language_arr_first);

$label_decode_admin = base64_decode($label_explode[0]);
$label_decode_extra = base64_decode($label_explode[1]);

$label_decode_admin_unserial = unserialize($label_decode_admin);
$label_decode_extra_unserial = unserialize($label_decode_extra);

$label_language_arr = array_merge($label_decode_admin_unserial,$label_decode_extra_unserial);

$label_language_values = $label_language_arr;

$label_language_values = array();
foreach($label_language_values as $key => $value){
	$label_language_values[$key] = urldecode($value);
}
print_r($label_language_values);
?>