<?php
include("zoho/zoho_execute.php");
//Now calling above class object
$exeZ =new ZOHO_Exec();
//Now going to add record in contact module
var_dump( $exeZ->zoho->newRecord($exeZ->zoho_data()));