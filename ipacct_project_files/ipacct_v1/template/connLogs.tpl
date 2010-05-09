<div id='form-holder-right'>
<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by : </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>Username :</td>
  <td id='tdinput'> <input name="username" type="text" class='txt' value="#username" /> </td>
</tr>

<tr>
  <td id='tdlabel'>ISP :</td>
  <td id='tdinput'> <select name="isporg" > #isporg </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Termination Cause :</td>
  <td id='tdinput'> <select name="termcause"> #termcause </select> </td>
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

<tr><th class='table_header' colspan=11> Connection Logs </th> </tr>

<tr class='col_header'>
 <td> Ser id</td>
 <td> Def</td>
 <td> User</td>
 <td> Type</td>
 <td> Start Time</td>
 <td> Session Time</td>
 <td> Traffic</td>
 <td> ISP</td>
 <td> NAS</td>
 <td> Termination</td>
 <td> del</td>
</tr>

<repeat id="1">
<tr class='data_rows'>
 <td> <a href='manageA:acctype:.php&#63;action=show&serid=:pacc_id_accseries:'><b>:pacc_id_accseries:</b></a></td>
 <td> :definitionname:</td>
 <td> :username:</td>
 <td> :acctype:</td>
 <td> :acctstarttime:</td>
 <td> :acctsessiontime:</td>
 <td> :traffic:</td>
 <td> :orgname:</td>
 <td> :nasipaddress:</td>
 <td> :acctterminatecause:</td>
 <td> <a href='connLogs.php&#63;action=del&id=:radacctid:'><img src='images/icon-del.png' border=0></a> </td>	  
</tr>
</repeat>

<tr>
<td colspan='11'> </td>
</tr>

<tr class='col_header'>
<td colspan='11' align='right'> <b>#totaltime</b> / <b>#totaltraffic</b> </td>
</tr>
</table>

</table>


