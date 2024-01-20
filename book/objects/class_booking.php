<?php 

class cleanto_booking{
	public $booking_date_time;
	public $method_id;
	public $method_unit_id;
	public $method_unit_qty;
	public $method_unit_qty_rate;
	public $addons_service_id;
	public $addons_service_qty;
	public $addons_service_rate; 
	public $booking_id;
    public $location_id;
    public $order_id;
    public $client_id;
    public $provider_id;
    public $service_id;
    public $booking_price;
    public $booking_start_datetime;
    public $booking_end_datetime;
    public $booking_status;
    public $reject_reason;
    public $cancel_reason;
    public $reminder_status;
    public $lastmodify;
    public $read_status;
    public $user_id;
    public $startdate;
    public $enddate;
    public $order_date;
    public $start_date;
    public $end_date;
    public $conn;
    public $table_name="ct_bookings";
    public $tablename1="ct_services";
    public $tablename2="ct_order_client_info";
    public $tablename3="ct_users";
    public $tablename4="ct_payments";
	public $tablename5="ct_booking_addons";
	
    /*
    * Function for add Booking
    *
    */
	public function add_booking(){
		$query="insert into ".$this->table_name." (`id`,`order_id`,`client_id`,`order_date`,`booking_date_time`,`service_id`,`method_id`,`method_unit_id`,`method_unit_qty`,`method_unit_qty_rate`,`booking_status`,`reject_reason`,`reminder_status`,`lastmodify`,`read_status`,`staff_ids`) values(NULL,'".$this->order_id."','".$this->client_id."','".$this->order_date."','".$this->booking_date_time."','".$this->service_id."','".$this->method_id."','".$this->method_unit_id."','".$this->method_unit_qty."','".$this->method_unit_qty_rate."','".$this->booking_status."','".$this->reject_reason."','".$this->reminder_status."','".$this->lastmodify."','".$this->read_status."','')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);	
		return $value;
	}
	/**/
	public function add_addons_booking(){
		$query="insert into ".$this->tablename5." (`id`,`order_id`,`service_id`,`addons_service_id`,`addons_service_qty`,`addons_service_rate`) values(NULL,'".$this->order_id."','".$this->service_id."','".$this->addons_service_id."','".$this->addons_service_qty."','".$this->addons_service_rate."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);	
		return $value;
	}
    /*
    * Function for Update Booking
    *
    */
    public function update(){
        $query="update ".$this->table_name." set order_id='".$this->order_id."',business_id='".$this->business_id."',client_id='".$this->client_id."',service_id='".$this->service_id."',provider_id='".$this->provider_id."',booking_price='".$this->booking_price."',booking_datetime='".$this->booking_datetime."',booking_endtime='".$this->booking_endtime."',booking_status='".$this->booking_status."',reject_reason='".$this->reject_reason."',cancel_reason='".$this->cancel_reason."',reminder='".$this->reminder."',lastmodify='"."' where id='".$this->booking_id."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /*
    * Function for Read All Booking
    *
    */
    public function readall(){
        $query="select * from ".$this->table_name;
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    public function getallbookings(){
        $query = "SELECT * FROM ct_bookings,ct_services,ct_payments
                        WHERE
                        ct_bookings.order_id = ct_payments.order_id and
						DATE(ct_bookings.booking_date_time) >= (DATE(NOW()) - INTERVAL 6 MONTH) and
                        ct_bookings.service_id = ct_services.id GROUP BY ct_bookings.order_id ORDER BY ct_bookings.order_id DESC";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /*
    * Function for Read One Booking
    *
    */
    public function readone(){
        $query="select * from ".$this->table_name." where id='".$this->booking_id."'";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_row($result);
        return $value;
    }
    /*Function to Get Last order id from booking table used in front end for add cart item in booking table*/
    public function last_booking_id(){
        $query="select max(order_id) from ".$this->table_name;
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_row($result);
        return $value[0];
    }
    
    public function confirm_booking(){
        $query="update ".$this->table_name." set booking_status='".$this->booking_status."' where id='".$this->booking_id."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    public function update_reject_status(){
        $query="update ".$this->table_name." set booking_status='R',read_status='U',lastmodify='".$this->lastmodify."',reject_reason='".$this->reject_reason."' where order_id='".$this->order_id."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /* Used in booking_ajax */
    public function count_order_id_bookings(){
        $query="select count(order_id) as ordercount from ".$this->table_name." where id='".$this->order_id."'";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value;
    }
    /* used in booking_ajax */
    public function delete_booking(){
        $query="delete from ".$this->table_name." where id='".$this->booking_id."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /* used for delete appointments in booking_ajax */
    public function delete_appointments(){
        $query="delete ct_bookings.*,ct_payments.*,ct_order_client_info.* from ct_bookings INNER JOIN ct_payments,ct_order_client_info where ct_bookings.order_id=ct_payments.order_id and ct_bookings.order_id=ct_order_client_info.order_id and ct_bookings.order_id='".$this->order_id."' ";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    
    /* thi smethod is used in export page to list all bookings */
    public function get_all_bookings()
    {
        $query = "select * from ct_bookings GROUP BY order_id  ORDER BY order_id ";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /* get all bookings details from the order_id */
    public function get_detailsby_order_id($orderid){
       $query = "select
b.booking_status,b.booking_date_time,s.title as service_title,p.net_amount,sm.method_title,oci.client_name,oci.client_email,oci.client_personal_info,p.payment_method,oci.client_phone
from
ct_bookings as b,ct_services as s,ct_payments as p,ct_services_method as sm,ct_order_client_info as oci
where
b.service_id = s.id
and
b.order_id = p.order_id
and
b.method_id = sm.id
and
b.order_id = '".$orderid."'
and
b.order_id = oci.order_id
GROUP BY b.order_id";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value;
    }
    /* CODE FOR DISPLAY DETIAL IN POPUP */
    public function get_booking_details_appt($orderid){
        $query = "select
b.booking_status,b.booking_date_time,p.net_amount,oci.client_name,oci.client_email,oci.client_personal_info,p.payment_method,oci.client_phone,s.title as service_title from
ct_bookings as b,ct_payments as p,ct_order_client_info as oci,ct_services as s
where b.order_id = p.order_id
and b.order_id = '".$orderid."'
and b.order_id = oci.order_id
and b.service_id = s.id
GROUP BY b.order_id";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value;
    }
    
    public function get_payment_details($orderid){
        $query = "select p.partial_amount, p.payment_date,b.booking_status,b.booking_date_time,p.net_amount,oci.client_name,oci.client_email,oci.client_personal_info,p.payment_method,oci.client_phone,s.title as service_title from
ct_bookings as b,ct_payments as p,ct_order_client_info as oci,ct_services as s
where b.order_id = p.order_id
and b.order_id = '".$orderid."'
and b.order_id = oci.order_id
and b.service_id = s.id
GROUP BY b.order_id";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value;
    }
    
    /* CODE FOR DISPLAY DETIAL IN POPUP  END */
    public function getdatabyorder_id($orderid){
        $query = "select * from ct_bookings where order_id = '".$orderid."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /* get all methods and units of the bookings */
    public function get_methods_ofbookings($orderid){
        $query = "select b.method_unit_qty as qtys,sm.*,smu.* from ct_bookings as b,ct_services_method as sm,ct_service_methods_units as smu where b.method_id = sm.id and b.method_unit_id = smu.id and b.order_id ='".$orderid."'";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
    /* get all addons services of bookings */
    public function get_addons_ofbookings($orderid){
        $query = "select ba.*,sa.* from ct_bookings as b,ct_booking_addons as ba,ct_services_addon as sa where b.order_id = ba.order_id and ba.addons_service_id = sa.id and b.order_id = '".$orderid."' GROUP BY ba.addons_service_id";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
	
	/*Use function for Invoice Purpose*/
		public function get_details_for_invoice_client(){
			$query="select b.order_id as invoice_number,b.booking_date_time as start_time,b.order_date as invoice_date,b.service_id as sid,b.client_id as cid from ct_bookings as b,ct_payments as p,ct_order_client_info as oc where b.order_id='".$this->order_id."' and b.order_id=p.order_id and b.order_id=oc.order_id ";
			$result=mysqli_query($this->conn,$query);
			$value=mysqli_fetch_row($result);
			return $value;
		}
	/* Get Client Info from user table */	
		public function get_client_info(){
			$query="select * from ".$this->tablename3." where id='".$this->client_id."'";
			$result=mysqli_query($this->conn,$query);
			$value=mysqli_fetch_row($result);
			return $value;
		}
		
		/* Booking readall */
		public function readall_bookings(){
			$query="select * from ".$this->table_name." where order_id='".$this->order_id."'";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}
	public function email_reminder(){
       $query="select * from ".$this->table_name." where (reminder_status='0' OR reminder_status='') and booking_status='A' GROUP BY order_id";
       $result=mysqli_query($this->conn,$query);
		return $result;
	}
	public function update_reminder_booking($id){
       $query="update ".$this->table_name." set reminder_status='1' where id='".$id."'";
       $result=mysqli_query($this->conn,$query);
       return $result;
	}
    public function getalldetail_for_reminder($orderid){
 $query="select
s.title,b.booking_date_time,oci.client_name,oci.client_email
from
ct_bookings as b,ct_services as s,ct_order_client_info as oci
where
b.order_id = '".$orderid."' and
b.service_id = s.id and
b.order_id = oci.order_id GROUP BY b.order_id";
        $result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_row($result);
        return $value;
    }
	public function check_for_service_addons_availabilities($sid){
		$query="select count(a.id) as count_of_addons from ct_services_addon as a where a.service_id = '$sid'";
		$result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value['count_of_addons'];
    }
	public function check_for_service_units_availabilities($sid){
		$query="select count(id) as count_of_method from ct_services_method where service_id = '$sid'";
		$result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value['count_of_method'];
    }
	
	public function save_staff_to_booking($sid){
		$query="update ".$this->table_name." set staff_ids='".$sid."' where order_id='".$this->order_id."'";
		$result=mysqli_query($this->conn,$query);
    }
	public function fetch_staff_of_booking(){
		$query = "SELECT staff_ids FROM `ct_bookings` where order_id = '".$this->order_id."' GROUP BY order_id";
		$result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value[0];
	}
	
	function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }

	function get_staff_detail_for_email($sid){
		$query="select * from ct_admin_info where id = '".$sid."'";
		$result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value;
	}
	
	function get_staff_ids_from_bookings($oid){
		$query="select * from ct_bookings where order_id = '".$oid."'";
		$result=mysqli_query($this->conn,$query);
        $value=mysqli_fetch_array($result);
        return $value['staff_ids'];
	}
	
	function booked_staff_status(){
		$query = "select GROUP_CONCAT(staff_ids) as sc from ".$this->table_name." where booking_date_time = '".$this->booking_date_time."' and staff_ids != ''";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value[0];
	}
}
?>