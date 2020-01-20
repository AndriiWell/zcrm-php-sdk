<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
require 'vendor/autoload.php';
//ZOHO V2 custom class for manage function

require 'zoho/zoho_execute.php';
file_put_contents('mlog.txt', 1, FILE_APPEND);
if(!empty($_REQUEST['code'])){

  $zoho=new ZOHO_Exec();

  $zoho->zoho->generateToken($_REQUEST['code']);
  //You can get code using Application as well without creating link and authorise.
}
?>