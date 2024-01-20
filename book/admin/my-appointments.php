<?php 

include(dirname(__FILE__).'/header.php');
//include(dirname(__FILE__).'/admin_session_check.php');
include(dirname(dirname(__FILE__))  . "/objects/class_userdetails.php");
include(dirname(dirname(__FILE__))  . "/objects/class_booking.php");
include(dirname(dirname(__FILE__))  . '/objects/class_front_first_step.php');
$_SESSION['login_user_id'] = '0';
$booking_no = (int)$_GET['booking'];
/*if(!isset($_SESSION['login_user_id'])){
    header('Location:'.SITE_URL."admin/");
}*/
$con = new cleanto_db();
$conn = $con->connect();
$objuserdetails = new cleanto_userdetails();
$objuserdetails->conn = $conn;
$booking = new cleanto_booking();
$booking->conn = $conn;
$setting = new cleanto_setting();
$setting->conn = $conn;
$general=new cleanto_general();
$general->conn=$conn;
$first_step=new cleanto_first_step();
$first_step->conn=$conn;
$symbol_position=$setting->get_option('ct_currency_symbol_position');
$decimal=$setting->get_option('ct_price_format_decimal_places');
$getdateformat=$setting->get_option('ct_date_picker_date_format');
$time_format = $setting->get_option('ct_time_format');
$date_format=$setting->get_option('ct_date_picker_date_format');
$getmaximumbooking = $setting->get_option('ct_max_advance_booking_time');
?>

