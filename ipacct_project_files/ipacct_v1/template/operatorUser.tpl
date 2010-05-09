<script>

var container1 = 'onlinenas';
var url1 = 'nasStatus_ajx.php';
var pars1 = '#param';

var recordAjax;

</script>

<div id='form-holder-left'>
  <span id="onlinenas"></span>
</div>


<div id='form-holder-right'>
<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> _manageuser_ </h1>

<table class='formhold'>
<tr>
  <td id='tdlabel'> _username_ :</td>
  <td id='tdinput'> <input name="username" type="text" class="txt" value="#username" /> </td>
</tr>
<tr>
  <td colspan='2' align='right'> 
    <input name='imageField' type='image' src='images/form/check.png' style='width:28px; height:37px; border:0;'>
<repeat id="1">
  <img src="images/form/#action.gif" onclick="reload&#40;#numaction&#41;">
</repeat>
</td>
</tr>
</table>
</form>
</div>

<table class='data'>

<tr><th class='table_header' colspan='8'> _billingdata_  - #orgname </th> </tr>

  <tr class='col_header'>
    <td> _print_ </td>
    <td> _username_ </td>
    <td> _mu_ </td>
    <td> _bu_ </td>
    <td> _pricebu_ </td>
    <td> _startprice_ </td>
    <td> _buspent_ </td>
    <td> _totalprice_ </td>
  </tr>

<repeat id="2">
  <tr class='data_rows'>
    <td> 
     <img src='images/info.png' style="cursor:pointer" onclick="window.open&#40;'printUser.php&#63;user=:username:',null,'width=500'&#41;">
    </td>
    <td> :showusername:</td>
    <td> :measureunit:</td>
    <td> :billingunit:</td>
    <td> :pricebillingunit:</td>
    <td> :priceonstart:</td>
    <td> :buspent:</td>
    <td> <b>:totalprice:</b></td>
   </tr>
</repeat>

  <tr class='col_header'>
    <td colspan="8" align="right"> <b>#sumtotalprice</b></td>
  </tr>
</table>

