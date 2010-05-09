<div id='form-holder-right'>
<form method="post" name="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> &nbsp </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'> _username_ : </td>
  <td id='tdinput'><input name="username" type="text" class='txt'> <br><br> </td>
</tr>
</table>

<p id='psubmit'><input class="button" type="submit"></p>
</form>
</div>

<table class='data'>

<tr><th class='table_header' colspan=10> _billlist_ </th> </tr>

  <tr class='col_header'>
    <td> _nrbill_ </td>
    <td> _username_ </td>
    <td> _date_ </td>
    <td> _issuedby_ </td>
    <td> _mu_ </td>
    <td> _bu_ </td>
    <td> _buspent_ </td>
    <td> _buprice_ </td>
    <td> _totalprice_ </td>
    <td> _print_ </td>
  </tr>
<repeat id="1">

<tr class='data_rows'>
 <td> :s_bill:</td>
 <td> :username:</td>
 <td> :srvstoptime:</td>
 <td> :systemuser:</td>
 <td> :measureunit:</td>
 <td> :billingunit:</td>
 <td> :buspent:</td>
 <td> :pricebillingunit:</td>
 <td> :totalprice:</td>
 <td> <img src='images/info.gif' border="0" style="cursor:pointer"
   onclick="window.open&#40;'printBill.php&#63;s_bill=:s_bill:',null,'width=800'&#41;">
 </td>
</tr>
</repeat>
</table>

