<?php include(dirname(dirname(dirname(__FILE__)))."/objects/class_connection.php");include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");include(dirname(dirname(dirname(__FILE__)))."/header.php");$con = new cleanto_db();$conn = $con->connect();$objdashboard = new cleanto_dashboard();$objdashboard->conn = $conn;if(isset($_POST['getnotification_total'])){    echo @mysqli_num_rows($objdashboard->getallbookingsunread_count());}?>