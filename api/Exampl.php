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
    /* For VERSION <=2.0.6 $customviewinstance = ZCRMRestClient::getCustomViewInstance( "{module_apiname}","{customView_id}");
    $response = ZCRMRestClient::getCustomViewInstance("{module_api_name","{custom_view_id}" )->getRecords("{field_api_name}", "{sort_order}", (start_index),(end_index) ); // to get the records(parameter - ,field_api_name-to sortby,sort_order(asc or desc),starting index,ending index */
    $param_map=array("page"=>10,"per_page"=>10); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>"2019-11-15T15:26:49+05:30");//key-value pair  containing Headers to be passed    -optional

    //Calls
    $response = ZCRMRestClient::getCustomViewInstance("Activities","as" )->getRecords($param_map, $header_map );//to get the records($param_map - parameter map,$header_map - header map
    $records = $response->getData();
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
    $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance("Calls"); // To get module instance
    /* For VERSION <=2.0.6 $response = $moduleIns->getRecords(null, null, null, 1, 100, null); // to get the records(parameter - custom_view_id,field_api_name,sort_order,customHeaders is optional and can be given null if not required), customheader is a keyvalue pair for eg("if-modified-since"=>"2008-09-15T15:53:00")*/
    $param_map=array("page"=>10,"per_page"=>10); // key-value pair containing all the parameters - optional
    $header_map = array("if-modified-since"=>"2019-11-15T15:26:49+05:30"); // key-value pair containing all the headers - optional
    $response = $moduleIns->getRecords($param_map,$header_map); // to get the records($param_map - parameter map,$header_map - header map
    $records = $response->getData(); // To get response data

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
            echo $key . ":" ;print_r($value);


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
        if($layouts){

          echo $layouts->getId(); // To get layout_id
          echo $layouts->getName(); // To get layout name
        }

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
        /* End Event  */

      }
    } catch (ZCRMException $ex) {
      echo $ex->getMessage(); // To get ZCRMException error message
      echo $ex->getExceptionCode(); // To get ZCRMException error code
      echo $ex->getFile(); // To get the file name that throws the Exception
    }
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
}

$a = new Exampl();
$a->getRecord1s();