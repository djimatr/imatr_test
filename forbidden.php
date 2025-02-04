<?php 

    require_once('Autoloader.inc.php');
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'head.php'); 
    // require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['MAG_TEMPLATE_PATH'].'navbar_top.php'); 

	date_default_timezone_set("America/Toronto");
	$dat=date("Y-m-d H:i:s");
	$dats=strtotime($dat);
  


//dr

?>
<!-- Test Lock -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <body class="page-error">

    <div class="error-panel">
      <span style="font-size:10em; color: red" class="material-symbols-outlined">
error
</span>

      <div class="svg-wrapper mg-b-40">
        <object type="image/svg+xml" data="../assets/svg/fingerprint.svg"></object>
      </div>
      <h1 class="tx-28 tx-sm-36 tx-numeric tx-md-40 tx-semibold">403 Forbidden Access</h1>
      <h4 class="tx-16 tx-sm-18 tx-md-24 tx-light mg-b-20 mg-md-b-30">Sorry. You do not have access to this area.</h4>
      <!-- <p class="tx-12 tx-sm-13 tx-md-14 tx-color-04">Please try signing up and getting your PIN to get access.</p> -->

      <div class="wd-200">
        <a href="index.php" class="btn btn-block btn-white" >Go Back</a>
      </div><!-- search-form -->
    </div><!-- error-panel -->

   
<?php 
	
    require_once($_SERVER['DOCUMENT_ROOT'].$_SERVER['CASSIE_TEMPLATE_PATH'].'bottom.php'); 
   
?>