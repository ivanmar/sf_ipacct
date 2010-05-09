<form method="post" name="ispsuborg" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Add ISP SUBORG </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>Org name :</td>
  <td id='tdinput'> <input name="suborgname" type="text" class='txt' value="#suborgname" /> * </td>
</tr>
<tr>
  <td id='tdlabel'>ISP org : </td>
  <td id='tdinput'> <select name="isporg"> #isporg </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Address:</td>
  <td id='tdinput'> <input name="address" type="text" class='txt' value="#address" /> </td>
</tr>
<tr>
  <td id='tdlabel'>City :</td>
  <td id='tdinput'> <input name="city" type="text" class='txt' value="#city" />
    zip:
    <input name="zip" type="text" class="num" value="#zip" />
  </td>
</tr>

<tr>
  <td id='tdlabel'>Phone: </td>
  <td id='tdinput'> <input name="phone" type="text" class='txt' value="#phone" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Contact name :</td>
  <td id='tdinput'> <input name="contactname" type="text" class='txt' value="#contactname" /> </td>
</tr>
<tr> 
  <td id='tdlabel'>Email: </td>
  <td id='tdinput'> <input name="email" type="text" class='txt' value="#email" /> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

<table class='data'>

<tr><th class='table_header' colspan=8> SUBORG List </th> </tr>

<tr class='col_header'>
<td> Name </td>
<td> ISP</td>
<td> Address</td>
<td> City</td>
<td> Phone</td>
<td> Contact</td>
<td> Email</td>
<td> del</td>
</tr>

<repeat id="1">
<tr class='data_rows'>

<td> :suborgname:</td>
<td> :orgname:</td>
<td> :address:</td>
<td> :city:</td>
<td> :phone:</td>
<td> :contactname:</td>
<td> :email:</td>
<td> <a href="addISPSubOrg.php&#63;action=del&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
</repeat>


</table>

