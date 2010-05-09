<div id='form-holder-left'>
  #piechart
</div>

<div id='form-holder-right'>

<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by : </h1>

<table class='formhold'>
<tr>
 <td id='tdlabel'>ISP :</td>
 <td id='tdinput'> <select name="isporg"  onchange="reload(2)"> #isporg </select>
</td>
</tr>
<tr>
 <td id='tdlabel'>Log type:</td>
 <td id='tdinput'> <select name="trafftype"> #trafftype </select>
</td>
</tr>
<tr>
 <td id='tdlabel'>Start Date :</td>
 <td id='tdinput'> <script>DateInput('startdate',true,'YYYY-MM-DD','#startdate')</script> </td>
</tr>
<tr>
 <td id='tdlabel'>End Date :</td>
 <td id='tdinput'> <script>DateInput('enddate',true,'YYYY-MM-DD','#enddate')</script> </td>
</tr>
<tr>
 <td id='tdlabel'>Time step :</td>
 <td id='tdinput'>

  <INPUT type="radio" name="timestep" value="year"#year> year
  <INPUT type="radio" name="timestep" value="month"#month> month
  <INPUT type="radio" name="timestep" value="day"#day> day
  <INPUT type="radio" name="timestep" value="hour"#hour> hour

 </td>
</tr>
</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>
</div>

<p></p>
<p></p>
<p></p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td align=center>

#barchart

</td></tr></table>
<br>
<br>

