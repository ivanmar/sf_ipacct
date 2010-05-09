<script>

var container1 = 'onliners';
var url1 = 'onlineUsers_ajx.php';
var pars1 = '#param';

var container2 = 'statusbar';
var url2 = 'onlineUsersCount_ajx.php';

var countAjax;
var recordAjax;

</script>

<div id='form-holder-right'>
<form method="post" name="onlineusers" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by : </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'>Refresh Interval :</td>
  <td id='tdinput'>
   <select id="interval" onclick="restart(this.value)">
     <option value='10'>10 sec</option>
     <option value='20'>20 sec</option>
     <option value='30'>30 sec</option>
   </select>
  </td>
</tr>

<tr>
  <td id='tdlabel'>Select ISP :</td>
  <td id='tdinput'> <select name="isporg" onchange="reload(2)"> #isporg </select> </td>
</tr>
</table>
</form>
</div>

<table class='formhold'>
<tr><td>

<span id="onliners"> </span>

</td></tr></table>
