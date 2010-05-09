<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/css/css_styles.css" type="text/css" media="all">
 <script language="JavaScript" src="include/java/prototype.js" type="text/javascript"> </script>
 <script language="JavaScript" src="include/java/header.js" type="text/javascript"> </script>
 <script language="JavaScript" src="include/java/calendar.js" type="text/javascript"> </script>
 <script language="JavaScript" src="include/java/main_menu.js" type="text/javascript"> </script>

<title>PrimusIPACCT System Administrator</title>
</head>
<body onLoad="putFocus(0,1); //blank">
<div id="header">
  <div id="sys_stats"> date: #date, uptime 2 days, 10:52, 0 users</div>
  <div id="ipacct_ver"> PRIMUS IPACCT #version </div>
</div>


  <ul id="maintab" class="navtab">
<mainrepeat id="1">
    <li rel="#rel"><a href='#mainlink'> #caption </a> </li>
</mainrepeat>

<mainrepeat id="3">
   <li> <a href='#mainlink'>#caption </a> </li>
</mainrepeat>

  </ul>

<div id='submenu'>
<mainrepeat id="2">
  <div id="#subrel" class="submenustyle">
	<repeat id="#num"> <a href="#link">#linktxt</a>  </repeat>
  </div>
</mainrepeat>
</div>






<div id="contentwrap">
 <div id="ctop"></div>
  <div id="wrap">
      <div id="content">
<script type="text/javascript">initalizetab("maintab")</script>
