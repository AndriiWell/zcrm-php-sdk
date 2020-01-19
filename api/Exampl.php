<?php
namespace api\auth;

require_once __DIR__ . '/../vendor/autoload.php';

use zcrmsdk\crm\crud\ZCRMModule;
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
}

$a = new Exampl();
$a->asd();