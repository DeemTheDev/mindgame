<?
if ($_POST['action'] == "gotCustomers") {
	
	echo $_POST['gameID'];
	echo $_POST['email1'];
	echo $_POST['email2'];
	echo $_POST['email3'];
	echo $_POST['email4'];
	echo $_POST['email5'];
	echo $_POST['email6'];
	
} else if ($_POST['action'] == "gotGameID") { ?>
	<form action="" method="post">
  <input type="hidden" name="action" value="gotCustomers">
  <input type="hidden" name="gameID" value="<?=$_POST['gameID'];?>">
  <b>Player 1</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name1" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email1" value=""><br><br>
  <input type="checkbox" required name="liability1" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <b>Player 2</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name2" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email2" value=""><br><br>
  <input type="checkbox" name="liability2" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <b>Player 3</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name3" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email3" value=""><br><br>
  <input type="checkbox" name="liability3" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <b>Player 4</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name4" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email4" value=""><br><br>
  <input type="checkbox" name="liability4" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <b>Player 5</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name5" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email5" value=""><br><br>
  <input type="checkbox" name="liability5" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <b>Player 6</b> <br><br>
  Name and Surname:<br>
  <input type="text" name="name6" value=""><br><br>
  Email Address:<br>
  <input type="text" name="email6" value=""><br><br>
  <input type="checkbox" name="liability6" value="accept">By checking this box, I confirm I have read and accept the terms of this liability waiver.<br><br>
  <input type="submit" value="Submit">
</form>
<?
} else if ($_POST['action'] == "") {
?>
<form action="" method="post">
  Please enter Game ID:<br>
  <input type="hidden" name="action" value="gotGameID">
  <input type="text" name="gameID" value=""><br><br>
  <input type="submit" value="Submit">
</form>
<? 
}
?>

