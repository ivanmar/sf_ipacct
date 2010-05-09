<html>
<head>
<title>Primus IPACCT Change NAS info</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="include/css/css_styles_popup.css" rel="stylesheet" type="text/css" />
</head>
<body onload=" #onload ">


<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">
<input type="hidden" name="nasid" value="#nasid">

<h1 class='data_header'> EDIT NAS INFO </h1>

<table class='formhold'>


<tr>
 <td id='tdlabel'>MAC Address  :</td>
 <td id='tdinput'> <input name="macaddress" type="text" value="#macaddress"> </td>
</tr>

<tr>
 <td id='tdlabel'>NAS Short Name:</td>
 <td id='tdinput'> <input name="shortname" type="text" value="#shortname"> </td>
</tr>

<tr>
 <td id='tdlabel'>Radius Secret  :</td>
 <td id='tdinput'> <input name="radsecret" type="text" value="#radsecret"> </td>
</tr>

<tr>
 <td id='tdlabel'>Radius Location : </td>
 <td id='tdinput'> #radlocation </td>
</tr>

<tr>
 <td id='tdlabel'>NAS Wireless SSID :</td>
 <td id='tdinput'> <input name="ssid" type="text" value="#ssid"> </td>
</tr>

<tr>
 <td id='tdlabel'>HTTP Admin Port :</td>
 <td id='tdinput'><input name="adminport" type="text" value="#adminport" class="num"> </td>
</tr>

<tr>
 <td id='tdlabel'>Connection Username / Password :</td>
 <td id='tdinput'>
  <input name="connuser" type="text" value="#connuser"> / <input name="connpass" type="text" value="#connpass">
 </td>
</tr>

<tr>
 <td id='tdlabel'>NAS Admin Username / Password :</td>
 <td id='tdinput'>
  <input name="adminuser" type="text" value="#adminuser"> / <input name="adminpass" type="text" value="#adminpass">
 </td>
</tr>

<tr>
 <td id='tdlabel'>Description   : </td>
 <td id='tdinput'> <textarea name="desc">#desc</textarea> </td>
</tr>

</table>
<p id='psubmit'><input class="button" type="submit"></p>
</form> 

</body>
