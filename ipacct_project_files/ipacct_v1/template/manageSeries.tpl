<div id='form-holder-right'>
<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by ISP </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'>ISP :</td>
  <td id='tdinput'> <select name="isporg" onchange="reload(2)"> #isporg </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Account Type :</td>
  <td id='tdinput'> <select name="acctype" onchange="reload(2)"> #acctype </select> </td>
</tr>

</table>
</form>

</div>


<table class='data'>

<tr><th class='table_header' colspan=11> Account Series </th> </tr>

<tr class='col_header'>
<td> ID</td>
  <td> Nr acc</td>
  <td> Def name</td>  <td> Status</td>
  <td> Creation date</td>
  <td> Type</td>
  <td> Expire date </td>
  <td> Created by </td>
  <td> Billing</td>
  <td width="5%"> manage</td>
  <td width="5%"> del</td>
</tr>

<repeat id="1">
<tr class='data_rows'>
  <td> :id:</td>
  <td> :nraccount:</td>
  <td> :definitionname:</td>
  <td> :status:</td>
  <td> :showcrdate:</td>
  <td> :acctype:</td>
  <td> :expiredate:</td>
  <td> :username:</td>
  <td> :billing:</td>
  <td> <a href="manageA:acctype:.php&#63;action=show&serid=:id:"><img src='images/info.png'></a></td>
  <td> <a href="manageSeries.php&#63;action=del&isporg=:id_isporg:&acctype=:acctype:&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
</repeat>

</table>

