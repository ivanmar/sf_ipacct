<div id='form-holder-right'>

<form method="post" id="form1" name="upgrade" action="#formaction">
<input type="hidden" name="loop" value="1">
<input type="hidden" name="files" value="#files">

<h1 class='data_header'> Create upgrade </h1>

<table class='formhold'>

<tr>
  <td id='tdlabel'> Version :</td>
  <td id='tdinput'> <input name="numversion" type="text" value="#numversion" class="txt" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Build :</td>
  <td id='tdinput'> <input name="numbuild" type="text" value="#numbuild" class="txt" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Archive name :</td>
  <td id='tdinput'> <input name="tarname" type="text" class='txt' value="#tarname" /> </td>
</tr>
<tr>
  <td id='tdlabel'>Post action : </td>
  <td id='tdinput'> <select name="postaction"> #postaction </select> </td>
</tr>

</table>

<p id='psubmit'><input class="button" type="submit"></p>
</div>

<table class='formhold'>

<tr><th class='table_header' colspan=3> Archive Content </th> </tr>

<tr>
<td>
<select multiple name="fname" ondblclick="reload(2)">
#fname
</select>
</td>

<td>
<input type="button" value="->" onclick="addItem()">
<br>
<input type="button" value="<-" onclick="delItem()">
</td>

<td>
<select multiple name="archive">
#archive
</select>
</td>
</tr>
</table>

</form>
<br />

