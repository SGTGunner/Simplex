<?php
include_once ("include.php");
define('DATA_FILE', 'data.txt');
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) die();

$request = "cmd=_notify-validate";
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$request .= "&".$key."=".$value;
}

$paypalurl = 'https://www.paypal.com/cgi-bin/webscr';
$ch = curl_init($paypalurl);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
$result = curl_exec($ch);
curl_close($ch);                
if (substr(trim($result), 0, 8) != "VERIFIED") die();

$payment["amount"] = $_POST['mc_gross'];
$payment["name"] = str_replace("|", " ", $_POST['first_name'].' '.$_POST['last_name']);
$handle = fopen(DATA_FILE, "a+");
if ($handle) {
	fwrite($handle, $payment['name'].'|'.$payment["amount"]."\r\n");
	fclose($handle);
}
?>