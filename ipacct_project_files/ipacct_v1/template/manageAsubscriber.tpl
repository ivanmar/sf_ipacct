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


<table class='data'>

<tr><th class='table_header' colspan='7'> Accounts list : </th> </tr>

  <tr class='col_header'>
    <td> User</td>
    <td> Password</td>
    <td> Sessions</td>
    <td> Last Login </td>
    <td> Time Spent </td>
    <td> Traffic Spent</td>
    <td> Status</td>
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
</tr>
</repeat>
</table>

