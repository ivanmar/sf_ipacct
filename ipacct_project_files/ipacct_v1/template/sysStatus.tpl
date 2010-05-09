<script>

var container1 = 'onlinenas';
var container2 = 'radiuslog';
var container3 = 'statusbar';
var url1 = 'nasStatus_ajx.php';
var url2 = 'sysLog_ajx.php';
var url3 = 'sysUptime_ajx.php';
var pars1 = '#param';
var pars2 = '#log';
var pars3 = null;

var recordAjax;
var radiusAjax;
var uptimeAjax;

</script>

<div id='form-holder-left'>
  <span id="onlinenas"></span>
</div>

<div id='form-holder-right'> 

<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Filter by ISP: </h1>

<table class='formhold'>
<tr> 
  <td id='tdlabel'>ISP :</td> 
  <td id='tdinput'> <select name="isporg" onchange="reload(2)">  #isporg </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Log type :</td> 
  <td id='tdinput'> <select id="ltype" name="logtype" onchange="logrefresh(5)"> #logtype </select>  </td> 
</tr>

<tr>
  <td id='tdlabel'>Keyword :</td> 
  <td id='tdinput'> <input id="kword" type="text" class='txt' name="keyword" value="#keyword" onchange="logrefresh(5)">
  </td>
</tr>

<tr>
  <td id='tdlabel'>Last lines :</td> 
  <td id='tdinput'> <select id="last" name="lines" onchange="logrefresh(5)"> #lines </select> </td>
</tr>

</table>
</form>
</div>

<table class='data'>

<tr><th class='table_header'> Log contents: </th> </tr>
 <tr>
  <td id='logwin' height="150">
    <span id="radiuslog"></span>
  </td>
 </tr>
</table>

