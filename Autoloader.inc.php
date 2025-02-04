<?php 
   
require_once 'auth_check.php';


  function get_including_file() {
   $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
   
   // The file that included this file will be at index 1
   if (isset($backtrace[1]['file'])) {
       return basename($backtrace[1]['file']);
   }
   
   return null; // Return null if we couldn't determine the including file
}



$allowedSites = ['index.php', 'suggested_iQ_notification.php', 'share.php', 'index_dashboard.php', 'LOG.php','TOG.php','HTCP.php','Definitions.php','HOV.php','IQmasterxsinf.php', 'login.php', 'register.php', 'reset_password.php', 'reset_sendmail.php', 'create-manager-session.php', 'checkout.php', 'stripe-web-hook.php'];



   if(!in_array(get_including_file(), $allowedSites)){
   define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
   if(!AJAX_REQUEST) {
      header("HTTP/1.1 403 Forbidden" );
      die('Forbidden');}
   }



   spl_autoload_register(function($classname)
   {
    //include __DIR__  . $classname . '.class.php';
    include_once str_replace("\\", "/", $classname) . '.class.php';


   });
