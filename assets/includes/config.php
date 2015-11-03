<?php
ob_start();
session_start();

// Title of donation box
define('TITLE', 'PayPal Donation Widget');

// PayPal account, you can use your paypal e-mail or merchant ID
define('PAYPAL_ID', 'paypal@yourURL.com');

// How many recent/top donors should be displayed in donation box
define('DONORS_NUMBER', 5);

// Currency
define('CURRENCY', 'USD');

// Target to reach
define('TARGET', 1000);

// Information
define('DIR','http://yourURL.com'); //Set your domain
define('SITEEMAIL','No-reply@yourURL.com');  //Set your administation email 

//Google ReCaptcha 2.0
$siteKey = 'KEY';
$secret = 'SKEY'; //Visit http://google.com/recaptcha

//Default time zone
date_default_timezone_set('Toronto/America'); // Set your default time zone. http://php.net/manual/en/timezones.php

//MySQL Information 
$server = 'localhost'; //State your MySQL server Host (Usually localhost)
$user = 'simplex';  // State your MySQL server username
$pass = 'simplex'; // State your MySQL user password
$db = 'simplex'; // State your MySQL database name
