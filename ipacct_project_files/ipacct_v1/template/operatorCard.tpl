
<table class='formhold'>
<tr  bgcolor="#CCCCCC">
<td height=75> </td>
<repeat id="1">
<form method="post" name="form1" action="operatorCard.php">
  <input type="hidden" name="loop" value="1">
  <input type="hidden" name="serid" value=":id_accseries:">
  <td align=center>
   <b> :definitionname: </b> <br>
   <input name="imageField" type="image" src="images/form/writecard.png">  <br>
   serie : :id_accseries: <br>
   _accounts_ : :nraccount: <br>
   _price_ : :pricebillingunit:
  </td>
</form>
</repeat>

</tr>
</table>

<br />
<br />


<div id='form-holder-right'>

<form method="post" name="form2" id="form1" action="#formaction">
<input type="hidden" name="loop" value="2">

<h1 class='data_header'> _stornaccount_ : </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'>Storn ID :</td>
  <td id='tdinput'> <input name="scard" type="text" class="txt" /> <br><br>  </td>
</tr>
</table>

<p id='psubmit'><input class="button" type="submit"></p>
</form>
</div>

<table class='data'>

<tr><th class='table_header' colspan='8'> _issuedcards_  </th> </tr>

  <tr class='col_header'>
    <td> print</td>
    <td> storn ID </td>
    <td> ser ID </td>
    <td> _username_ </td>
    <td> _saledate_ </td>
    <td> _definition_ </td>
    <td> _price_ </td>
    <td> _issuedby_ </td>
  </tr>

<repeat id="2">
<tr class='data_rows'>
   <td> <img src='images/info.gif' border="0" style="cursor:pointer"
 	onclick="window.open&#40;'printCardPos.php&#63;s_card=:s_card:',null,'width=500'&#41;"> </td>
   <td> :s_card:</td>
   <td> :id_accseries:</td>
   <td> :carduser: </td>
   <td> :showdatesale:</td>
   <td> :definitionname:</td>
   <td> :pricebillingunit:</td>
   <td> :username:</td>
</tr>
</repeat>

</table>



