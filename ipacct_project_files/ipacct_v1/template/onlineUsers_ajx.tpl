<table class='data'>
<tr><th class='table_header' colspan=10> Online Users </th> </tr>

<tr class='col_header'>
 <td> Ser id</td>
 <td> Def</td>
 <td> User</td>
 <td> Type</td>
 <td> Start Time</td>
 <td> Session</td>
 <td> Traffic</td>
 <td> ISP</td>
 <td> NAS</td>
 <td> term</td>
</tr>

<repeat id="1">
 <tr class='data_rows'>
  <td> <a href='manageA:acctype:.php&#63;action=show&serid=:serid:'> <b>:serid:</b></a></td>
  <td> :definitionname:</td>
  <td> :username:</td>
  <td> :acctype:</td>
  <td> :acctstarttime:</td>
  <td> :acctsessiontime:</td>
  <td> :traffic:</td>
  <td> :orgname:</td>
  <td> :nasipaddress:</td>
  <td> <a href='onlineUsers.php&#63;action=del&id=:radacctid:'><img src='images/icon-del.png'></a></td>
 </tr>
</repeat>

</table>
