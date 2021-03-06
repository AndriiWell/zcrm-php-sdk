<?php
namespace api\auth;

require_once __DIR__ . '/../vendor/autoload.php';

use zcrmsdk\crm\crud\ZCRMModule;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

class Exampl
{
  public const currentUserEmail = "support@wellnessliving.com";

  public function __construct()
  {
    $configuration= [
      "client_id"=>"1000.YZO05BI18M18TAUKJGUA38BKMVNYKH",
      "client_secret"=>"e17bc239cf031167f2a20cfc707a518383c04a5cb0",
      "redirect_uri"=>"https://www.wellnessliving.com",
      "currentUserEmail"=>self::currentUserEmail,
      "sandbox"=>true,
      #'apiBaseUrl'=>'www.zohoapis.eu',
      "token_persistence_path"=>__DIR__."/../token_storage"
    ];
    ZCRMRestClient::initialize($configuration);
  }

  public static function generateAccessTokenFromGrantToken(){

    $oAuthClient = ZohoOAuth::getClientInstance();
    $grantToken = "1000.a4905fb06ce7316935aad03864037832.bd42dc9cd1fcade4b80efe0c52c9e1f4";
    $oAuthTokens = $oAuthClient->generateAccessToken($grantToken);
  }
  public static function generateAccessTokenFromRefreshToken(){

    $oAuthClient = ZohoOAuth::getClientInstance();
    $refreshToken = "1000.7ca9f4c743d8ef064de9249f31fb385f.8ac24b1d82cc4f014c00474823a38299";
    $userIdentifier = self::currentUserEmail;
    $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$userIdentifier);
  }

  public function doo()
  {
    $oAuthClient = ZohoOAuth::getClientInstance();
    $grantToken = "1000.b53f4818a9f3dcc5aa387c3e0fec5916.1db32dae4ee81117c91a733dbe0fb3f8";
    $oAuthTokens = $oAuthClient->generateAccessToken($grantToken);
    var_dump($oAuthTokens);

  }

  public function asd()
  {
    $this->doo();
    $rest=ZCRMRestClient::getInstance();//to get the rest client
    $modules=$rest->getAllModules()->getData();//to get the the modules in form of ZCRMModule instances array
    foreach ($modules as $module){
      echo $module->getModuleName();//to get the name of the module
      echo $module->getSingularLabel();//to get the singular label of the module
      echo $module->getPluralLabel();//to get the plural label of the module
      echo $module->getBusinessCardFieldLimit();//to get the business card field limit of the module
      echo $module->getAPIName();//to get the api name of the module
      echo $module->isCreatable();//to check wther the module is creatable
      echo $module->isConvertable();//to check wther the module is Convertable
      echo $module->isEditable();//to check wther the module is editable
      echo $module->isDeletable();//to check wther the module is deletable
      echo $module->getWebLink();//to get the weblink
      $user= $module->getModifiedBy();//to get the user who modified the module in form of ZCRMUser instance
      if($user!=null){
        $user->getId();//to get the user id
        $user->getName();//to get the user name
      }
      echo $module->getModifiedTime();//to get the modified time of the module in iso 8601 format
      echo $module->isViewable();//to check whether the module is viewable
      echo $module->isApiSupported();//to check whether the module is api supported
      echo $module->isCustomModule();//to check whether it is a custom module
      echo $module->isScoringSupported();//to check whether the scoring is supported
      echo $module->getId();//to get the module id
      $BusinessCardFields= $module->getBusinessCardFields();//to get the business card fields of the module
      foreach($BusinessCardFields as $BusinessCardField){
        echo $BusinessCardField;
      }
      $profiles= $module->getAllProfiles();//to get the profiles of the module in form of ZCRMProfile array instances
      foreach($profiles as $profile){
        echo  $profile->getId();//to get the profile id
        echo  $profile->getName();//to get the profile name
      }
      echo $module->isGlobalSearchSupported();//to check whether the module is global search supported
      echo $module->getSequenceNumber();//to get the sequence number of the module
    }
  }
  public function getAllModules(){
    $rest=ZCRMRestClient::getInstance();//to get the rest client
    $modules=$rest->getAllModules()->getData();//to get the the modules in form of ZCRMModule instances array
    foreach ($modules as $module){
      echo 'getModuleName='.$module->getModuleName()."\n";;//to get the name of the module
      echo 'getSingularLabel='.$module->getSingularLabel()."\n";;//to get the singular label of the module
      echo 'getPluralLabel='.$module->getPluralLabel()."\n";;//to get the plural label of the module
      echo 'getBusinessCardFieldLimit='.$module->getBusinessCardFieldLimit()."\n";;//to get the business card field limit of the module
      echo 'getAPIName='.$module->getAPIName()."\n";;//to get the api name of the module
      echo 'isCreatable='.$module->isCreatable()."\n";;//to check wther the module is creatable
      echo 'isConvertable='.$module->isConvertable()."\n";;//to check wther the module is Convertable
      echo 'isEditable='.$module->isEditable()."\n";;//to check wther the module is editable
      echo 'isDeletable='.$module->isDeletable()."\n";;//to check wther the module is deletable
      echo 'getWebLink='.$module->getWebLink()."\n";;//to get the weblink
      $user= $module->getModifiedBy();//to get the user who modified the module in form of ZCRMUser instance
      if($user!=null){
        $mUid = $user->getId();//to get the user id
        $nuid = $user->getName();//to get the user name
        'getModifiedBy='.$mUid." ".$nuid."\n";
      }
      echo "getModifiedTime=".$module->getModifiedTime()."\n";;//to get the modified time of the module in iso 8601 format
      echo "isViewable=".$module->isViewable()."\n";;//to check whether the module is viewable
      echo "isApiSupported=".$module->isApiSupported()."\n";;//to check whether the module is api supported
      echo "isCustomModule=".$module->isCustomModule()."\n";;//to check whether it is a custom module
      echo "isScoringSupported=".$module->isScoringSupported()."\n";;//to check whether the scoring is supported
      echo "getId=".$module->getId()."\n";;//to get the module id
      $BusinessCardFields= $module->getBusinessCardFields();//to get the business card fields of the module
      foreach($BusinessCardFields as $BusinessCardField){
        echo $BusinessCardField;
      }
      $profiles= $module->getAllProfiles();//to get the profiles of the module in form of ZCRMProfile array instances
      echo 'getAllProfiles:'."\n";

      foreach($profiles as $profile){
        echo  " getId=".$profile->getId()."\n";//to get the profile id
        echo  " getName=".$profile->getName()."\n";//to get the profile name
      }
      echo 'isGlobalSearchSupported='.$module->isGlobalSearchSupported()."\n";;//to check whether the module is global search supported
      echo 'getSequenceNumber='.$module->getSequenceNumber()."\n";;//to get the sequence number of the module
      echo "\n\n";
    }
  }
  public function getrecords()
  {
    $record = ZCRMRestClient::getInstance()->getRecordInstance("{module_api_name}", "{record_id}"); // To get record instance
    /* For VERSION <=2.0.6 $relatedlistrecords = $record->getRelatedListRecords("Attachments")->getData(); // to get the related list records in form of ZCRMRecord instance*/

    $param_map=array("page"=>"1","per_page"=>"200"); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>"2019-10-10T15:26:49+05:30"); // key-value pair containing all the headers - optional
    $relatedlistrecords = $record->getRelatedListRecords("Attachments",$param_map,$header_map)->getData(); // to get the related list records in form of ZCRMRecord instance

    //Calls
    /*$response = ZCRMRestClient::getCustomViewInstance("Activities","as" )->getRecords($param_map, $header_map );//to get the records($param_map - parameter map,$header_map - header map
    $records = $response->getData();*/
    try {
      foreach ($records as $record) {
        echo "\n\n";
        echo $record->getEntityId(); // To get record id
        echo $record->getModuleApiName(); // To get module api name
        echo $record->getLookupLabel(); // To get lookup object name
        $createdBy = $record->getCreatedBy();
        echo $createdBy->getId(); // To get user_id who created the record
        echo $createdBy->getName(); // To get user name who created the record
        $modifiedBy = $record->getModifiedBy();
        echo $modifiedBy->getId(); // To get user_id who modified the record
        echo $modifiedBy->getName(); // To get user name who modified the record
        $owner = $record->getOwner();
        echo $owner->getId(); // To get record owner_id
        echo $owner->getName(); // To get record owner name
        echo $record->getCreatedTime(); // To get record created time
        echo $record->getModifiedTime(); // To get record modified time
        echo $record->getLastActivityTime(); // To get last activity time(latest modify/view time)
        echo $record->getFieldValue("FieldApiName"); // To get particular field value
        $map = $record->getData(); // To get record data as map
        foreach ($map as $key => $value) {
          if ($value instanceof ZCRMRecord) // If value is ZCRMRecord object
          {
            echo $value->getEntityId(); // to get the record id
            echo $value->getModuleApiName(); // to get the api name of the module
            echo $value->getLookupLabel(); // to get the lookup label of the record
          } else // If value is not ZCRMRecord object
          {
            echo $key . ":" . $value;
          }
        }
        /**
         * Fields which start with "$" are considered to be property fields *
         */
        echo $record->getProperty('$fieldName'); // To get a particular property value
        $properties = $record->getAllProperties(); // To get record properties as map
        foreach ($properties as $key => $value) {
          if (is_array($value)) // If value is an array
          {
            echo "KEY::" . $key . "=";
            foreach ($value as $key1 => $value1) {
              if (is_array($value1)) {
                foreach ($value1 as $key2 => $value2) {
                  echo $key2 . ":" . $value2;
                }
              } else {
                echo $key1 . ":" . $value1;
              }
            }
          } else {
            echo $key . ":" . $value;
          }
        }
        $layouts = $record->getLayout(); // To get record layout
        echo $layouts->getId(); // To get layout_id
        echo $layouts->getName(); // To get layout name
        $taxlists = $record->getTaxList(); // To get the tax list
        foreach ($taxlists as $taxlist) {
          echo $taxlist->getTaxName(); // To get tax name
          echo $taxlist->getPercentage(); // To get tax percentage
          echo $taxlist->getValue(); // To get tax value
        }
        $lineItems = $record->getLineItems(); // To get line_items as map
        foreach ($lineItems as $lineItem) {
          echo $lineItem->getId(); // To get line_item id
          echo $lineItem->getListPrice(); // To get line_item list price
          echo $lineItem->getQuantity(); // To get line_item quantity
          echo $lineItem->getDescription(); // To get line_item description
          echo $lineItem->getTotal(); // To get line_item total amount
          echo $lineItem->getDiscount(); // To get line_item discount
          echo $lineItem->getDiscountPercentage(); // To get line_item discount percentage
          echo $lineItem->getTotalAfterDiscount(); // To get line_item amount after discount
          echo $lineItem->getTaxAmount(); // To get line_item tax amount
          echo $lineItem->getNetTotal(); // To get line_item net total amount
          echo $lineItem->getDeleteFlag(); // To get line_item delete flag
          echo $lineItem->getProduct()->getEntityId(); // To get line_item product's entity id
          echo $lineItem->getProduct()->getLookupLabel(); // To get line_item product's lookup label
          $linTaxs = $lineItem->getLineTax(); // To get line_item's line_tax as array
          foreach ($linTaxs as $lineTax) {
            echo $lineTax->getTaxName(); // To get line_tax name
            echo $lineTax->getPercentage(); // To get line_tax percentage
            echo $lineTax->getValue(); // To get line_tax value
          }
        }
        $pricedetails = $record->getPriceDetails(); // To get the price_details array
        foreach ($pricedetails as $pricedetail) {
          echo "\n\n";
          echo $pricedetail->getId(); // To get the record's price_id
          echo $pricedetail->getToRange(); // To get the price_detail record's to_range
          echo $pricedetail->getFromRange(); // To get price_detail record's from_range
          echo $pricedetail->getDiscount(); // To get price_detail record's discount
          echo "\n\n";
        }
        $participants = $record->getParticipants(); // To get Event record's participants
        foreach ($participants as $participant) {
          echo $participant->getName(); // To get the record's participant name
          echo $participant->getEmail(); // To get the record's participant email
          echo $participant->getId(); // To get the record's participant id
          echo $participant->getType(); // To get the record's participant type
          echo $participant->isInvited(); // To check if the record's participant(s) are invited or not
          echo $participant->getStatus(); // To get the record's participants' status
        }
        /* End Event */
      }
    } catch (ZCRMException $ex) {
      echo $ex->getMessage(); // To get ZCRMException error message
      echo $ex->getExceptionCode(); // To get ZCRMException error code
      echo $ex->getFile(); // To get the file name that throws the Exception
    }
  }
  public function getAllActiveUsers(){
    $orgIns = ZCRMRestClient::getOrganizationInstance(); // to get the organization instance
    /* For VERSION <=2.0.6 $response=$orgIns->getAllActiveUsers();//to get all the active users*/
    $param_map=array("page"=>"20","per_page"=>"200"); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>"2019-11-10T15:26:49+05:30"); // key-value pair containing all the headers - optional
    $response=$orgIns->getAllActiveUsers();
    $userInstances=$response->getData()."\n";//to get the array of users in form of ZCRMUser instances
    foreach ($userInstances as $userInstance){
      echo $userInstance->getId()."\n";//to get the user id
      echo $userInstance->getCountry()."\n";//to get the country of the user
      $roleInstance=$userInstance->getRole();//to get the role of the user in form of ZCRMRole instance
      echo $roleInstance->getId()."\n";//to get the role id
      echo $roleInstance->getName()."\n";//to get the role name
      $customizeInstance=$userInstance->getCustomizeInfo()."\n";//to get the customization information of the user in for of the ZCRMUserCustomizeInfo form
      if($customizeInstance!=null)
      {
        echo $customizeInstance->getNotesDesc()."\n";//to get the note description
        echo $customizeInstance->getUnpinRecentItem()."\n";//to get the unpinned recent items
        echo $customizeInstance->isToShowRightPanel()."\n";//to check whether the right panel is shown
        echo $customizeInstance->isBcView()."\n";//to check whether the business card view is enabled
        echo $customizeInstance->isToShowHome()."\n";//to check whether the home is shown
        echo $customizeInstance->isToShowDetailView()."\n";//to check whether the detail view is shows
      }
      echo $userInstance->getCity()."\n";//to get the city of the user
      echo $userInstance->getSignature()."\n";//to get the signature of the user
      echo $userInstance->getNameFormat()."\n";// to get the name format of the user
      echo $userInstance->getLanguage()."\n";//to get the language of the user
      echo $userInstance->getLocale()."\n";//to get the locale of the user
      echo $userInstance->isPersonalAccount()."\n";//to check whther this is a personal account
      echo $userInstance->getDefaultTabGroup()."\n";//to get the default tab group
      echo $userInstance->getAlias()."\n";//to get the alias of the user
      echo $userInstance->getStreet()."\n";//to get the street name of the user
      $themeInstance=$userInstance->getTheme();//to get the theme of the user in form of the ZCRMUserTheme
      if($themeInstance!=null)
      {
        echo $themeInstance->getNormalTabFontColor()."\n";//to get the normal tab font color
        echo $themeInstance->getNormalTabBackground()."\n";//to get the normal tab background
        echo $themeInstance->getSelectedTabFontColor()."\n";//to get the selected tab font color
        echo $themeInstance->getSelectedTabBackground()."\n";//to get the selected tab background
      }
      echo $userInstance->getState()."\n";//to get the state of the user
      echo $userInstance->getCountryLocale()."\n";//to get the country locale of the user
      echo $userInstance->getFax()."\n";//to get the fax number of the user
      echo $userInstance->getFirstName()."\n";//to get the first name of the user
      echo $userInstance->getEmail()."\n";//to get the email id of the user
      echo $userInstance->getZip()."\n";//to get the zip code of the user
      echo $userInstance->getDecimalSeparator()."\n";//to get the decimal separator
      echo $userInstance->getWebsite()."\n";//to get the website of the user
      echo $userInstance->getTimeFormat()."\n";//to get the time format of the user
      $profile= $userInstance->getProfile();//to get the user's profile in form of ZCRMProfile
      echo $profile->getId()."\n";//to get the profile id
      echo $profile->getName()."\n";//to get the name of the profile
      echo $userInstance->getMobile()."\n";//to get the mobile number of the user
      echo $userInstance->getLastName()."\n";//to get the last name of the user
      echo $userInstance->getTimeZone()."\n";//to get the time zone of the user
      echo $userInstance->getZuid()."\n";//to get the zoho user id of the user
      echo $userInstance->isConfirm()."\n";//to check whether it is a confirmed user
      echo $userInstance->getFullName()."\n";//to get the full name of the user
      echo $userInstance->getPhone()."\n";//to get the phone number of the user
      echo $userInstance->getDob()."\n";//to get the date of birth of the user
      echo $userInstance->getDateFormat()."\n";//to get the date format
      echo $userInstance->getStatus()."\n";//to get the status of the user
      echo "_______________________\n"."\n";
    }
  }
  public function getAllDeactiveUsers(){
    $orgIns = ZCRMRestClient::getOrganizationInstance(); // to get the organization instance
    /* For VERSION <=2.0.6 $response=$orgIns->getAllDeactiveUsers()."\n";//to get all the deactivated users */
    $param_map=array("page"=>"20","per_page"=>"200"); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>"2019-11-10T15:26:49+05:30"); // key-value pair containing all the headers - optional
    $response=$orgIns->getAllDeactiveUsers();// to get all the deactivated users
    $userInstances=$response->getData();//to get the array of users in form of ZCRMUser instances
    foreach ($userInstances as $userInstance){
      echo $userInstance->getId()."\n";//to get the user id
      echo $userInstance->getCountry()."\n";//to get the country of the user
      $roleInstance=$userInstance->getRole();//to get the role of the user in form of ZCRMRole instance
      echo $roleInstance->getId()."\n";//to get the role id
      echo $roleInstance->getName()."\n";//to get the role name
      $customizeInstance=$userInstance->getCustomizeInfo();//to get the customization information of the user in for of the ZCRMUserCustomizeInfo form
      if($customizeInstance!=null)
      {
        echo $customizeInstance->getNotesDesc()."\n";//to get the note description
        echo $customizeInstance->getUnpinRecentItem()."\n";//to get the unpinned recent items
        echo $customizeInstance->isToShowRightPanel()."\n";//to check whether the right panel is shown
        echo $customizeInstance->isBcView()."\n";//to check whether the business card view is enabled
        echo $customizeInstance->isToShowHome()."\n";//to check whether the home is shown
        echo $customizeInstance->isToShowDetailView()."\n";//to check whether the detail view is shows
      }
      echo $userInstance->getCity()."\n";//to get the city of the user
      echo $userInstance->getSignature()."\n";//to get the signature of the user
      echo $userInstance->getNameFormat()."\n";// to get the name format of the user
      echo $userInstance->getLanguage()."\n";//to get the language of the user
      echo $userInstance->getLocale()."\n";//to get the locale of the user
      echo $userInstance->isPersonalAccount()."\n";//to check whther this is a personal account
      echo $userInstance->getDefaultTabGroup()."\n";//to get the default tab group
      echo $userInstance->getAlias()."\n";//to get the alias of the user
      echo $userInstance->getStreet()."\n";//to get the street name of the user
      $themeInstance=$userInstance->getTheme();//to get the theme of the user in form of the ZCRMUserTheme
      if($themeInstance!=null)
      {
        echo $themeInstance->getNormalTabFontColor()."\n";//to get the normal tab font color
        echo $themeInstance->getNormalTabBackground()."\n";//to get the normal tab background
        echo $themeInstance->getSelectedTabFontColor()."\n";//to get the selected tab font color
        echo $themeInstance->getSelectedTabBackground()."\n";//to get the selected tab background
      }
      echo $userInstance->getState()."\n";//to get the state of the user
      echo $userInstance->getCountryLocale()."\n";//to get the country locale of the user
      echo $userInstance->getFax()."\n";//to get the fax number of the user
      echo $userInstance->getFirstName()."\n";//to get the first name of the user
      echo $userInstance->getEmail()."\n";//to get the email id of the user
      echo $userInstance->getZip()."\n";//to get the zip code of the user
      echo $userInstance->getDecimalSeparator()."\n";//to get the decimal separator
      echo $userInstance->getWebsite()."\n";//to get the website of the user
      echo $userInstance->getTimeFormat()."\n";//to get the time format of the user
      $profile= $userInstance->getProfile();//to get the user's profile in form of ZCRMProfile
      echo $profile->getId()."\n";//to get the profile id
      echo $profile->getName()."\n";//to get the name of the profile
      echo $userInstance->getMobile()."\n";//to get the mobile number of the user
      echo $userInstance->getLastName()."\n";//to get the last name of the user
      echo $userInstance->getTimeZone()."\n";//to get the time zone of the user
      echo $userInstance->getZuid()."\n";//to get the zoho user id of the user
      echo $userInstance->isConfirm()."\n";//to check whether it is a confirmed user
      echo $userInstance->getFullName()."\n";//to get the full name of the user
      echo $userInstance->getPhone()."\n";//to get the phone number of the user
      echo $userInstance->getDob()."\n";//to get the date of birth of the user
      echo $userInstance->getDateFormat()."\n";//to get the date format
      echo $userInstance->getStatus()."\n";//to get the status of the user
      echo "_______________________\n"."\n";
    }
  }
  public function getRecord1s()
  {
    $activity_types = [];
    $page = 1;
    $per_page = 200;
    $result_arr = [];
    $time_since = "2019-09-15T15:26:49+05:30";
    $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("Activities"); // To get module instance
    /* For VERSION <=2.0.6 $response = $moduleIns->getRecords(null, null, null, 1, 100, null); // to get the records(parameter - custom_view_id,field_api_name,sort_order,customHeaders is optional and can be given null if not required), customheader is a keyvalue pair for eg("if-modified-since"=>"2008-09-15T15:53:00")*/
    $param_map=array("page"=>$page,"per_page"=>$per_page/*, 'sort_order'=>'desc', 'sort_by'=>'Start_DateTime'*/); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>$time_since); // key-value pair containing all the headers - optional
    $header_map = [];
    for($i=0;$i<100;$i++)
    {
      echo $i."\n";
      try
      {
        $response = $moduleIns->getRecords($param_map,$header_map); // to get the records($param_map - parameter map,$header_map - header map
      }
      catch(\Exception $e){
        continue;
      }

      #$param_map['page'] = $param_map['page']+$param_map['per_page'];
      $param_map['page'] = $param_map['page'] + 1;
      $records = $response->getData(); // To get response data
      echo $i . '$records= ' . count($records)."\n";
      print_r($param_map);echo "\n\n";
      try {
        foreach ($records as $record) {
          $a_result = [];
          $a_result['id'] = $record->getEntityId();
          /*echo "\n\n";
          echo "getEntityId= ".$record->getEntityId()."\n"; // To get record id
          echo "getModuleApiName= ".$record->getModuleApiName()."\n"; // To get module api name
          echo "getLookupLabel= ".$record->getLookupLabel()."\n"; // To get lookup object name*/
          $createdBy = $record->getCreatedBy();
          $a_result['created_by']['id'] = $createdBy->getId();
          $a_result['created_by']['name'] = $createdBy->getName();
          echo "createdBy getId= ".$createdBy->getId()."\n"; // To get user_id who created the record
          echo "createdBy getName= ".$createdBy->getName()."\n"; // To get user name who created the record
          $modifiedBy = $record->getModifiedBy();
          $a_result['modified_by']['id'] = $modifiedBy->getId();
          $a_result['modified_by']['name'] = $modifiedBy->getName();
          echo "modifiedBy getId= ".$modifiedBy->getId()."\n"; // To get user_id who modified the record
          echo "modifiedBy getName= ".$modifiedBy->getName()."\n"; // To get user name who modified the record*/
          $owner = $record->getOwner();
          $a_result['owner']['id'] = $owner->getId();
          $a_result['owner']['name'] = $owner->getName();
          /* echo "owner getId= ".$owner->getId()."\n"; // To get record owner_id
           echo "owner getName= ".$owner->getName()."\n"; // To get record owner name*/

          $a_result['created_time'] = $owner->getCreatedTime();
          /* echo "getCreatedTime= ".$record->getCreatedTime()."\n"; // To get record created time
           echo "getModifiedTime= ".$record->getModifiedTime()."\n"; // To get record modified time
           echo "getLastActivityTime= ".$record->getLastActivityTime()."\n"; // To get last activity time(latest modify/view time)
           echo "FieldApiName= ".$record->getFieldValue("FieldApiName")."\n"; // To get particular field value*/
          $map = $record->getData(); // To get record data as map
          foreach ($map as $key => $value) {
            if ($value instanceof ZCRMRecord) // If value is ZCRMRecord object
            {
              $module_id = $value->getModuleApiName();
              $a_result['ZCRMRecord'][$module_id]['entity_id'] = $value->getEntityId();
              $a_result['ZCRMRecord'][$module_id]['module_api_name'] = $value->getModuleApiName();
              $a_result['ZCRMRecord'][$module_id]['lookup_label'] = $value->getLookupLabel();
              #$a_result['ZCRMRecord'][$module_id]['all'] = $value->getAllProperties();
              #$a_result['ZCRMRecord'][$module_id]['all'] = $value->getCreatedBy();
              /* echo " getEntityId= ".$value->getEntityId()."\n"; // to get the record id
               echo " getModuleApiName= ".$value->getModuleApiName()."\n"; // to get the api name of the module
               echo " getLookupLabel= ".$value->getLookupLabel()."\n"; // to get the lookup label of the record*/
            } else // If value is not ZCRMRecord object
            {
              if($key == 'Activity_Type')
              {
                $a_result['activity_type'] = $value;
              }
              if($key == 'Priority')
              {
                $a_result['priority'] = $value;
              }
              if($key == 'Call_Start_Time')
              {
                $a_result['call_start_time'] = $value;
              }
              if($key == 'Call_Duration')
              {
                $a_result['call_duration'] = $value;
              }
              if($key == 'Subject')
              {
                $a_result['subject'] = $value;
              }
              if($key == 'Call_Type')
              {
                $a_result['call_type'] = $value;
              }
              if($key == 'Call_Status')
              {
                $a_result['call_status'] = $value;
              }
              if($key == 'Call_Duration_in_seconds')
              {
                $a_result['duration_in_seconds'] = $value;
              }
              #echo " key= ".$key . ":" . $value."\n";
            }
          }
          /**
           * Fields which start with "$" are considered to be property fields *
           */
          /*echo '$fieldName= '.$record->getProperty('$fieldName')."\n"; // To get a particular property value
          $properties = $record->getAllProperties(); // To get record properties as map
          foreach ($properties as $key => $value) {
            if (is_array($value)) // If value is an array
            {
              echo " KEY::" . $key . "=";
              foreach ($value as $key1 => $value1) {
                if (is_array($value1)) {
                  foreach ($value1 as $key2 => $value2) {
                    echo "  key2= ".$key2 . ":" . $value2."\n";
                  }
                } else {
                  echo "  key1= ".$key1 . ":" . $value1."\n";
                }
              }
            } else {
              echo " key= ".$key . ":" . $value."\n";
            }
          }
          $layouts = $record->getLayout(); // To get record layout
          if($layouts){

            echo"layouts getId= ". $layouts->getId()."\n"; // To get layout_id
            echo"layouts getName= ". $layouts->getName()."\n"; // To get layout name
          }

          $taxlists = $record->getTaxList(); // To get the tax list
          foreach ($taxlists as $taxlist) {
            echo "taxlists getTaxName= ".$taxlist->getTaxName()."\n"; // To get tax name
            echo "taxlists getPercentage= ".$taxlist->getPercentage()."\n"; // To get tax percentage
            echo "taxlists getValue= ". $taxlist->getValue()."\n"; // To get tax value
          }
          $lineItems = $record->getLineItems(); // To get line_items as map
          foreach ($lineItems as $lineItem) {
            echo "lineItems getId= ".$lineItem->getId()."\n"; // To get line_item id
            echo "lineItems getListPrice= ".$lineItem->getListPrice()."\n"; // To get line_item list price
            echo "lineItems getQuantity= ".$lineItem->getQuantity()."\n"; // To get line_item quantity
            echo "lineItems getDescription= ".$lineItem->getDescription()."\n"; // To get line_item description
            echo "lineItems getTotal= ".$lineItem->getTotal()."\n"; // To get line_item total amount
            echo "lineItems getDiscount= ".$lineItem->getDiscount()."\n"; // To get line_item discount
            echo "lineItems getDiscountPercentage= ".$lineItem->getDiscountPercentage()."\n"; // To get line_item discount percentage
            echo "lineItems getTotalAfterDiscount= ".$lineItem->getTotalAfterDiscount()."\n"; // To get line_item amount after discount
            echo "lineItems getTaxAmount= ".$lineItem->getTaxAmount()."\n"; // To get line_item tax amount
            echo "lineItems getNetTotal= ".$lineItem->getNetTotal()."\n"; // To get line_item net total amount
            echo "lineItems getDeleteFlag= ".$lineItem->getDeleteFlag()."\n"; // To get line_item delete flag
            echo "lineItems getProduct getEntityId= ".$lineItem->getProduct()->getEntityId()."\n"; // To get line_item product's entity id
            echo "lineItems getProduct getLookupLabel= ".$lineItem->getProduct()->getLookupLabel()."\n"; // To get line_item product's lookup label
            $linTaxs = $lineItem->getLineTax(); // To get line_item's line_tax as array
            foreach ($linTaxs as $lineTax) {
              echo "getLineTax getTaxName= ".$lineTax->getTaxName()."\n"; // To get line_tax name
              echo "getLineTax getPercentage= ".$lineTax->getPercentage()."\n"; // To get line_tax percentage
              echo "getLineTax getValue= ".$lineTax->getValue()."\n"; // To get line_tax value
            }
          }
          $pricedetails = $record->getPriceDetails(); // To get the price_details array
          foreach ($pricedetails as $pricedetail) {
            echo "\n\n";
            echo "pricedetails getId= ".$pricedetail->getId()."\n"; // To get the record's price_id
            echo "pricedetails getToRange= ".$pricedetail->getToRange()."\n"; // To get the price_detail record's to_range
            echo "pricedetails getFromRange= ".$pricedetail->getFromRange()."\n"; // To get price_detail record's from_range
            echo "pricedetails getDiscount= ".$pricedetail->getDiscount()."\n"; // To get price_detail record's discount
            echo "\n\n";
          }
          $participants = $record->getParticipants(); // To get Event record's participants
          foreach ($participants as $participant) {
            echo "participants getName= ".$participant->getName()."\n"; // To get the record's participant name
            echo "participants getEmail= ".$participant->getEmail()."\n"; // To get the record's participant email
            echo "participants getId= ".$participant->getId()."\n"; // To get the record's participant id
            echo "participants getType= ".$participant->getType()."\n"; // To get the record's participant type
            echo "participants isInvited= ".$participant->isInvited()."\n"; // To check if the record's participant(s) are invited or not
            echo "participants getStatus= ".$participant->getStatus()."\n"; // To get the record's participants' status
          }
          echo "\n\n";*/
          if(!isset($activity_types[$a_result['activity_type']]))
          {
            $activity_types[$a_result['activity_type']] = 0;
          }
          $activity_types[$a_result['activity_type']]++;
          if((!$a_result['duration_in_seconds'] || $a_result['duration_in_seconds'] == 0) &&
            $a_result['activity_type'] == 'Calls'/* && $a_result['call_type'] == 'Inbound'*/){

            $result_arr[] = $a_result;
            file_put_contents('a_result.txt', json_encode($a_result), FILE_APPEND|LOCK_EX);
          }
        }
      } catch (ZCRMException $ex) {
        echo $ex->getMessage(); // To get ZCRMException error message
        echo $ex->getExceptionCode(); // To get ZCRMException error code
        echo $ex->getFile(); // To get the file name that throws the Exception
      }
    }
    file_put_contents('result_arr.txt', json_encode($result_arr), FILE_APPEND|LOCK_EX);
    print_r($activity_types);
    echo count($result_arr);
  }
  public function getRecord()
  {
    $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("Calls"); // To get module instance
    $response = $moduleIns->getRecord("1602133000115995014"); // To get module records
    $record = $response->getData(); // To get response data
    try {

      echo "\n\n";
      echo $record->getEntityId(); // To get record id
      echo $record->getModuleApiName(); // To get module api name
      echo $record->getLookupLabel(); // To get lookup object name
      $createdBy = $record->getCreatedBy();
      echo $createdBy->getId(); // To get user_id who created the record
      echo $createdBy->getName(); // To get user name who created the record
      $modifiedBy = $record->getModifiedBy();
      echo $modifiedBy->getId(); // To get user_id who modified the record
      echo $modifiedBy->getName(); // To get user name who modified the record
      $owner = $record->getOwner();
      echo $owner->getId(); // To get record owner_id
      echo $owner->getName(); // To get record owner name
      echo $record->getCreatedTime(); // To get record created time
      echo $record->getModifiedTime(); // To get record modified time
      echo $record->getLastActivityTime(); // To get last activity time(latest modify/view time)
      echo $record->getFieldValue("FieldApiName"); // To get particular field value
      $map = $record->getData(); // To get record data as map
      foreach ($map as $key => $value) {
        if ($value instanceof ZCRMRecord) // If value is ZCRMRecord object
        {
          echo $value->getEntityId(); // to get the record id
          echo $value->getModuleApiName(); // to get the api name of the module
          echo $value->getLookupLabel(); // to get the lookup label of the record
        } else // If value is not ZCRMRecord object
        {
          echo $key . ":" . $value;
        }
      }
      /**
       * Fields which start with "$" are considered to be property fields *
       */
      echo $record->getProperty('$fieldName'); // To get a particular property value
      $properties = $record->getAllProperties(); // To get record properties as map
      foreach ($properties as $key => $value) {
        if (is_array($value)) // If value is an array
        {
          echo "KEY::" . $key . "=";
          foreach ($value as $key1 => $value1) {
            if (is_array($value1)) {
              foreach ($value1 as $key2 => $value2) {
                echo $key2 . ":" . $value2;
              }
            } else {
              echo $key1 . ":" . $value1;
            }
          }
        } else {
          echo $key . ":" . $value;
        }
      }
      $layouts = $record->getLayout(); // To get record layout
      echo $layouts->getId(); // To get layout_id
      echo $layouts->getName(); // To get layout name

      $taxlists = $record->getTaxList(); // To get the tax list
      foreach ($taxlists as $taxlist) {
        echo $taxlist->getTaxName(); // To get tax name
        echo $taxlist->getPercentage(); // To get tax percentage
        echo $taxlist->getValue(); // To get tax value
      }
      $lineItems = $record->getLineItems(); // To get line_items as map
      foreach ($lineItems as $lineItem) {
        echo $lineItem->getId(); // To get line_item id
        echo $lineItem->getListPrice(); // To get line_item list price
        echo $lineItem->getQuantity(); // To get line_item quantity
        echo $lineItem->getDescription(); // To get line_item description
        echo $lineItem->getTotal(); // To get line_item total amount
        echo $lineItem->getDiscount(); // To get line_item discount
        echo $lineItem->getDiscountPercentage(); // To get line_item discount percentage
        echo $lineItem->getTotalAfterDiscount(); // To get line_item amount after discount
        echo $lineItem->getTaxAmount(); // To get line_item tax amount
        echo $lineItem->getNetTotal(); // To get line_item net total amount
        echo $lineItem->getDeleteFlag(); // To get line_item delete flag
        echo $lineItem->getProduct()->getEntityId(); // To get line_item product's entity id
        echo $lineItem->getProduct()->getLookupLabel(); // To get line_item product's lookup label
        $linTaxs = $lineItem->getLineTax(); // To get line_item's line_tax as array
        foreach ($linTaxs as $lineTax) {
          echo $lineTax->getTaxName(); // To get line_tax name
          echo $lineTax->getPercentage(); // To get line_tax percentage
          echo $lineTax->getValue(); // To get line_tax value
        }
      }
      $pricedetails = $record->getPriceDetails(); // To get the price_details array
      foreach ($pricedetails as $pricedetail) {
        echo "\n\n";
        echo $pricedetail->getId(); // To get the record's price_id
        echo $pricedetail->getToRange(); // To get the price_detail record's to_range
        echo $pricedetail->getFromRange(); // To get price_detail record's from_range
        echo $pricedetail->getDiscount(); // To get price_detail record's discount
        echo "\n\n";
      }
      $participants = $record->getParticipants(); // To get Event record's participants
      foreach ($participants as $participant) {
        echo $participant->getName(); // To get the record's participant name
        echo $participant->getEmail(); // To get the record's participant email
        echo $participant->getId(); // To get the record's participant id
        echo $participant->getType(); // To get the record's participant type
        echo $participant->isInvited(); // To check if the record's participant(s) are invited or not
        echo $participant->getStatus(); // To get the record's participants' status
      }
      /* End Event */
    } catch (ZCRMException $ex) {
      echo $ex->getMessage(); // To get ZCRMException error message
      echo $ex->getExceptionCode(); // To get ZCRMException error code
      echo $ex->getFile(); // To get the file name that throws the Exception
    }
  }

  public function searchRecords(){


  }
}

$a = new Exampl();
$a->getRecord1s();
//https://www.zoho.com/crm/developer/docs/php-sdk/record-samples.html  Get Records in a Related List