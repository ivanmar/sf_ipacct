<html>
<head>
<title>Primus IPACCT Change Definition info</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="include/css/css_styles_popup.css" rel="stylesheet" type="text/css">
</head>
<body onload=" #onload ">


<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">
<input type="hidden" name="defid" value="#defid">

<h1 class='data_header'> EDIT USAGE DEFINITION </h1>

<table class='formhold'>

<tr>
 <td id='tdlabel'>Definition name :</td>
 <td id='tdinput'> #defname </td>
</tr>

<tr>
  <td id='tdlabel'>ISP:</td>
  <td id='tdinput'> #orgname </td>
</tr>

<tr>
  <td id='tdlabel'>Account type  :</td>
  <td id='tdinput'> #acctype </td>
</tr>

<tr>
  <td id='tdlabel'>Time usage limit : </td>
  <td id='tdinput'><input name="timelimit" type="text" value="#timelimit" class="num"> sec</td>
</tr>

<tr>
  <td id='tdlabel'>Traffic usage limit :</td>
  <td id='tdinput'><input name="traflimit" type="text" value="#traflimit" class="num"> bytes</td>
</tr>

<tr>
  <td id='tdlabel'>Download / Upload rate :</td>
  <td id='tdinput'>
   <input name="download" type="text" value="#download" class="num"> / 
   <input name="upload" type="text" value="#upload" class="num">  Bps
  </td>
</tr>

<tr>
  <td id='tdlabel'>Validity after first login :</td>
  <td id='tdinput'><input name="firstvalid" type="text" value="#firstvalid" class="num"> sec </td>
</tr>

<tr>
  <td id='tdlabel'>Number of simul users :</td>
  <td id='tdinput'><input name="simuse" type="text" value="#simuse" class="num"> </td>
</tr>

<tr>
  <td id='tdlabel'>Redirect home page :</td>
  <td id='tdinput'><input name="homepage" type="text" value="#homepage" />  </td>
</tr>

<tr>
  <td id='tdlabel'>Idle Timeout :</td>
  <td id='tdinput'><input name="idletimeout" type="text" value="#idletimeout" class="num"> sec </td>
</tr>

</table>
<p id='psubmit'><input class="button" type="submit"></p>
</form> 

</body>
