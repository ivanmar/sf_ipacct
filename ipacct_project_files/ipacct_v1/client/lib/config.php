<?php

// This is the name of your hotspot. It is what will be displayed in
// the browser title and messages such as "Logged in to _My HotSpot_".
define('HOTSPOT_NAME', 'IPACCT AP');

// With which language shall I talk to you?
// available: 'en', 'de'
$lg = 'en';

// Set the UAM IP and UAM Port to point to the chillispot server.
define('UAMIP', '192.168.182.1');
define('UAMPORT', '3990');

// Leave this the way it is.  It's just for convenience.
define('UAM_URL', 'http://' . UAMIP . ':' . UAMPORT);

// Set this to the base url of your login website.
// for example: "https://wireless_login.mysite.com/"
define('BASE_URL', '');

// Set this to the url where you find the login script (index.php).
// for example: 'BASE_URL' or 'BASE_URL . "hotspotlogin/"'
define('LOGINPATH', BASE_URL);

// Set to true to enable login cookie to store username and password.
define('ENABLE_LOGIN_COOKIE', true);

// Set this to "true" to enable debugging output.
define('DEBUG_MODE', false);

// Shared secret used to encrypt challenge with. Prevents dictionary
// attacks.  You should change this to your own shared secret.
// NOTE: This should match chilli.conf's 'uamsecret'.
define('UAMSECRET', 'uam123');

// Best to leave the following line alone if you want to use ordinary
// user-password for radius authentication. Must be used together with
// UAMSECRET (above).
define('USERPASSWORD', true);

?>
