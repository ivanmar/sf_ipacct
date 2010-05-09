<form method="post" name="subscriber" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Subscriber account creation </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>ISP :</td>
  <td id='tdinput'> <select name="isporg" onchange="reload(3)"> #isporg </select> </td>
  <td id='tdlabel'>  Definition info :  </td>
</tr>

<tr>
  <td id='tdlabel'> Definition  : </td>
  <td id='tdinput'> <select name="definition" onchange="reload(2)"> #definition </select> </td>
  <td rowspan='9' align="center" valign="top" width='180'>
	<table class='formhold'>
	<repeat id="1">
	<tr id='logdata'>
 	 <td>:name:</td>
	 <td>:val:</td>
	</tr>
	</repeat>
	</table>
  </td>
</tr>

<tr>
  <td id='tdlabel'>Org unit :</td>
  <td id='tdinput'> <select name="ispsuborg" onchange="reload(4)"> #ispsuborg </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Radius Location : </td>
  <td id='tdinput'> <select name="radlocation"> #radlocation </select> </td>
</tr>

<tr>
	<td id='tdlabel'>Username  :</td>
	<td id='tdinput'><input name="username" type="text" class='txt' value="#username" /> *</td>
</tr>
<tr>
	<td id='tdlabel'>Password : </td>
	<td id='tdinput'><input name="pass" type="password" class='txt' /> *</td>
</tr>
<tr>
	<td id='tdlabel'>Full Name  :</td>
	<td id='tdinput'><input name="fullname" type="text" class='txt' value="#fullname" /></td>
</tr>
<tr>
	<td id='tdlabel'>e-mail   :</td>
	<td id='tdinput'><input name="email" type="text" class='txt' value="#email" /></td>
</tr>
<tr>
	<td id='tdlabel'>Telephone : </td>
	<td id='tdinput'><input name="phone" type="text" class='txt' value="#phone" /></td>
</tr>
					
<tr>
	<td id='tdlabel'>Street Address   :</td>
	<td id='tdinput'><input name="address" type="text" class='txt' value="#address" /></td>
</tr>
<tr>
	<td id='tdlabel'>City   :</td>
	<td id='tdinput'><input name="city" type="text" class='txt' value="#city" /></td>
</tr>

</table>
<p id='psubmit'><input class="button" type="submit"></p>
</form>

