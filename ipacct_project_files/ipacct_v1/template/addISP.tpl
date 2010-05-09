<form method="post" enctype="multipart/form-data" action="#formaction" name="addisp">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Add ISP Org </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>ISP name :</td>
  <td id='tdinput'> <input name="ispname" type="text" class='txt' value="#ispname" /> * </td>
</tr>
<tr>
  <td id='tdlabel'>Address :</td>
  <td id='tdinput'> <input name="address" type="text" class='txt' value="#address" /> </td>
</tr>
<tr>
  <td id='tdlabel'>City :</td>
  <td id='tdinput'> <input name="city" type="text" class='txt' value="#city" />
    zip:
  <input name="zip" type="text" class="num" value="#zip" /> </td>
</tr>

<tr>
  <td id='tdlabel'>Phone: </td>
  <td id='tdinput'> <input name="phone" type="text" class='txt' value="#phone" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Contact name :</td>
  <td id='tdinput'> <input name="contact" type="text" class='txt' value="#contact" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Report e-mail :</td>
  <td id='tdinput'> <input name="email_report" type="text" class='txt' value="#email_report" /> </td>
</tr>
<tr>
  <td id='tdlabel'>NAS admin e-mail :</td>
  <td id='tdinput'> <input name="email_nasadmin" type="text" class='txt' value="#email_nasadmin" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Commission :</td>
  <td id='tdinput'> <input name="pst_commission" type="text" class="num" value="#pst_commission" /> <i> (%) </i></td>
</tr>
<tr>
  <td id='tdlabel'>Upload logo image : <br>  <span class='desc'> (JPG W:60px, H:40px) </span> </td>
  <td id='tdinput'> <input name='logo' type='file' class="logoimg" />   </td>
</tr>
<tr>
  <td id='tdlabel'>Billing info :</td>
  <td id='tdinput'> <textarea name="billing" class="text">#billing </textarea> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

<table class='data'>

<tr><th class='table_header' colspan=11> ISP List </th> </tr>

<tr class='col_header'>
<td> image</td>
<td> name </td>
<td> Address</td>
<td> City</td>
<td> Phone</td>
<td> Contact name</td>
<td> Report email</td>
<td> NAS email</td>
<td> Billing info</td>
<td> edit</td>
<td> del</td>
</tr>

<repeat id="1">
<tr class='data_rows'>
<td> <img src="images/logoisp/logo-:ispimg:.jpg" height=20 width=30></td>
<td> :orgname:</td>
<td> :address:</td>
<td> :city:</td>
<td> :phone:</td>
<td> :contactname:</td>
<td> :email_report:</td>
<td> :email_nasadmin:</td>
<td> :billinginfo:</td>
<td> <img src=images/icon-edit.png style="cursor:pointer" 
 onclick="window.open&#40;'manageISP_popup.php&#63;id=:id:',null,'width=700,height=500,menubar=no,scrollbars=no'&#41;"> </td>
<td> <a href="addISP.php&#63;action=del&id=:id:"><img src='images/icon-del.png'></a></td>
</tr>
</repeat>


</table>

