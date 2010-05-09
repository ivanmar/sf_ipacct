<html>
<head>
<title>Primus IPACCT Change ISP info</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="include/css/css_styles_popup.css" rel="stylesheet" type="text/css" />
</head>
<body onload=" #onload ">

<form method="post" enctype="multipart/form-data" action="#formaction" name="editisp">
<input type="hidden" name="loop" value="1">
<input type="hidden" name="ispid" value="#ispid">

<h1 class='data_header'> EDIT ISP INFO </h1>

<table class='formhold'>


<tr>
 <td colspan="2" align=right>
  <i> LOGO IMAGE </i> <img src="images/logoisp/logo-#ispimg.jpg" border="1" height=40>
 </td>
</tr>

<tr>
 <td id='tdlabel'> ISP name :</td>
 <td id='tdinput'> <input name="orgname" type="text" value="#orgname" /> * </td>
</tr>

<tr>
 <td id='tdlabel'>Address :</td>
 <td id='tdinput'> <input name="address" type="text" value="#address" /> </td>
</tr>

<tr>
  <td id='tdlabel'>City :</td>
  <td id='tdinput'> <input name="city" type="text" value="#city" />
  zip:
  <input name="zipcode" type="text" class="num" value="#zipcode" />
 </td>
</tr>

<tr>
 <td id='tdlabel'>Phone: </td>
 <td id='tdinput'> <input name="phone" type="text" value="#phone" /> </td>
</tr>

<tr>
 <td id='tdlabel'> Contact name :</td>
 <td id='tdinput'> <input name="contactname" type="text" value="#contactname" /></td>
</tr>

<tr>
 <td id='tdlabel'>Report e-mail :</td>
 <td id='tdinput'> <input name="email_report" type="text" value="#email_report" /> </td>
</tr>

<tr>
 <td id='tdlabel'>NAS admin e-mail :</td>
 <td id='tdinput'> <input name="email_nasadmin" type="text" value="#email_nasadmin" /></td>
</tr>

<tr>
 <td id='tdlabel'>Commission :</td>
 <td id='tdinput'> <input name="pst_commission" type="text" class="num" value="#pst_commission" /> (%)  </td>
</tr>

<tr>
  <td id='tdlabel'>Change logo image : <br> 
    <span class='desc'> (JPG W:60px, H:40px) </span></td>
  <td id='tdinput'> <input name='logo' type='file' class="logoimg" />   </td>
</tr>

<tr>
 <td id='tdlabel'> Billing info :</td>
 <td id='tdinput'> <textarea name="billinginfo">#billinginfo</textarea> </td>
</tr>

</table>
<p id='psubmit'><input class="button" type="submit"></p>
</form>


