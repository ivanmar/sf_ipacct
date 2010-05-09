<?php
/**
 * GoLogin language file.
 */

$GL_LANG = array();


switch ($lg) {
	case 'de':
		$GL_LANG['login'] = 'Login';
		$GL_LANG['title'] = '%s Login';
		$GL_LANG['already'] = 'Sie sind schon in %s eingeloggt.';
		$GL_LANG['loginfailed'] = 'Login zu %s fehlgeschlagen.';
		$GL_LANG['loginfailedtryagain'] = 'Sorry, Login fehlgeschlagen. Bitte versuchen Sie es noch einmal.';
		$GL_LANG['loggingin'] = 'Einloggen...';
		$GL_LANG['logginginto'] = 'Einloggen in %s';
		$GL_LANG['loggedinto'] = 'Eingeloggt in %s';
		$GL_LANG['loggedout'] = 'Ausgeloggt von %s';
		$GL_LANG['logout'] = 'Logout';
		$GL_LANG['chillispotonly'] = 'Login muss durch den AP erfolgen!';
		$GL_LANG['welcome'] = 'Willkommen';
		$GL_LANG['pleasewait'] = 'Bitte warten...';
		$GL_LANG['labelLogin'] = 'Login:';
		$GL_LANG['labelPassword'] = 'Passwort:';
		$GL_LANG['rememberlogin'] = 'Login merken?';
		$GL_LANG['onlinetime'] = 'Online seit: ';
		$GL_LANG['remainingtime'] = 'Verbleibende Zeit: ';
		$GL_LANG['leavewindow'] = 'LEAVE THIS WINDOW OPEN <br> while using internet  ';
		$GL_LANG['popup_block_err'] = 'If you are using pop-up blocker, please turn it off';
		break;
	case 'hr':
		$GL_LANG['login'] = 'Prijava';
		$GL_LANG['title'] = '%s Prijava';
		$GL_LANG['already'] = 'Veæ ste prijavljeni.';
		$GL_LANG['loginfailed'] = 'Prijava na  %s nije uspjela.';
		$GL_LANG['loginfailedtryagain'] = 'Prijeva nije uspjela. Poku¹ajte ponovo.';
		$GL_LANG['loggingin'] = 'Prijava u tijeku...';
		$GL_LANG['logginginto'] = 'Prijava u tijeku.. %s';
		$GL_LANG['loggedinto'] = 'Prijavljen na %s';
		$GL_LANG['loggedout'] = 'Prijavljen sa %s';
		$GL_LANG['logout'] = 'Odjava';
		$GL_LANG['chillispotonly'] = 'Prijava mora biti napravljena preko AP-a!';
		$GL_LANG['welcome'] = 'DobrodoÅ¡li! Unesite adresu web stranice';
		$GL_LANG['pleasewait'] = 'Molimo prèekajte...';
		$GL_LANG['labelLogin'] = 'Korisnièko ime:';
		$GL_LANG['labelPassword'] = 'Lozinka:';
		$GL_LANG['rememberlogin'] = 'Zapamtiti ?';
		$GL_LANG['onlinetime'] = 'On-line vrijeme: ';
		$GL_LANG['remainingtime'] = 'Preostalo vrijeme: ';
		$GL_LANG['leavewindow'] = 'NE GASITE OVAJ PROZOR <br> dok koristite internet';
		$GL_LANG['popup_block_err'] = 'Ugasite pop-up bloker';
		break;
	case 'en':
	default:
		$GL_LANG['login'] = 'Login';
		$GL_LANG['title'] = '%s Login';
		$GL_LANG['already'] = 'Already logged in to %s.';
		$GL_LANG['loginfailed'] = 'Login to %s failed.';
		$GL_LANG['loginfailedtryagain'] = 'Sorry, login failed. Please try again.';
		$GL_LANG['loggingin'] = 'Logging in...';
		$GL_LANG['logginginto'] = 'Logging in to %s';
		$GL_LANG['loggedinto'] = 'Logged in to %s';
		$GL_LANG['loggedout'] = 'Logged out from %s';
		$GL_LANG['logout'] = 'Logout';
		$GL_LANG['chillispotonly'] = 'Login must be performed through AP daemon!';
		$GL_LANG['welcome'] = 'Welcome! Enter web page address in address bar';
		$GL_LANG['pleasewait'] = 'Please wait...';
		$GL_LANG['labelLogin'] = 'Login:';
		$GL_LANG['labelPassword'] = 'Password:';
		$GL_LANG['rememberlogin'] = 'Remember Login?';
		$GL_LANG['onlinetime'] = 'Online time: ';
		$GL_LANG['remainingtime'] = 'Remaining time: ';
		$GL_LANG['leavewindow'] = 'LEAVE THIS WINDOW OPEN <br> while using internet';
		$GL_LANG['popup_block_err'] = 'Please turn off pop-up blocker';
}

// little helper-function
function _t() {					// translates a string with vars
	global $GL_LANG;
	$args = func_get_args();
	$key = array_shift($args);
	if (isset($GL_LANG[$key])) {
		if (!empty($args)) {		// use vsprintf to replace stuff inside translated string
			return vsprintf($GL_LANG[$key], $args);
		} else {
			return $GL_LANG[$key];
		}
	} else {
		return 'Translation of &raquo;'.$key.'&laquo; not found.';
	}
}

?>
