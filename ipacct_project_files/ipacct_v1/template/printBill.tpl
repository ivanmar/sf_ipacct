<html>
<head>
<title>PrimusIPACCT System Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
td {
	font-style : normal;
	font-weight : normal;
	font-size : 10px;
	font-family : Verdana, Arial, Helvetica, sans-serif;
	border: black solid 1px;
}

.header {
	background-color : #EEEEEE;
	font-style : normal;
	font-weight : bold;
	font-size : 16px;
	font-family : Verdana, Arial, Helvetica, sans-serif;
}

.footer {
	background-color : #EEEEEE;
	font-style : normal;
	font-weight : bold;
	font-size : 12px;
	font-family : Verdana, Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>

<h3 align=right>
<img src=images/print.gif accesskey='p' border=0 onClick='window.print()'>
<a href='javascript:window.close()' accesskey='x'>
<img src=images/close.gif accesskey='x' border=0 onClick='window.close()'>
</a>

<table width="600" border="0" align="center" cellpadding="2" cellspacing="1">
<tr>
<td class="header" align="left">
<img src='images/logoisp/logo-#id.jpg'>
</td>
<td class="header" colspan="7" align="right">
#postpinfo
</td>
</tr>
<tr>
<td class="header" colspan="8" align="center">
Account No. #acctnum
</td>
</tr>
<tr>
<td align="center">Start Time</td>
<td align="center">End Time</td>
<td align="center">Measure Unit</td>
<td align="center">Billing Unit</td>
<td align="center">Price BU</td>
<td align="center">Price on start</td>
<td align="center">BU spent</td>
<td align="center">Price</td>
</tr>
<repeat id="1">
<tr>
<td align="center">:srvstarttime: &nbsp</td>
<td align="center">:srvstoptime: &nbsp</td>
<td align="center">:measureunit: &nbsp</td>
<td align="center">:billingunit: &nbsp</td>
<td align="center">:pricebillingunit:</td>
<td align="center">:priceonstart: &nbsp</td>
<td align="center">:buspent: &nbsp</td>
<td align=right> &nbsp <b>:price:</b></td>
</tr>
</repeat>
<tr>
<td class="footer" colspan="7">TOTAL INVOICE PRICE </td>
<td class="footer" align="right">#sumtotalprice</td>
</tr>
</table>
