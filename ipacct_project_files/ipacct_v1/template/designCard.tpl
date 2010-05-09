<form method="post" name="form1" id="form1" action="#formaction">
<input type="hidden" name="loop" value="1">


<div id='form-holder-left'>

<table class='formhold'>
<tr>
 <td id='tdlabel'>ISP :</td>
 <td id='tdinput'> <select name="isporg" onchange="reload(2)"> #isporg </select> </td>
</tr>
</table>

<br><br>

</div>



<table class='data'>
  <tr>
    <td> <h1 class='data_header'> Inside Card Design </h1> </td>
    <td> <h1 class='data_header'> Outside Card Design </h1></td>
  </tr>
  <tr>
    <td align="center">
    <textarea name="front" cols=47 rows=20><!--
       #front
       -->
     </textarea>
    </td>
    <td align="center">
    <textarea name="back" cols=47 rows=20><!--
      #back
      -->
      </textarea>
    </td>
  </tr>
</table>

<br><br>

<p id='psubmit'><input class="button" type="submit"></p>

</form>