<div id="cta-user-appointments">
    <div class="panel-body">
        <div class="tab-content">
            <h4 class="header4"><?php echo $label_language_values['my_appointments'];?> <span style="font-size:13px;">(<a href="my-appointments.php?booking=1">ALL</a>|<a href="my-appointments.php?booking=2">ALL Future</a>|<a href="my-appointments.php">Current</a>)</span>
			<a data-toggle="modal" href="javascript:void(0)" data-target="#new-user-booking-details"  class="btn btn-success pull-right display_myappointment_data"><i class="fa fa-repeat"></i>New Booking</a>
			</h4>
            <form>
                <div class="table-responsive">
                    <table id="user-profile-booking-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><?php echo $label_language_values['order'];?>#</th>
                            <th><?php echo $label_language_values['order_date'];?></th>
                            <th><?php echo $label_language_values['order_time'];?></th>
                            <th>Customer</th>
                            <th>Room</th>
                            <th>Players</th>
                            <th>Amount Due</th>
                            <th>Payment</th>
                            <th>Escape</th>
                            <th>Status</th>
                            <th>Functions</th>
                            <th><?php echo $label_language_values['actions'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_SESSION['login_user_id'])){
                        $id = $_SESSION['login_user_id'];
                        $objuserdetails->id = $id;
                       	$details = $objuserdetails->get_guest_details($booking_no);
                        while($dd = mysqli_fetch_array($details)){
                            ?>
                            <tr>
                                <td><?php echo $dd['order_id'];?></td>
                                <?php
                                if($time_format == 12){
                                    ?>
                                    <td><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($dd['booking_date_time'])));?></td>
                                <?php
                                }else{
                                    ?>
                                    <td><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($dd['booking_date_time'])));?></td>
                                <?php
                                }
                                ?>
                                <?php
                                if($time_format == 12){
                                    ?>
                                    <td><?php echo date(" h:i A",strtotime($dd['booking_date_time']));?></td>
                                <?php
                                }else{
                                    ?>
                                    <td><?php echo date(" H:i",strtotime($dd['booking_date_time']));?></td>
                                <?php
                                }
                                 $userinfo1 =  $objuserdetails->get_user_notes($dd['order_id']);
                                                        $temppp1= unserialize(base64_decode($userinfo1[0]));
                                                        $tem1 = str_replace('\\','',$temppp1);
                                                        $finalnotes1 = $tem1['notes'];
                                ?>
                                <td><? $deets = $objuserdetails->get_guest_contact_details($dd['order_id']);
                                       $userdeets = mysqli_fetch_array($deets); 
                                       if ($finalnotes1 <> '') {
                                       	echo '<img src="../assets/images/exclamation.png" data-toggle="tooltip" data-placement="top" title="'.$finalnotes1.'">&nbsp;&nbsp;&nbsp;';
                                       }
                                       echo '<a data-toggle="modal" href="javascript:void(0)" data-total_price="" data-target="#update-user-note-details'.$dd['order_id'].'" data-order_id="'.$dd['order_id'].'">'.$userdeets['client_name'].'</a>'; ?></td>
                                <td>
                                	<? if ($dd['service_id'] == '1') echo 'The Order Of The 9';
                                		 if ($dd['service_id'] == '2') echo 'Bunker 51';
                                		 if ($dd['service_id'] == '3') echo 'Forgotten Temple';
                                         if ($dd['service_id'] == '4') echo 'Escape to Treasure Island';
                                         if ($dd['service_id'] == '5') echo 'The Great Time Escape';
                                	 ?>
                                </td>
                                <td>
                                	<? echo $dd['method_unit_qty']; ?>
                                </td>
                                <td>
                                	<? 
                                		echo 'R'.($dd['amount'] - $dd['discount']);	
                                		if ($dd['discount'] >= 1) { echo '<br>Voucher : R' . $dd['discount'];
                                		}
                                	 ?>
                                </td>
                                <td>
                                	<? 
                                		$pmethod = '';
                                		if ($dd['payment_method'] == 'Payumoney') $pmethod = 'Paygate';
                                		if ($dd['payment_method'] == 'Payumoney2') $pmethod = 'Paygate Deposit';
                                		if ($dd['payment_method'] == 'Bank Transfer') $pmethod = 'EFT';
                                		if ($dd['payment_method'] == 'Pay At Venue') $pmethod = 'Pay On Arrival';
                                		/*if ($dd['partial_amount'] >= 1) { 
                                		 	if ($dd['partial_amount'] >= ($dd['amount']-$dd['discount'])) {
                                		 		echo '<font color="green">('.$pmethod.') Fully Paid</font>';
                                		 	} else {
                                		 		echo '<font color="orange">('.$pmethod.') Partially Paid : R' . $dd['partial_amount'] . '</font>'; 
                                		 	}
                                		 }
                                		 if ($dd['partial_amount'] == 0) echo '<font color="red">('.$pmethod.') Payment Still Due</font>';*/
                                		 
                                		 
                                		 $player_query="select * from ct_payment_breakdown where order_id = '".$dd['order_id']."'";
  																	 $players_update = mysqli_query($objuserdetails->conn,$player_query);
  																	 $total_paid = $dd['partial_amount'];
  																	 while ($playerss = mysqli_fetch_array($players_update)) {
                                		 	$total_paid = $total_paid + $playerss['amount'];                       		 
                                		 }
                                		 if ($total_paid >= ($dd['amount']-$dd['discount'])) {
                                		 	echo '<font color="green">('.$pmethod.') Fully Paid</font>';
                                		 } else if ($total_paid == 0) {
                                		 	echo '<font color="red">('.$pmethod.') Payment Still Due</font>';
                                		 } else {
                                		 	echo '<font color="orange">('.$pmethod.') Partially Paid : R' . $total_paid . '</font>'; 
                                		 }
                                		 
                                	 ?>
                                </td>
                                <td>
                                	<? 
                                		$game_done = 0;
                                		$timers = $objuserdetails->get_timing_details($dd['order_id']);
                                    $timer = mysqli_fetch_array($timers); 
                                    
                                    if ($timer['order_date_completed'] <> '0000-00-00 00:00:00') {
                                    	$end = strtotime($timer['order_date_completed']);
																			$start = strtotime($timer['order_date']);
	
																			$seconds = ($end - $start);
																			if (gmdate("H:i:s", $seconds) <> '00:00:00') {
																				echo gmdate("H:i:s", $seconds);
																				$game_done = 1;
																			}
																		}
																		if (($_GET['reset'] == 1)&&($_GET['id'] == $dd['order_id'])) { $rests = $objuserdetails->reset_timer($dd['order_id']); echo "<meta http-equiv=\"refresh\" content=\"0;URL=my-appointments.php\">"; }
																		if ($timer['order_date_completed'] == '0000-00-00 00:00:00') { echo 'In Progress'; echo '<br><font size=1><a href="my-appointments.php?reset=1&id='.$dd['order_id'].'">(Reset Timer)</a></font>'; }
																		
                                	?>
                                </td>
                                <td>
                                	<? if ($dd['booking_status'] == 'C') echo 'Completed';
                                		 if ($dd['booking_status'] == 'A') echo 'Active';
                                		 if ($dd['booking_status'] == 'R') echo 'Rejected';
                                	?> 
                                </td>
                                <td>
                                    <a data-toggle="modal" href="javascript:void(0)" data-total_price="" data-target="#update-user-payment-details<?php echo $dd['order_id'];?>"  class="btn btn-info display_myappointment_data" data-order_id="<?php echo $dd['order_id'];?>"><i class="fa fa-eye"></i>Payments</a>
                                    <a data-toggle="modal" href="javascript:void(0)" data-total_price="" data-target="#update-user-booking-details<?php echo $dd['order_id'];?>"  class="btn btn-success display_myappointment_data" data-order_id="<?php echo $dd['order_id'];?>"><i class="fa fa-repeat"></i><?php echo $label_language_values['reschedule'];?></a>
                                    <a data-toggle="modal" href="javascript:void(0)" data-total_price="" data-target="#update-user-players<?php echo $dd['order_id'];?>"  class="btn btn-primary display_myappointment_data" data-order_id="<?php echo $dd['order_id'];?>"><i class="fa fa-download"></i>Player Details</a>
                                    <? 
                                    $now = strtotime(date('Y-m-d h:i:s'));
                                    $then = strtotime($dd['booking_date_time']);
                                    $difference = $then - $now; 
                                    if (($difference >= -100000)&&($difference <= 100000)) { ?>
                                    	<a href="gamemaster.php?booking=<?php echo $dd['order_id'] . '&game=' .$dd['service_id'];?>" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i>Gamemaster</a>
                                    <? } 
                                    if (($game_done == 1)&&($dd['booking_status'] <> 'C')) { ?>
                                    	<a data-toggle="modal" href="javascript:void(0)" data-total_price="" class="btn btn-success confirm_book ct-confirm-appointment-cal" data-order_id="<?php echo $dd['order_id'];?>">Complete Game</a>
                                    <? } ?>
                                </td>
                                <td>
                                    <a target="_blank" href="<?php echo BASE_URL;?>/assets/lib/download_invoice_client.php?iid=<?php echo $dd['order_id'];?>" class="btn btn-primary"><i class="fa fa-download"></i><?php echo $label_language_values['download_invoice'];?></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                }
                ?>
                <?php
                if(isset($_SESSION['login_user_id'])){
                    $details = $objuserdetails->get_guest_details($booking_no);
                    while($dd = mysqli_fetch_array($details)){
                        ?>
                        <div id="update-user-players<?php echo $dd['order_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog modal-md vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Update Player Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active">
                                                    <table>
                                                        <tbody>
                                                        	<? $deets = $objuserdetails->get_guest_contact_details($dd['order_id']);
                                                        		 $userdeets = mysqli_fetch_array($deets);
                                                        		 $player_query="select * from ct_order_client_players where order_id = '".$dd['order_id']."'";
  																													 $players = mysqli_fetch_array(mysqli_query($objuserdetails->conn,$player_query));
                                                        	?>
													                              <tr>
                                                            <td><label for="ct-service-duration">Player 1</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player1<?php echo $dd['order_id'];?>" value="<?=$players['player1'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 2</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player2<?php echo $dd['order_id'];?>" value="<?=$players['player2'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 3</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player3<?php echo $dd['order_id'];?>" value="<?=$players['player3'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 4</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player4<?php echo $dd['order_id'];?>" value="<?=$players['player4'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 5</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player5<?php echo $dd['order_id'];?>" value="<?=$players['player5'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 6</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player6<?php echo $dd['order_id'];?>" value="<?=$players['player6'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 7</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player7<?php echo $dd['order_id'];?>" value="<?=$players['player7'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Player 8</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" style="width: 300px;" class="form-control player8<?php echo $dd['order_id'];?>" value="<?=$players['player8'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cta-col12 ct-footer-popup-btn">
                                                <div class="cta-col6">
                                                    <button type="button" data-order="<?php echo $dd['order_id'];?>" class="btn btn-info my_user_btn_for_players">Update Players</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="update-user-payment-details<?php echo $dd['order_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog modal-md vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Update Payment Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active">
                                                    <table>
                                                        <tbody>
                                                        	<? $deets = $objuserdetails->get_guest_contact_details($dd['order_id']);
                                                        		 $userdeets = mysqli_fetch_array($deets);
                                                        	?>
													                              <tr>
                                                            <td><label for="ct-service-duration">Outstanding</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                	<? 
                                                                	$alreadypaid = 0;
                                                                	$player_query="select * from ct_payments where order_id = '".$dd['order_id']."'";
  																	 										 					$players_update = mysqli_query($objuserdetails->conn,$player_query);
  																	 										 					while ($playerss = mysqli_fetch_array($players_update)) {
                                		 										 						$alreadypaid = $alreadypaid + $playerss['partial_amount'];                       		 
                                		 										 					}
                                                    	
                                                    		 					$player_query="select * from ct_payment_breakdown where order_id = '".$dd['order_id']."'";
  																	 										 					$players_update = mysqli_query($objuserdetails->conn,$player_query);
				 		 																	 										 while ($playerss = mysqli_fetch_array($players_update)) {
            				                    		 										 		$alreadypaid = $alreadypaid + $playerss['amount'];                       		 
                    					            		 										 }
                                                                	
                                                                	?>
                                                                    <div><input type="text" class="form-control amount_paid<?php echo $dd['order_id'];?>" value="<?=($dd['method_unit_qty_rate']-$alreadypaid);?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Method</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
       																															<div>
       																																<select class="form-control payment_type<?php echo $dd['order_id'];?>"/>
       																																	<option value="Credit Card" class="time-slot br-2 ct-booked" >Credit Card</option>
       																																	<option value="Cash" class="time-slot br-2 ct-booked" >Cash</option>
       																																	<option value="Bank Deposit" class="time-slot br-2 ct-booked" >Bank Deposit</option>
       																																	<option value="Manual Paybill" class="time-slot br-2 ct-booked" >Paygate Paybill</option>
       																																	<option value="Entertainer" class="time-slot br-2 ct-booked" >Entertainer App</option>
       																																	<option value="Correction" class="time-slot br-2 ct-booked" >Correction</option>
       																																	<option value="Other" class="time-slot br-2 ct-booked" >Other</option>
       																																</select>	
       																															</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <table>
                                                    	<tr><td colspan=3><b>Existing Allocations</b></td></tr>
                                                    	<? $player_query="select * from ct_payments where order_id = '".$dd['order_id']."'";
  																	 										 $players_update = mysqli_query($objuserdetails->conn,$player_query);
  																	 										 while ($playerss = mysqli_fetch_array($players_update)) {
  																	 										 	if (($playerss['payment_method'] == "Payumoney")||($playerss['payment_method'] == "Payumoney2")) {$playerss['payment_method'] = 'Paygate'; }
                                		 										 	echo '<tr><td width="150">'.$playerss['payment_date'].'</td><td>'.$playerss['payment_method'].'</td><td>R'.$playerss['partial_amount'].'</td></tr>';                       		 
                                		 										 }
                                                    	
                                                    		 $player_query="select * from ct_payment_breakdown where order_id = '".$dd['order_id']."'";
  																	 										 $players_update = mysqli_query($objuserdetails->conn,$player_query);
  																	 										 $total_paid = $dd['partial_amount'];
  																	 										 while ($playerss = mysqli_fetch_array($players_update)) {
                                		 										 	echo '<tr><td width="150">'.$playerss['date'].'</td><td>'.$playerss['method'].'</td><td>R'.$playerss['amount'].'</td></tr>';                       		 
                                		 										 }
                                                    	?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cta-col12 ct-footer-popup-btn">
                                                <div class="cta-col6">
                                                    <button type="button" data-order="<?php echo $dd['order_id'];?>" class="btn btn-info my_user_btn_for_payment">Update Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="update-user-note-details<?php echo $dd['order_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog modal-md vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Update Notes</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active">
                                                    <table>
                                                        <tbody>
                                                        	<?
                                                        $userinfo =  $objuserdetails->get_user_notes($dd['order_id']);
                                                        $temppp= unserialize(base64_decode($userinfo[0]));
                                                        $tem = str_replace('\\','',$temppp);
                                                        $finalnotes = $tem['notes'];//nick
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $label_language_values['notes'];?></td>
                                                            <td><textarea class="form-control my_user_notes_reschedule<?php echo $dd['order_id'];?>"><?php echo $finalnotes;?></textarea></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cta-col12 ct-footer-popup-btn">
                                                <div class="cta-col6">
                                                    <button type="button" data-order="<?php echo $dd['order_id'];?>" class="btn btn-info my_user_btn_for_notes">Update Notes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="update-user-booking-details<?php echo $dd['order_id'];?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog modal-md vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title"><?php echo $label_language_values['appointment_details'];?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active">
                                                    <table>
                                                        <tbody>
                                                        	<? $deets = $objuserdetails->get_guest_contact_details($dd['order_id']);
                                                        		 $userdeets = mysqli_fetch_array($deets);
                                                        	?>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Name</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control username<?php echo $dd['order_id'];?>" value="<?=$userdeets['client_name'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><label for="ct-service-duration">Email</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control email<?php echo $dd['order_id'];?>" value="<?=$userdeets['client_email'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><label for="ct-service-duration">Phone</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control phone<?php echo $dd['order_id'];?>" value="<?=$userdeets['client_phone'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        

                                                        <tr>
                                                            <td><label for="ct-service-duration"><?php echo $label_language_values['amount'];?></label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control amountdue<?php echo $dd['order_id'];?>" value="<?=$dd['method_unit_qty_rate'];?>"/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Players</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><select class="form-control players<?php echo $dd['order_id'];?>"/>
                                                                    	<? for ($x=0; $x <= 30; $x++) { ?>
                                                                    		<option value="<?=$x;?>" <?php if($dd['method_unit_qty'] == $x){ echo "selected";}?> class="time-slot br-2 ct-booked" ><?=$x;?></option>
                                                                    	<? } ?>
                                                                    	</select>
                                                                    	</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Room</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
       																															<div>
       																																<select class="form-control room<?php echo $dd['order_id'];?>"/>
       																																	<option value="1" <?php if($dd['service_id'] == 1){ echo "selected";}?> class="time-slot br-2 ct-booked" >The Order Of The 9</option>
       																																	<option value="2" <?php if($dd['service_id'] == 2){ echo "selected";}?> class="time-slot br-2 ct-booked" >Bunker 51</option>
       																																	<option value="3" <?php if($dd['service_id'] == 3){ echo "selected";}?> class="time-slot br-2 ct-booked" >Forgotten Temple</option>
       																																	<option value="4" <?php if($dd['service_id'] == 3){ echo "selected";}?> class="time-slot br-2 ct-booked" >Escape to Treasure Island</option>
       																																	<option value="5" <?php if($dd['service_id'] == 3){ echo "selected";}?> class="time-slot br-2 ct-booked" >The Great Time Escape</option>
       																																</select>	
       																															</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration"><?php echo $label_language_values['date_and_time'];?></label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50">
                                                                    <?php $dates = date("Y-m-d",strtotime($dd['booking_date_time']));
                                                                    $slot_timess = date('H:i',strtotime($dd['booking_date_time']));
                                                                    ?>
                                                                    <input class="exp_cp_date form-control" id="expiry_date<?php echo $dd['order_id'];?>" value="<?php echo $dates;?>" data-date-format="yyyy/mm/dd" data-provide="datepicker" />
                                                                   
                                                                </div>
                                                                <div class="cta-col6 ct-w-50 float-right mytime_slots_booking">
                                                                    <?php
                                                                    $t_zone_value = $setting->get_option('ct_timezone');
                                                                    $server_timezone = date_default_timezone_get();
                                                                    if(isset($t_zone_value) && $t_zone_value!=''){
                                                                        $offset= $first_step->get_timezone_offset($server_timezone,$t_zone_value);
                                                                        $timezonediff = $offset/3600;
                                                                    }else{
                                                                        $timezonediff =0;
                                                                    }
                                                                    if(is_numeric(strpos($timezonediff,'-'))){
                                                                        $timediffmis = str_replace('-','',$timezonediff)*60;
                                                                        $currDateTime_withTZ= strtotime("-".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
                                                                    }else{
                                                                        $timediffmis = str_replace('+','',$timezonediff)*60;
                                                                        $currDateTime_withTZ = strtotime("+".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
                                                                    }
                                                                    $select_time=date('Y-m-d',strtotime($dates));
                                                                    $start_date = date($select_time,$currDateTime_withTZ);
                                                                    $time_interval = 15; //$setting->get_option('ct_time_interval');
                                                                    $time_slots_schedule_type = $setting->get_option('ct_time_slots_schedule_type');
                                                                    $advance_bookingtime = 0; //$setting->get_option('ct_min_advance_booking_time');
                                                                    $ct_service_padding_time_before = $setting->get_option('ct_service_padding_time_before');
                                                                    $ct_service_padding_time_after = $setting->get_option('ct_service_padding_time_after');
                                                                    $booking_padding_time = $setting->get_option('ct_booking_padding_time');
                                                                    $room = $dd['service_id'];
                                                                    $time_schedule = $first_step->get_day_time_slot_by_provider_id($time_slots_schedule_type,$start_date,$time_interval,$advance_bookingtime,$ct_service_padding_time_before,$ct_service_padding_time_after,$timezonediff,$booking_padding_time,$room);
                                                                    $allbreak_counter = 0;
                                                                    $allofftime_counter = 0;
                                                                    $slot_counter = 0;
                                                                    ?>
                                                                    <select class="selectpicker mydatepicker_appointment   form-control" id="myuser_reschedule_time" data-size="10" style="" >
                                                                        <?php
                                                                        if($time_schedule['off_day']!=true && isset($time_schedule['slots']) && sizeof($time_schedule['slots'])>0 && $allbreak_counter != sizeof($time_schedule['slots']) && $allofftime_counter != sizeof($time_schedule['slots'])){
                                                                            foreach($time_schedule['slots']  as $slot) {
                                                                                $ifbreak = 'N';
                                                                                
                                                                                /* if yes its offtime time then we will not show the time for booking  */
                                                                                if($ifofftime=='Y') { $allofftime_counter++; continue; }
                                                                                $complete_time_slot = mktime(date('H',strtotime($slot)),date('i',strtotime($slot)),date('s',strtotime($slot)),date('n',strtotime($time_schedule['date'])),date('j',strtotime($time_schedule['date'])),date('Y',strtotime($time_schedule['date'])));
                                                                                if($setting->get_option('ct_hide_faded_already_booked_time_slots')=='on' && in_array($complete_time_slot,$time_schedule['booked'])) {
                                                                                    continue;
                                                                                }
                                                                                if( in_array($complete_time_slot,$time_schedule['booked']) && ($setting->get_option('ct_allow_multiple_booking_for_same_timeslot_status')!='Y') ) { ?>
                                                                                    <?php
                                                                                    if($setting->get_option('ct_hide_faded_already_booked_time_slots')=="off"){
                                                                                        ?>
                                                                                        <option value="<?php echo date("H:i",strtotime($slot));?>" <?php if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 ct-booked" >
                                                                                            <?php
                                                                                            if($setting->get_option('ct_time_format')==24){
                                                                                                echo date("H:i",strtotime($slot));
                                                                                            }else{
                                                                                                echo date("h:i A",strtotime($slot));
                                                                                            }?>
                                                                                        </option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                <?php
                                                                                } else {
                                                                                    if($setting->get_option('ct_time_format')==24){
                                                                                        $slot_time = date("H:i",strtotime($slot));
                                                                                    }else{
                                                                                        $slot_time = date("h:i A",strtotime($slot));
                                                                                    }
                                                                                    ?>
                                                                                    <option value="<?php echo date("H:i",strtotime($slot));?>" <?php if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 <?php if(in_array($complete_time_slot,$time_schedule['booked'])){ echo' ct-booked';}else{ echo ' time_slotss'; }?>" <?php if(in_array($complete_time_slot,$time_schedule['booked'])){echo ''; }else{ echo 'data-slot_date_to_display="'.date($date_format,strtotime($dates)).'" data-slot_date="'.$dates.'" data-slot_time="'.$slot_time.'"'; } ?>><?php if($setting->get_option('ct_time_format')==24){echo date("H:i",strtotime($slot));}else{echo date("h:i A",strtotime($slot));}?></option>
                                                                                <?php
                                                                                } $slot_counter++;
                                                                            }
                                                                            if($allbreak_counter == sizeof($time_schedule['slots']) && sizeof($time_schedule['slots'])!=0){ ?>
                                                                                <option  class="time-slot"><?php echo "Something was not right!";?></option>
                                                                            <?php }
                                                                        } else {?>
                                                                            <option class="time-slot"><?php echo "Something was not right!";?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $userinfo =  $objuserdetails->get_user_notes($dd['order_id']);
                                                        $temppp= unserialize(base64_decode($userinfo[0]));
                                                        $tem = str_replace('\\','',$temppp);
                                                        $finalnotes = $tem['notes'];
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $label_language_values['notes'];?></td>
                                                            <td><textarea class="form-control my_user_notes_reschedule<?php echo $dd['order_id'];?>"><?php echo $finalnotes;?></textarea></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cta-col12 ct-footer-popup-btn">
                                                <div class="cta-col6">
                                                    <button type="button" data-order="<?php echo $dd['order_id'];?>" class="btn btn-info my_user_btn_for_reschedule"><?php echo $label_language_values['update_appointment'];?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
                ?>
                <?php
                if(isset($_SESSION['login_user_id'])){
                        ?>
                        <div id="new-user-booking-details" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="vertical-alignment-helper">
                                <div class="modal-dialog modal-md vertical-align-center">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title"><?php echo $label_language_values['appointment_details'];?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active">
                                                    <table>
                                                        <tbody>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Name</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control usernameNEW" value=""/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><label for="ct-service-duration">Email</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control emailNEW" value=""/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><label for="ct-service-duration">Phone</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control phoneNEW" value=""/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        

                                                        <tr>
                                                            <td><label for="ct-service-duration"><?php echo $label_language_values['amount'];?></label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><input type="text" class="form-control amountdueNEW" value=""/></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Players</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
                                                                    <div><select class="form-control playersNEW"/>
                                                                    	<? for ($x=0; $x <= 50; $x++) { ?>
                                                                    		<option value="<?=$x;?>" class="time-slot br-2 ct-booked" ><?=$x;?></option>
                                                                    	<? } ?>
                                                                    	</select>
                                                                    	</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Room</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
       																															<div>
       																																<select class="form-control roomNEW"/>
       																																	<option value="1" class="time-slot br-2 ct-booked" >The Order Of The 9</option>
       																																	<option value="2" class="time-slot br-2 ct-booked" >Bunker 51</option>
       																																	<option value="3" class="time-slot br-2 ct-booked" >Forgotten Temple</option>
       																																	<option value="4" class="time-slot br-2 ct-booked" >Escape to Treasure Island</option>
       																																	<option value="5" class="time-slot br-2 ct-booked" >The Great Time Escape</option>
       																																</select>	
       																															</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration">Payment</label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50 ">
       																															<div>
       																																<select class="form-control paymentNEW"/>
       																																	<option value="Pay At Venue" class="time-slot br-2 ct-booked" >Pay At Venue</option>
       																																	<option value="Payumoney2" class="time-slot br-2 ct-booked" >Paygate</option>
       																																	<option value="Bank Transfer" class="time-slot br-2 ct-booked" >Bank Transfer</option>
       																																</select>	
       																															</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label for="ct-service-duration"><?php echo $label_language_values['date_and_time'];?></label></td>
                                                            <td>
                                                                <div class="cta-col6 ct-w-50">
                                                                    <?php $dates = date("Y-m-d",strtotime($dd['booking_date_time']));
                                                                    $slot_timess = date('H:i',strtotime($dd['booking_date_time']));
                                                                    ?>
                                                                    <input class="exp_cp_date form-control" id="expiry_dateNEW" value="" data-date-format="yyyy/mm/dd" data-provide="datepicker" />
                                                                   
                                                                </div>
                                                                <?//<div class="cta-col6 ct-w-50 float-right mytime_slots_booking">?>
                                                                <div class="cta-col6 ct-w-50 float-right">
                                                                    <?php
                                                                    $t_zone_value = $setting->get_option('ct_timezone');
                                                                    $server_timezone = date_default_timezone_get();
                                                                    if(isset($t_zone_value) && $t_zone_value!=''){
                                                                        $offset= $first_step->get_timezone_offset($server_timezone,$t_zone_value);
                                                                        $timezonediff = $offset/3600;
                                                                    }else{
                                                                        $timezonediff =0;
                                                                    }
                                                                    if(is_numeric(strpos($timezonediff,'-'))){
                                                                        $timediffmis = str_replace('-','',$timezonediff)*60;
                                                                        $currDateTime_withTZ= strtotime("-".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
                                                                    }else{
                                                                        $timediffmis = str_replace('+','',$timezonediff)*60;
                                                                        $currDateTime_withTZ = strtotime("+".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
                                                                    }
                                                                    $select_time=date('Y-m-d',strtotime($dates));
                                                                    $start_date = date($select_time,$currDateTime_withTZ);
                                                                    $time_interval = 15; //$setting->get_option('ct_time_interval');
                                                                    $time_slots_schedule_type = $setting->get_option('ct_time_slots_schedule_type');
                                                                    $advance_bookingtime = 0; //$setting->get_option('ct_min_advance_booking_time');
                                                                    $ct_service_padding_time_before = $setting->get_option('ct_service_padding_time_before');
                                                                    $ct_service_padding_time_after = $setting->get_option('ct_service_padding_time_after');
                                                                    $booking_padding_time = $setting->get_option('ct_booking_padding_time');
                                                                    $room = $dd['service_id'];
                                                                    $time_schedule = $first_step->get_day_time_slot_by_provider_id($time_slots_schedule_type,$start_date,$time_interval,$advance_bookingtime,$ct_service_padding_time_before,$ct_service_padding_time_after,$timezonediff,$booking_padding_time,$room);
                                                                    $allbreak_counter = 0;
                                                                    $allofftime_counter = 0;
                                                                    $slot_counter = 0;
                                                                    ?>
                                                                    <select class="selectpicker mydatepicker_appointment   form-control" id="myuser_reschedule_time" data-size="10" style="" >
                                                                        <?php
                                                                        date_default_timezone_set("Europe/London");
																																				$range=range(strtotime("08:00"),strtotime("22:00"),15*60);
																																				$x = 0;
																																				foreach($range as $time){
        																																	$time_schedule['slots'][$x] = date("H:i",$time);
        																																	$x++;
																																				} 
                                                                        if($time_schedule['off_day']!=true && isset($time_schedule['slots']) && sizeof($time_schedule['slots'])>0 && $allbreak_counter != sizeof($time_schedule['slots']) && $allofftime_counter != sizeof($time_schedule['slots'])){
                                                                            foreach($time_schedule['slots']  as $slot) {
                                                                                $ifbreak = 'N';
                                                                                
                                                                                /* if yes its offtime time then we will not show the time for booking  */
                                                                                if($ifofftime=='Y') { $allofftime_counter++; continue; }
                                                                                $complete_time_slot = mktime(date('H',strtotime($slot)),date('i',strtotime($slot)),date('s',strtotime($slot)),date('n',strtotime($time_schedule['date'])),date('j',strtotime($time_schedule['date'])),date('Y',strtotime($time_schedule['date'])));
                                                                                if($setting->get_option('ct_hide_faded_already_booked_time_slots')=='on' && in_array($complete_time_slot,$time_schedule['booked'])) {
                                                                                    continue;
                                                                                }
                                                                                if( in_array($complete_time_slot,$time_schedule['booked']) && ($setting->get_option('ct_allow_multiple_booking_for_same_timeslot_status')!='Y') ) { ?>
                                                                                    <?php
                                                                                    if($setting->get_option('ct_hide_faded_already_booked_time_slots')=="off"){
                                                                                        ?>
                                                                                        <option value="<?php echo date("H:i",strtotime($slot));?>" <?php if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 ct-booked" >
                                                                                            <?php
                                                                                            if($setting->get_option('ct_time_format')==24){
                                                                                                echo date("H:i",strtotime($slot));
                                                                                            }else{
                                                                                                echo date("h:i A",strtotime($slot));
                                                                                            }?>
                                                                                        </option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                <?php
                                                                                } else {
                                                                                    if($setting->get_option('ct_time_format')==24){
                                                                                        $slot_time = date("H:i",strtotime($slot));
                                                                                    }else{
                                                                                        $slot_time = date("h:i A",strtotime($slot));
                                                                                    }
                                                                                    ?>
                                                                                    <option value="<?php echo date("H:i",strtotime($slot));?>" <?php if(date("H:i",strtotime($slot)) == $slot_timess){ echo "selected";}?> class="time-slot br-2 <?php if(in_array($complete_time_slot,$time_schedule['booked'])){ echo' ct-booked';}else{ echo ' time_slotss'; }?>" <?php if(in_array($complete_time_slot,$time_schedule['booked'])){echo ''; }else{ echo 'data-slot_date_to_display="'.date($date_format,strtotime($dates)).'" data-slot_date="'.$dates.'" data-slot_time="'.$slot_time.'"'; } ?>><?php if($setting->get_option('ct_time_format')==24){echo date("H:i",strtotime($slot));}else{echo date("h:i A",strtotime($slot));}?></option>
                                                                                <?php
                                                                                } $slot_counter++;
                                                                            }
                                                                            if($allbreak_counter == sizeof($time_schedule['slots']) && sizeof($time_schedule['slots'])!=0){ ?>
                                                                                <option  class="time-slot"><?php echo "Something was not right!";?></option>
                                                                            <?php }
                                                                        } else {?>
                                                                            <option class="time-slot"><?php echo "Something was not right!";?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $label_language_values['notes'];?></td>
                                                            <td><textarea class="form-control my_user_notes_rescheduleNEW"></textarea></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="cta-col12 ct-footer-popup-btn">
                                                <div class="cta-col6">
                                                    <button type="button" data-order="NEW" class="btn btn-info my_user_btn_for_new_booking">Create Booking</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                }
                ?>
        </div>
        </form>
    </div>
</div>
<?php
include(dirname(__FILE__).'/footer.php');
?>