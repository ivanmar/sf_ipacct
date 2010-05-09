<div id='form-holder-right'>
<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by : </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'>ISP :</td>
  <td id='tdinput'> <select name="isporg" > #isporg </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Type of service:</td>
  <td id='tdinput'> <select name="billtype"> #billtype </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Start Date :</td>
  <td id='tdinput'> <script>DateInput('startdate',true,'YYYY-MM-DD','#startdate')</script> </td>
</tr>
<tr>
  <td id='tdlabel'>End Date :</td>
  <td id='tdinput'> <script>DateInput('enddate',true,'YYYY-MM-DD','#enddate')</script> </td>
</tr>
</table>

<p id='psubmit'> <input class="button" type="submit"> </p>

</form>
</div>


<table class='data'>

<tr><th class='table_header' colspan='9'> Billing Data for ISP: #orgname </th> </tr>


<tr class='col_header'>
 <td> Ser id</td>
 <td> Def id</td>
 <td> Sessions</td>
 <td> Mesure Unit</td>
 <td> Billing Unit</td>
 <td> Price BU</td>
 <td> Price on start</td>
 <td> BU spent</td>
 <td> Total price</td>
</tr>

<repeat id="1">
<tr class='data_rows'>
 <td><a href='manageA:acctype:.php&#63;action=show&serid=:serid:'><b> :serid: </b> </a></td>
 <td>:defid:</td>
 <td>:sessions:</td>
 <td>:measureunit:</td>
 <td>:billingunit:</td>
 <td>:pricebillingunit:</td>
 <td>:priceonstart:</td>
 <td>:buspent:</td>
 <td><b>:totalprice:</b></td>
</tr>
</repeat>

<tr>
<td colspan='9'> </td>
</tr>

<tr class='col_header'>
<td colspan='9' align='right'> <b> #sumtotalprice </b> </td>
</tr>
</table>

