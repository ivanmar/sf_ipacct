<div id="header">

</div>

<div id="nav">
        <div id="nbar">
          <ul  id="maintab">
            <li class="selected"><a href="#" rel="eng"> ENGLISH </a></li>
            <li><a href="#" rel="hrv"> HRVATSKI </a></li>
          </ul>
        </div>

<div id="contentwrap">

  <div class="tabcontentstyle">

   <div id="eng" class="tabcontent">
    You have successfully accessed Primus IPACCT system. To start using Internet service turn off our pop-up blocker and enter login information from your pre-paid card.
   <br><br> 
   For additional informations please contact sales personel.

   </div>

   <div id="hrv" class="tabcontent">
    Pristupili ste PRIMUS IPACCT  Internet sustavu. Kako bi zapoèeli s kori¹tenjem  Internet usluge ugasite pop-up blocker i unestite podatke koje ste dobili na pre-paid kartici.
   <br><br> 
   Za dodtatne informacije kontaktirajte djelatnike prodaje.

   </div>

  <script type="text/javascript"> initializetabcontent("maintab") </script>

  </div>


</div>


 <div id="ctop"></div>
  <div id="wrap">
      <div id="content">



<h1 class="data_header"> USER LOGIN </h1>

<p>&nbsp;</p>


<form name="f" method="get" autocomplete="off" action="<?=LOGINPATH?>">

<input name="form_request" value="login" type="hidden">
<input name="auth_source" value="default-network" type="hidden"> 
<input type="hidden" name="chal" value="<?=$_GET['challenge']?>">
<input type="hidden" name="uamip" value="<?=$_GET['uamip']?>">
<input type="hidden" name="uamport" value="<?=$_GET['uamport']?>">
<input type="hidden" name="userurl" value="<?=urldecode($_GET['userurl'])?>">

            <label>username</label>
	    <input name="uid" id="form_username" tabindex="1" value="" size="40" type="text">

<br><br>

            <label>password</label>
	    <input name="pwd" id="form_password" tabindex="2" size="40" value="" type="password">

<br><br>

	    <input class="button" type="submit" name="login" value="<?=_t('login')?>" 
		onclick="popUpWindow('<?=LOGINPATH?>?res=popup1&uamip=<?=UAMIP?>&uamport=<?=UAMPORT?>','GLS','220','200',0,0,0,0)">
<br><br>

</form>

<p>&nbsp;</p>





      </div>
  </div>
  <!--End contenwrap-->
  <div id="content-wrap-bottom"> &copy; 2009 <strong>primus net</strong>  </div>
  <div class="clearfix"></div>
</div>
