<script>

var container1='status';
var url1='ipacctAdmin_ajx.php';
var pars1='';

var statusAjax;

</script>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td align=left>


<table width="100%" align=center border="0" cellpadding="3" cellspacing="5">

<tr class="tableDefinition">

<td align=center width="20%">
RADIUS RESTART
</td>
<td align=center width="20%">
DATABASE CLEANER 
</td>
<td align=center width="20%">
REINDEX DATABASE
</td>
<td align=center width="20%">
CHECK VERSION 
</td>
<td align=center width="20%">
SYSTEM BACKUP
</td>

</tr>

<tr>
<td  align=center>
<img src="images/popup_rad_res.png" style="cursor:pointer" 
onClick="window.open('ipacctAdmin_popup.php?action=rad_res',null,'width=400,height=150,menubar=no')">
</td>

<td  align=center>
<img src="images/popup_clean_db.png" style="cursor:pointer" 
onClick="window.open('ipacctAdmin_popup.php?action=clean_db',null,'width=400,height=150,menubar=no')">
</td>

<td  align=center>
<img src="images/popup_index_db.png" style="cursor:pointer" 
onClick="window.open('ipacctAdmin_popup.php?action=index_db',null,'width=400,height=150,menubar=no')">
</td>

<td  align=center>
<img src="images/popup_sys_ver.png" style="cursor:pointer" 
onClick="window.open('ipacctAdmin_popup.php?action=sys_ver',null,'width=400,height=150,menubar=no')">
</td>

<td  align=center>
<img src="images/popup_backup.png" style="cursor:pointer" 
onClick="window.open('ipacctAdmin_popup.php?action=backup',null,'width=400,height=150,menubar=no')">
</td>

</tr>

</table>


</td>
</tr>
</table>

<br />
<br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">

<tr>
<td align=center valign=top width="40%">

<span id="status"></span>

</td>
<td align=right width="60%">

<form method="post" name="backup" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Ipacct Config : </h1>

<table width="95%" border="0" cellpadding="3" cellspacing="1">

<tr>
  <td id='tdlabel'>database host :</td>
  <td id='tdinput'> <input name="dbhost" type="text" value="#dbhost" class="txt" > </td>
</tr>

<tr>
  <td id='tdlabel'>database name :</td>
  <td id='tdinput'> <input name="dbname" type="text" value="#dbname" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>database user :</td>
  <td id='tdinput'> <input name="dbuser" type="text" value="#dbuser" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>database password :</td>
  <td id='tdinput'> <input name="dbpass" type="text" value="#dbpass" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>smtp server :</td>
  <td id='tdinput'> <input name="mailserver" type="text" value="#mailserver" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>mail from address :</td>
  <td id='tdinput'> <input name="mailfromaddr" type="text" value="#mailfromaddr" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>email to send backup :</td>
  <td id='tdinput'> <input name="email_backup" type="text" value="#email_backup" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>clean stale records :</td>
  <td id='tdinput'> <input name="clean_stale_after_days" type="text" value="#clean_stale_after_days" class="txt"> </td>
</tr>

<tr>
  <td id='tdlabel'>clean old records :</td>
  <td id='tdinput'> <input name="clean_old_after_days" type="text" value="#clean_old_after_days" class="txt"> </td>
</tr>

</table>
<p id='psubmit'><input class="button" type="submit"></p>
</form>

</td>
</tr>

</table>


