<div id='form-holder-left'>

<h1 class='data_header'> Common Details  : </h1>

<table>
<tr>
<td id='tdlabel'>Type / ID Series</td>
<td id='tdinput'>#acctype / #serid</td>
</tr>
<tr>
<td id='tdlabel'>Definition</td>
<td id='tdinput'>#definitionname</td>
</tr>
<tr>
<td id='tdlabel'>ISP</td>
<td id='tdinput'>#orgname </td>
</tr>
<tr>
<td id='tdlabel'>Creation Date</td>
<td id='tdinput'>#showcrdate</td>
</tr>
<tr>
<td id='tdlabel'>Limits: <i>(time / traffic / BW)</i></td>
<td id='tdinput'>#limittime / #limittraffic / #limitdownloadrate</td>
</tr>
</table>
</div>

<div id='form-holder-right'>

<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">
<input type="hidden" name="serid" value="#serid">

<h1 class='data_header'> Selected definition: </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'> Change definition :</td>
  <td id='tdinput'> <select name="definition"> #definition </select> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>
</form>
</div>

<table class='data'>

<tr><th class='table_header' colspan='8'> Accounts list : </th> </tr>

  <tr class='col_header'>
    <td> User</td>
    <td> Password</td>
    <td> Sessions</td>
    <td> Last Login </td>
    <td> Time Spent </td>
    <td> Traffic Spent</td>
    <td> Status</td>
    <td> del</td>
  </tr>

<repeat id="2">
<tr class='data_rows'>
   <td> :username:</td>
   <td> :password:</td>
   <td> :logsessions:</td>
   <td> :lastlogin:</td>
   <td> :sessiontime:</td>
   <td> :traffic:</td>
   <td> :status:</td>
   <td> <a href='manageApostpaid.php&#63;action=del&serid=#serid&username=:username:'><img src='images/return.png' border=0></a> </td>
</tr>
</repeat>
</table>

