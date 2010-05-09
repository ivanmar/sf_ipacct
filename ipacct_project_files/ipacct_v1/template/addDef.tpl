<form method="post" name="adddef" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">

<h1 class='data_header'> Usage Definition Creation </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'>Definition name :</td>
  <td id='tdinput'> <input name="defname" type="text" value="#defname" class="txt"> * </td>
</tr>
<tr>
  <td id='tdlabel'>ISP name   :</td>
  <td id='tdinput'> <select name="isporg"> #isporg </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Account types :</td>
  <td id='tdinput'> <select name="acctype" onchange="reload(2)"> #acctype </select> * </td>
</tr>
<tr>
  <td id='tdlabel'>Time usage limit :</td>
  <td id='tdinput'> <input name="timelimit" type="text" value="#timelimit" class="num">
    mu :
   <select name="timeunit"> #timeunit </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Traffic usage limit : </td>
  <td id='tdinput'> <input name="traflimit" type="text" value="#traflimit" class="num">
    mu :
    <select name="trafunit"> #trafunit </select> </td>
</tr>
<tr>
  <td id='tdlabel'>Download / Upload rate :</td>
  <td id='tdinput'> <input name="download" type="text" value="#download" class="num" size="4"> / 
    <input name="upload" type="text" value="#upload" class="num" size="4">
    kB <span class='desc'>(1024 kB = 1 MB)</span> </td>
</tr>
<tr>
  <td id='tdlabel'>Validity after first login : </td>
  <td id='tdinput'> <input name="firstvalid" type="text" value="#firstvalid" class="num"> days
</td>
</tr>
<tr>
  <td id='tdlabel'>Number of Simultaniuos users :</td>
  <td id='tdinput'>
    <input name="simuse" type="text" value="#simuse" class="num"> <span class='desc'>  (leave empty for no simuse checking) </span> </td>
</tr>
<tr>
  <td id='tdlabel'>Idle Timeout :</td>
  <td id='tdinput'> 
    <input name="idletimeout" type="text" value="#idletimeout" class="num">sec <span class='desc'> (auto logoff - ex: 600 = 10min)</span>
</td>
</tr>
<tr>
  <td id='tdlabel'>Redirect home page :</td>
  <td id='tdinput'>
   <input name="homepage" type="text" class="txt" value="#homepage" /> <span class='desc'>  (ex. http://www.google.com) </span> 
  </td>
</tr>

<tr>
  <td id='tdlabel'>Measure unit :</td>
  <td id='tdinput'> <select name="unit"> #unit </select> </td>
</tr>

<tr>
  <td id='tdlabel'>Billing unit :</td>
  <td id='tdinput'> <input name="bunit" type="text" class='num' value="#bunit"  "#robunit">
    <span class='desc'>(number of kB or minutes) </span> </td>
</tr>
<tr>
  <td id='tdlabel'>Billing unit / Card price : </td>
  <td id='tdinput'> <input name="bprice" type="text" class='num' value="#bprice"> kn  </td>
</tr>
<tr>
  <td id='tdlabel'>On start price :</td>
  <td id='tdinput'> <input name="oprice" type="text" class='num' value="#oprice"  "#rooprice"> kn  </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

