<form id="sms" name="sms" method="post" action="scripts/send_sms.php">
<table width="400">
  <tr>
    <td align="right" valign="top">From:</td>
    <td align="left"><input name="from" type="text" id="from" size="30" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">To:</td>
    <td align="left"><input name="to" type="text" id="to" size="30" /></td>
  </tr>
  <tr>
    <td align="right" valign="top">Carrier:</td>
    <td align="left"><select name="carrier" id="carrier">
      <option value="verizon">Verizon</option>
      <option value="tmobile">T-Mobile</option>
	  <option value="sprint">Sprint</option>
	  <option value="att">AT&amp;T</option>
	  <option value="virgin">Virgin Mobile</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" valign="top">Message:</td>
    <td align="left"><textarea name="message" cols="40" rows="5" id="message"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="submit" name="Submit" value="Submit" /></td>
    </tr>
</table>
</form>

<?php
$from = $_POST['from'];
$to = $_POST['to'];
$carrier = $_POST['carrier'];
$message = stripslashes($_POST['message']);

if ((empty($from)) || (empty($to)) || (empty($message))) {
header ("Location: sms_error.php");
}

else if ($carrier == "verizon") {
$formatted_number = $to."@vtext.com";
mail("$formatted_number", "SMS", "$message"); 
// Currently, the subject is set to "SMS". Feel free to change this.

header ("Location: sms_success.php");
}

else if ($carrier == "tmobile") {
$formatted_number = $to."@tomomail.net";
mail("$formatted_number", "SMS", "$message");

header ("Location: sms_success.php");
}

else if ($carrier == "sprint") {
$formatted_number = $to."@messaging.sprintpcs.com";
mail("$formatted_number", "SMS", "$message");

header ("Location: sms_success.php");
}

else if ($carrier == "att") {
$formatted_number = $to."@txt.att.net";
mail("$formatted_number", "SMS", "$message");
header ("Location: sms_success.php");
}

else if ($carrier == "virgin") {
$formatted_number = $to."@vmobl.com";
mail("$formatted_number", "SMS", "$message");

header ("Location: sms_success.php");
}
?>