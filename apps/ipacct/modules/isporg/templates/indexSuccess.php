<div id='content_menu'> <a href="<?php echo url_for('isporg/new') ?>"> new </a> </div>

<h1> ISPorg list </h1>

<table class='data'>
  <thead>
    <tr class='col_header'>
      <td> id</td>
      <td> name </td>
      <td> Address</td>
      <td> City</td>
      <td> Phone</td>
      <td> Contact name</td>
      <td> Report email</td>
      <td> NAS email</td>
      <td> Billing info</td>
      <td> del</td>
</tr>
  </thead>
  <tbody>
    <?php foreach ($acc_isporgs as $acc_isporg): ?>
    <tr class='data_rows'>
      <td><a href="<?php echo url_for('isporg/show?id='.$acc_isporg->getId()) ?>"><?php echo $acc_isporg->getId() ?></a></td>
      <td><?php echo $acc_isporg->getName() ?></td>
      <td><?php echo $acc_isporg->getAddress() ?></td>
      <td><?php echo $acc_isporg->getCity() ?></td>
      <td><?php echo $acc_isporg->getPhone() ?></td>
      <td><?php echo $acc_isporg->getContactname() ?></td>
      <td><?php echo $acc_isporg->getEmailReport() ?></td>
      <td><?php echo $acc_isporg->getEmailNasadmin() ?></td>
      <td><?php echo $acc_isporg->getBillinginfo() ?></td>
      <td><a href="<?php echo url_for('isporg/delete?id='.$acc_isporg->getId()) ?>"><img src='../images/icon-del.png'></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>


