<?php

class actions {

	function head() {
		global $js_args, $context, $closewin, $onunload;
		$baseurl = BASE_URL;
		$hotspotname = _t('title', HOTSPOT_NAME);
		$onlinetime = _t('onlinetime');
		$remainingtime = _t('remainingtime'); 

		echo <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PRIMUS IPACCT LOGIN</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="${baseurl}style.css" type="text/css" media="all"  />
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="pragma" content="no-cache">
<script language="javascript" type="text/javascript">
<!--
	var onlinetime='$onlinetime'; var remainingtime='$remainingtime';

//-->
</script>
<script language="javascript" type="text/javascript" src="js/fct.js"></script>
<script language="javascript" type="text/javascript" src="js/tabcontent.js"></script>
</head>

<body $onunload onload="handler($js_args) $closewin" onblur="javascript:doOnBlur('$context')">
EOT;
	}


	function foot() {
		if ( DEBUG_MODE ) {
			echo '_GET:<pre>'; print_r($_GET); echo '</pre>_POST:<pre>'; print_r($_POST); echo '</pre>';
		}

		echo '</body></html>';
	}


	function already() {
		$this->head();
		echo '<p class="msg">'._t('already', HOTSPOT_NAME).'</p>';
		echo '<div id="stat"> &nbsp </div>';
		$this->foot();
	}


	function error() {
		$this->head();
		echo '<p class="msg"> &nbsp </p>';
		echo '<p id="stat">'._t('chillispotonly').'</p>';
		$this->foot();
	}


	function failed() {
		$this->head();
		echo '<p class="msg">'._t('loginfailedtryagain').'</p>';
		include(INC_DIR . 'login_form.php');
		$this->foot();
	}


	function login() {
		$hex_chal	= pack('H32', $_GET['chal']);
		$newchal	= defined('UAMSECRET') ? pack('H*', md5($hex_chal.UAMSECRET)) : $hex_chal;
		$response	= md5("\0" . $_GET['pwd'] . $newchal);
		$newpwd		= pack('a32', $_GET['pwd']);
		$password	= implode ('', unpack('H32', ($newpwd ^ $newchal)));

		if ( defined('UAMSECRET') && defined('USERPASSWORD') )
			$query = '?username='.$_GET['uid'].'&password='.$password.'&userurl='.urlencode($_GET['userurl']);
		else
			$query = '?username='.$_GET['uid'].'&response='.$response.'&userurl='.urlencode($_GET['userurl']);

		header('Location: '.UAM_URL.'/logon'.$query);
		$this->head();
		echo '<p class="msg">'._t('loggingin').'</p>';
		$this->foot();
	}


	function logoff () {
		header('Location: '.UAM_URL.'/prelogin');
	}


	function notyet() {
		$this->head();
		include(INC_DIR . 'login_form.php');
		$this->foot();
	}


	function success() {
		global $js_args;
		if ( ( ! empty($_GET['userurl']) ) && ( ereg(UAM_URL, $_GET['userurl']) == 0 ) && ( ereg(BASE_URL, $_GET['userurl']) == 0 ) ) {
			$userurl = $_GET['userurl'];
		} else {
			$userurl = '';
		}

		// For our javascript, we need 2 extra vars: the popup url, and the userurl we cooked above.
		$js_args .= ",'" . LOGINPATH . '?res=popup2&uamip=' . $_GET['uamip']; 
		$js_args .= '&uamport=' . $_GET['uamport'];
		$js_args .= '&timeleft=' . $_GET['timeleft']; 
		$js_args .= '&redirurl=' . $_GET['redirurl'] . "',"; 
		$js_args .= "'".$userurl."'"; 

		$this->head();
		echo '<p></p>';
		echo '<div id="stat">'._t('welcome').'</div>';


		$this->foot();
	}


	function popup1() {
		$this->head();
		echo '<p class="msg">'._t('logginginto', HOTSPOT_NAME).'</p>';
		echo '<p id="stat">'._t('pleasewait').'</p>';
		$this->foot();
	}


	function popup2() {
		global $js_args;
		global $onunload;
		
		$logoffurl = UAM_URL.'/logoff';
		$forcelogoff = "forcelogoff('$logoffurl')";
		$onunload = 'onunload="'.$forcelogoff.'"';

		$js_args .= ",'".$_GET['redirurl']."'";		// For our javascript, we need 1 extra arg: redirurl.

		$this->head();
		echo '<div id="stat"></div> <br>';
		echo '<p class="msg"> 
			<a href="#" onClick="'.$forcelogoff.'">
			<img src="images/logout.png"></a> ';
		echo '<br>'._t('leavewindow').'</p>';
		$this->foot();
	}
        function popup3() {
                global $closewin;
                $closewin="; window.close();";
                $this->head();
                $this->foot();
        }

}


?>
