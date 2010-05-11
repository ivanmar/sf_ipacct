<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $acc_isporg->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $acc_isporg->getName() ?></td>
    </tr>
    <tr>
      <th>Address:</th>
      <td><?php echo $acc_isporg->getAddress() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $acc_isporg->getCity() ?></td>
    </tr>
    <tr>
      <th>Zipcode:</th>
      <td><?php echo $acc_isporg->getZipcode() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $acc_isporg->getPhone() ?></td>
    </tr>
    <tr>
      <th>Billinginfo:</th>
      <td><?php echo $acc_isporg->getBillinginfo() ?></td>
    </tr>
    <tr>
      <th>Contactname:</th>
      <td><?php echo $acc_isporg->getContactname() ?></td>
    </tr>
    <tr>
      <th>Email report:</th>
      <td><?php echo $acc_isporg->getEmailReport() ?></td>
    </tr>
    <tr>
      <th>Email nasadmin:</th>
      <td><?php echo $acc_isporg->getEmailNasadmin() ?></td>
    </tr>
    <tr>
      <th>Pst commission:</th>
      <td><?php echo $acc_isporg->getPstCommission() ?></td>
    </tr>
    <tr>
      <th>Radlocation:</th>
      <td><?php echo $acc_isporg->getRadlocation() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('isporg/edit?id='.$acc_isporg->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('isporg/index') ?>">List</a>
