<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Add NAS </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>DNS or IP:</td>
  <td id='tdinput'> <input name="nasipdns" type="text" class='txt' value="#nasipdns" /> </td>
</tr>

<tr>
  <td id='tdlabel'>MAC Address  :</td>
  <td id='tdinput'> <input name="macaddress" type="text" class='txt' value="#macaddress"/> 
    <span class='desc'>(form: xx-xx-xx-xx-xx-xx) </span>
  </td>
</tr>
<tr>
  <td id='tdlabel'>NAS Short Name:</td>
  <td id='tdinput'> <input name="shortname" type="text" class='txt' value="#shortname" /> * 
    <span class='desc'>(without spaces) </span>
  </td>
</tr>
<tr>
  <td id='tdlabel'>Radius Secret  :</td>
  <td id='tdinput'> <input name="radsecret" type="text" class='txt' value="#radsecret"/> </td>
</tr>

<tr>
  <td id='tdlabel'>ISP org : </td>
  <td id='tdinput'> <select name="isporg" onchange="reload(3)"> #isporg </select> &nbsp
    Sub org : 
    <select name="ispsuborg"  onchange="reload(4)"> #ispsuborg </select> 
  </td>
</tr>

<tr>
  <td id='tdlabel'>NAS vendor   :</td>
  <td id='tdinput'> <select name="nasvendor"> #nasvendor </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Radius Location : </td>
  <td id='tdinput'> <select name="radlocation"> #radlocation </select> </td>
</tr>

<tr>
  <td id='tdlabel'>NAS Wireless SSID :</td>
  <td id='tdinput'> <input name="ssid" type="text" class='txt' value="#ssid"/>  </td>
</tr>

<tr>
  <td id='tdlabel'>HTTP Admin Port :</td>
  <td id='tdinput'> <input name="adminport" type="text" value="#adminport" class="num"/>  </td>
</tr>

<tr>
  <td id='tdlabel'>Connection Username / Password :</td>
  <td id='tdinput'> 
     <input name="connuser" type="text" class='txt' value="#connuser"/> / 
     <input name="connpass" type="text" class='txt' value="#connpass"/>
  </td>
</tr>

<tr>
  <td id='tdlabel'>NAS Admin Username / Password :</td>
  <td id='tdinput'>
   <input name="adminuser" type="text" class='txt' value="#adminuser"/> / 
   <input name="adminpass" type="text" class='txt' value="#adminpass"/>
  </td>
</tr>

<tr>
  <td id='tdlabel'>Description   : </td>
  <td id='tdinput'> <textarea name="desc">#desc</textarea> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

<table class='data'>

<tr><th class='table_header' colspan=10> NAS List </th> </tr>

<tr class='col_header'>

<td> Short Name</td>
<td> ISP</td>
<td> Sub Org</td>
<td> DNS/IP</td>
<td> Secret</td>
<td> Vendor</td>
<td> IP</td>
<td> SSID</td>
<td> edit</td>
<td> del</td>
</tr>

<repeat id="5">
<tr class='data_rows'>

<td> :shortname:</td>
<td> :orgname:</td>
<td> :suborgname:</td>
<td> :nasname:</td>
<td> :secret:</td>
<td> :type:</td>
<td> :pacc_nasipaddress:</td>
<td> :pacc_ssid:</td>
<td> <img src=images/icon-edit.png style="cursor:pointer" 
 onclick="window.open&#40;'manageNAS_popup.php&#63;id=:id:',null,'width=700,height=430,menubar=no,scrollbars=no'&#41;">
</td>
<td><a href="addNAS.php&#63;action=del&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
<tr>
<td align=right>&nbsp</td>
<td colspan="9">:description:</td>
</tr>
</repeat>


</table>

