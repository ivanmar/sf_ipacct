<h1>Acc isporgs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Address</th>
      <th>City</th>
      <th>Zipcode</th>
      <th>Phone</th>
      <th>Billinginfo</th>
      <th>Contactname</th>
      <th>Email report</th>
      <th>Email nasadmin</th>
      <th>Pst commission</th>
      <th>Radlocation</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($acc_isporgs as $acc_isporg): ?>
    <tr>
      <td><a href="<?php echo url_for('isporg/show?id='.$acc_isporg->getId()) ?>"><?php echo $acc_isporg->getId() ?></a></td>
      <td><?php echo $acc_isporg->getName() ?></td>
      <td><?php echo $acc_isporg->getAddress() ?></td>
      <td><?php echo $acc_isporg->getCity() ?></td>
      <td><?php echo $acc_isporg->getZipcode() ?></td>
      <td><?php echo $acc_isporg->getPhone() ?></td>
      <td><?php echo $acc_isporg->getBillinginfo() ?></td>
      <td><?php echo $acc_isporg->getContactname() ?></td>
      <td><?php echo $acc_isporg->getEmailReport() ?></td>
      <td><?php echo $acc_isporg->getEmailNasadmin() ?></td>
      <td><?php echo $acc_isporg->getPstCommission() ?></td>
      <td><?php echo $acc_isporg->getRadlocation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('isporg/new') ?>">New</a>
