<div id='login'>
<h1 class='data_header'> System User Login </h1>

<form method="post" name="login" action="#formaction">
<input type="hidden" name="loop" value="1">

<table class='formhold'>
 <tr>
   <td id='tdlabel'> User Name : </td>
   <td id='tdinput'><input name="username" type="text" class='txt'> </td>
 </tr>
 <tr>
    <td id='tdlabel'> Password : </td>
    <td id='tdinput'><input name="password" type="password" class='txt'> </td>
 </tr>
 <tr>
   <td id='tdlabel'> ISP Org : </td>
   <td id='tdinput'><select name="isporg"> #isporg </select> </td>
 </tr>
</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>
</div>
