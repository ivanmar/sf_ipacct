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
<repeat id="1">
<p align='right'>
 <i>Print Series :</i> 
 <img src=images/print.png style="cursor:pointer" onClick="#click1">
</p>
</repeat>
</div>


<table class='data'>

<tr><th class='table_header' colspan='12'> Accounts list : </th> </tr>

  <tr class='col_header'>
    <td> ID Card</td>
    <td> User</td>
    <td> Password</td>
    <td> Last Login </td>
    <td> Session Time </td>
    <td> Sessions </td>
    <td> Traffic</td>
    <td> Status</td>
    <td> Date Sold</td>
    <td> Date Storn</td>
    <td> sold</td>
    <td> storn</td>
  </tr>
<repeat id="2">
<tr class='data_rows'>
   <td> :s_card:</td>
   <td> :username:</td>
   <td> :password:</td>
   <td> :lastlogin:</td>
   <td> :sessiontime:</td>
   <td> :sessions:</td>
   <td> :traffic:</td>
   <td> :status:</td>
   <td> :datesale:</td>
   <td> :datestorn:</td>
   <td> <a href='manageAprepaid.php&#63;action=sold&serid=#serid&username=:username:'> <img src='images/sold.png'></a> </td>
   <td> <a href='manageAprepaid.php&#63;action=storn&serid=#serid&username=:username:'> <img src='images/return.png'></a> </td>
</td>
</tr>
</repeat>
</table>
