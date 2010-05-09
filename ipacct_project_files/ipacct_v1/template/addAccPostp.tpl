<form method="post" name="addpostp" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Postpaid accounts creation </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>ISP :</td>
  <td id='tdinput'> <select name="isporg" onchange="reload(3)"> #isporg </select> </td>
  <td id='tdlabel'>  Definition info :  </td>
</tr>

<tr>
  <td id='tdlabel'> Definition : </td>
  <td id='tdinput'> <select name="definition" onchange="reload(2)"> #definition </select> </td>

  <td rowspan="4" align="center" valign="top" width='180'>
	<table class='formhold'>
	<repeat id="1">
	<tr id='logdata'>
	 <td>:name:</td>
	 <td>:val:</td>
	</tr>
	</repeat>
	</td>
	</tr>
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
  <td id='tdlabel'>Account numbers : <p class='desc'>
    <i>  (ex. comma separated  <br> room numbers </i><br>
	202-209,300,301,302) </p> 
   </td>
  <td id='tdinput'> <textarea name="accounts" class="text">#accounts</textarea> </td>
</tr>
</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

