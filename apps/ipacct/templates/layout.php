<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>

<body onLoad="putFocus(0,1); //blank">
<div id="header">
  <div id="sys_stats"> date: #date, uptime 2 days, 10:52, 0 users</div>
  <div id="ipacct_ver"> PRIMUS IPACCT #version </div>
</div>


  <ul id="maintab" class="navtab">
     <li rel="system"><a href='#'> system </a> </li>
     <li rel="accounts"><a href='#'> accounts </a> </li>
     <li rel="definitions"><a href='#'> definitions </a> </li>
     <li rel="reports"><a href='#'> reports </a> </li>
     <li rel="operator"><a href='#'> operator </a> </li>
     <li rel="admin"><a href='#'> admin </a> </li>
  </ul>

<div id='submenu'>
  <div id="system" class="submenustyle">
	<a href="sysStatus.php">system status</a>
  </div>
  <div id="accounts" class="submenustyle">
	<a href="addAccPrep.php">add prepaid</a>
        <a href="addAccPostp.php">add postpaid</a>
        <a href="addSubscriber.php">add subscriber</a>
        <a href="manageSeries.php">view / manage</a>
  </div>
  <div id="definitions" class="submenustyle">
	<a href="addDef.php">add definition</a>
        <a href="manageDef.php">view / manage</a>
  </div>
  <div id="reports" class="submenustyle">
	<a href="onlineUsers.php">online users</a>
        <a href="connLogs.php">connection logs</a>
        <a href="billingData.php">billing data</a>
        <a href="graphData.php">graph data</a>
  </div>
  <div id="operator" class="submenustyle">
	<a href="operatorUser.php">users</a>
        <a href="operatorCard.php">cards</a>
        <a href="operatorBill.php">bills</a>
  </div>
  <div id="admin" class="submenustyle">
	<a href="addISP.php">isp admin</a>
        <a href="addNAS.php">nas admin</a>
        <a href="addISPSubOrg.php">sub orgs</a>
        <a href="addSysUser.php">user admin</a>
        <a href="createUpgrade.php">create upgrade</a>
        <a href="ipacctAdmin.php">ipacct admin</a>
        <a href="designCard.php">card design</a>
        <a href="login.php?action=logout">logout</a>
  </div>
</div>


      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif ?>
 
        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>



  <!--End contenwrap-->
  <div id="content-wrap-bottom"> &copy; 2009 <strong>primus net</strong> </div>
  <div class="clearfix"></div>
</div>
<!--End Wrap -->
<div class="clearfix"></div>
</body>
</html>
