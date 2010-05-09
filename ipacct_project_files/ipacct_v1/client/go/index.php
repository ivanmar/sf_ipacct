<?php

define('INC_DIR', '../lib/');

require_once(INC_DIR . 'config.php');
require_once(INC_DIR . 'languages.php');
require_once(INC_DIR . 'actions.php');

/*
 * possible Cases:
 *
 *  attempt to login                          login=Login
 *  1: Login successful                       res=success
 *  2: Login failed                           res=failed
 *  3: Logged out                             res=logoff
 *  4: Tried to login while already logged in res=already
 *  5: Not logged in yet                      res=notyet
 * 11: Popup                                  res=popup1
 * 12: Popup                                  res=popup2
 *  0: It was not a form request              res=''
 *
 * Read query parameters which we care about
 *
 * $_GET['res'];
 * $_GET['challenge'];
 * $_GET['uamip'];
 * $_GET['uamport'];
 * $_GET['reply'];
 * $_GET['userurl'];
 * $_GET['timeleft'];
 * $_GET['redirurl'];
 *
 * Read form parameters which we care about
 *
 * $_GET['username'];
 * $_GET['password'];
 * $_GET['chal'];
 * $_GET['login'];
 * $_GET['logout'];
 * $_GET['prelogin'];
 * $_GET['res'];
 * $_GET['uamip'];
 * $_GET['uamport'];
 * $_GET['userurl'];
 * $_GET['timeleft'];
 * $_GET['redirurl'];
 * $_GET['store_cookie'];
 */

if (!empty($_GET['login']) && $_GET['login'] == _t('login') )
	 $context = 'login';
elseif (!empty($_GET['res']))
	 $context = $_GET['res'];
else $context = 'error';


/*
 * We need to put some standard arguments in a string for the onLoad
 * javascript function that we run on every page load.  These are:
 * context, timeleft, and next_url.
 *
 * Other arguments may be appended to these in the context specific
 * include file before the top.inc header is spit out.  In that case,
 * we'll need to remember to attach a comma before the extra args.
 */
$js_args  = "'" . $context . "',";
$js_args .= "'" . (empty($_GET['timeleft']) ? '' : $_GET['timeleft']) . "',";
$js_args .= "'" . LOGINPATH . '?res=popup3';
$js_args .= empty($_GET['uamip']) ? '' : '&uamip=' . $_GET['uamip'];
$js_args .= empty($_GET['uamport']) ? "'" : '&uamport=' . $_GET['uamport'] . "'";

// If we want to store the cookie, compose and set it...
if (isset($_GET['save_login']) && $_GET['save_login'] == 'on' ) {
	$str = $_GET['uid'] . '|' . $_GET['pwd'];
	$expire = time() + 315360000;						// expires in 10 years...
	setcookie('login', $str, $expire, '/', $_SERVER['HTTP_HOST'], true);
}

if ( isset($_COOKIE['login']) ) {
	$arr = explode('|', $_COOKIE['login']);
	$username = $arr[0];
	$password = $arr[1];
} else {
	$username = '';
	$password = '';
}

// new concept: just use methods of class "actions"
$a = new actions();
if (method_exists($a, $context))
	$a->$context();
else
	$a->error();

?>
