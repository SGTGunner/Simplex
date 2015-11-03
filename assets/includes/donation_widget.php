<?php
// List of modes:
// top - top X donors
// recent - X recent donors
// top-only - top X donors only (display only donors)
// recent-only - recent X donors only (display only donors)
// donors-string - display all donors as comma-separated string
// donors-table - display all donors in table
// button - display only button
error_reporting(0);
include_once ("include.php");
define('DATA_FILE', 'data/data.txt');
if (isset($_GET['mode'])) $mode = $_GET['mode'];

$button = "
	<form class='donationwidget_form' name='_xclick' method='post' action='https://www.paypal.com/cgi-bin/webscr'>
		<input type='hidden' name='charset' value='utf-8'>
		<input type='hidden' name='currency_code' value='".CURRENCY."'>
		<input type='hidden' name='cmd' value='_donations'>
		<input type='hidden' name='rm' value='2'>
		<input type='hidden' name='business' value='".PAYPAL_ID."'>
		<input type='hidden' name='item_number' value='donation'>
		<input type='hidden' name='item_name' value='".htmlspecialchars(TITLE, ENT_QUOTES)."'>
		<input type='hidden' name='notify_url' value='".DIR."/assets/include/paypal_ipn.php'>
		<input type='hidden' name='return' value='".$_SERVER["HTTP_REFERER"]."'>
		<input type='hidden' name='cancel_return' value='".$_SERVER["HTTP_REFERER"]."'>
		<input type='hidden' name='no_note' value='1'>
		<input type='hidden' name='no_shipping' value='1'>
		<input type='image' src='http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' border='0' name='submit' alt='Donate' style='border: 0px solid #FFFFFF;'>
	</form>";
if ($mode == 'button') {
	$button = str_replace(array("\r", "\n"), array("", " "), $button);
	echo 'document.write("'.$button.'");';	
	exit;
}
$lines = array();
$donors = array();
if (file_exists(DATA_FILE)) {
	$lines = file(DATA_FILE);
}
if (sizeof($lines) <= 0) $totalamount = "0.00";
else {
	$j = 0;
	$totalamount = 0;
	for($i=0; $i<sizeof($lines); $i++) {
		$line = trim($lines[$i]);
		$data = explode('|', $line);
		if (!empty($line) && sizeof($data) == 2) {
			$donors[$j]['name'] = $data[0];
			$donors[$j]['amount'] = $data[1];
			$totalamount += floatval($data[1]);
			$j++;
		}
	}
	$totalamount = number_format($totalamount, 2, ".", "");
}
if ($mode == 'top' || $mode == 'top-only' || $mode == 'donors-string' || $mode == 'donors-table') {
	$moved = true;
	while($moved) {
		$moved = false;
		for ($i=1; $i<sizeof($donors); $i++) {
			if ($donors[$i-1]['amount'] > $donors[$i]['amount']) {
				$tmp = $donors[$i-1];
				$donors[$i-1] = $donors[$i];
				$donors[$i] = $tmp;
				$moved = true;
			}
		}
	}
}
header('Content-Type: text/html; charset=UTF-8');

if ($mode == 'donors-string') {
	$output = array();
	for ($i=sizeof($donors)-1; $i>=0; $i--) {
		$output[] = $donors[$i]['name'].' ('.$donors[$i]['amount'].' '.CURRENCY.')';
	}
	$code = implode(', ', $output);
} else if ($mode == 'donors-table') {
	if (sizeof($donors) > 0) {
		$code .= "
		<table class='donationwidget_donors_table'>
		<tr><th>Donors</th><th>Amount</th>";
		for ($i=sizeof($donors)-1; $i>=0; $i--) {
			if ($donors[$i]['name'] == '') $donors[$i]['name'] = 'Unknown donor';
			else $donors[$i]['name'] = htmlspecialchars(wordwrap($donors[$i]['name'], 24, ' ', 1), ENT_QUOTES);
			if (!is_numeric($donors[$i]['amount'])) $donors[$i]['amount'] = '0.00';
			$code .= "
			<tr><td class='donationwidget_name'>".htmlspecialchars($donors[$i]['name'], ENT_QUOTES)."</td><td class='donationwidget_amount'>".$donors[$i]['amount']." ".CURRENCY."</td></tr>";
		}
		$code .= "
		</table>";
	}
} else {
	$code = "
<link href='".DIR."/assets/css/style.css' type='text/css' rel='stylesheet'>
<div class='donationwidget_box'>
	<h2 class='donationwidget_title'>".htmlspecialchars(TITLE, ENT_QUOTES)."</h2>
	<div class='donationwidget_donorslist'>";
	if (sizeof($donors) > 0) {
		if ($mode == 'top' || $mode == 'top-only') $code .= 'TOP '.DONORS_NUMBER.' donors';
		else $code .= 'Most recent donors';
		$code .= "
		<table align='center' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse; width: 100%;'>";
		for ($i=sizeof($donors)-1; $i>=0; $i--) {
			if (sizeof($donors) - $i > DONORS_NUMBER) break;
			if ($donors[$i]['name'] == '') $donors[$i]['name'] = 'Unknown donor';
			else $donors[$i]['name'] = htmlspecialchars(wordwrap($donors[$i]['name'], 24, ' ', 1), ENT_QUOTES);
			if (!is_numeric($donors[$i]['amount'])) $donors[$i]['amount'] = '0.00';
			$code .= "
			<tr><td class='donationwidget_name'>".htmlspecialchars($donors[$i]['name'], ENT_QUOTES)."</td><td class='donationwidget_amount'>".$donors[$i]['amount']." ".CURRENCY."</td></tr>";
		}
		$code .= "
			<tr><td class='donationwidget_name' style='padding-top: 10px; font-weight: bold;'>Total Amount</td><td class='donationwidget_amount' style='padding-top: 10px; font-weight: bold;'>".$totalamount." ".CURRENCY."</td></tr></table>";
	} else {
		$code .= "Become our first donor!";
	}
	$code .= "
	</div>";
	if ($mode != 'recent-only' && $mode != 'top-only') {
		if (floatval($totalamount) < TARGET) {
			$code .= $button;
		}
		$code .= "
	<div class='donationwidget_target'>
		Target to reach ".number_format(TARGET,2,'.','')." ".CURRENCY."
	</div>";
	}
	$code .= "
</div>";
}
$code = str_replace(array("\r", "\n"), array("", " "), $code);
echo 'document.write("'.$code.'");';
?>