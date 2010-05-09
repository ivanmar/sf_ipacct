<div id='form-holder-right'>
<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by ISP </h1>


<table class='formhold'>

<tr>
  <td id='tdlabel' width='50%'>ISP :</td>
  <td id='tdinput'> <select name="isporg" onchange="reload(2)"> #isporg </select> </td>
</tr>

</table>
</form>

</div>

<table class='data'>

<tr><th class='table_header' colspan=11> Definition List </th> </tr>

  <tr class='col_header'>
    <td>Name </td>
    <td>Type</td>
    <td>Time limit <br /></td>
    <td>Traffic limit </td>
    <td>Val. after use</td>
    <td>BW limit</td>
    <td>Simult </td>
    <td>BU price</td>
    <td>ISP</td>
    <td>edit</td>
    <td>del</td>
  </tr>
<repeat id="1">
<tr class='data_rows'>
 <td>:definitionname:</td>
 <td align=right>:acctype:</td>
 <td align=right>:showtimelimit:</td>
 <td align=right>:showtrafficlimit:</td>
 <td align=right>:showusageperiod:</td>
 <td align=right>:showbwlimit:</td>
 <td align=right>:simuse:</td>
 <td align=right>:pricebillingunit:</td>
 <td align=center>:orgname:</td>
 <td align=center> <img src=images/icon-edit.png border=0 style="cursor:pointer" 
  onclick="window.open&#40;'manageDef_popup.php&#63;id=:id:',null,'width=670,height=380,menubar=no,scrollbars=no'&#41;">
 </td>
 <td align=center><a href="manageDef.php&#63;action=del&isporg=:id_isporg:&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
</repeat>
</table>

