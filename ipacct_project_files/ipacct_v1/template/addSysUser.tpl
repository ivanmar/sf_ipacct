<form method="post" name="addisp" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Add System User </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>Username  :</td>
  <td id='tdinput'> <input name="username" type="text" class='txt' value="#username" /> * </td>
</tr>
<tr>
  <td id='tdlabel'>Password : </td>
  <td id='tdinput'> <input name="pass" type="password" class='txt' value="#password"/> * </td>
</tr>
<tr>
  <td id='tdlabel'>ISP : </td>
  <td id='tdinput'> <select name="isporg" onchange="reload(2)"> #isporg </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Type : </td>
  <td id='tdinput'> <select name="acctype"> #acctype </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Full Name :</td>
  <td id='tdinput'><input name="fullname" type="text" class='txt' value="#fullname" /> </td>
</tr>
<tr>
  <td id='tdlabel'>e-mail :</td>
  <td id='tdinput'><input name="email" type="text" class='txt' value="#email" /></td>
</tr>
<tr>
  <td id='tdlabel'>Telephone : </td>
  <td id='tdinput'><input name="phone" type="text" class='txt' value="#phone" /></td>
</tr>
<tr>
  <td id='tdlabel'>Mobile :</td>
  <td id='tdinput'><input name="mobile" type="text" class='txt' value="#mobile" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Operator sub org</td>
  <td id='tdinput'> <select name="ispsuborg"> #ispsuborg </select> </td>
</tr>
<tr>
  <td id='tdlabel'>User Language</td>
  <td id='tdinput'> <select name="lang"> #lang </select> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

<table class='data'>

<tr><th class='table_header' colspan=9> System User List </th> </tr>

<tr class='col_header'>

<td> Username </td>
<td> ISP</td>
<td> Type</td>
<td> Full name</td>
<td> Email</td>
<td> Phone</td>
<td> Mobile</td>
<td> pass</td>
<td> del</td>
</tr>

<repeat id="1">
<tr class='data_rows'>
<td> :username:</td>
<td> :orgname:</td>
<td> :acctype:</td>
<td> :name:</td>
<td> :email:</td>
<td> :phone:</td>
<td> :mobile:</td>
<td>
 <img src='images/icon-edit.png' style="cursor:pointer"
 onclick="window.open&#40;'manageUserPass_popup.php&#63;id=:id:',null,'width=400,height=160,menubar=no,scrollbars=no'&#41;">
</td>
<td><a href="addSysUser.php&#63;action=del&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
</repeat>

</table>

