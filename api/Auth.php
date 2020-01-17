<?php
namespace api\auth;

require_once __DIR__ . '/../vendor/autoload.php';

use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\ZohoOAuth;

class Auth
{
  public const currentUserEmail = "support@wellnessliving.com";

  public function __construct()
  {
    $configuration= [
      "client_id"=>"1000.YZO05BI18M18TAUKJGUA38BKMVNYKH",
      "client_secret"=>"e17bc239cf031167f2a20cfc707a518383c04a5cb0",
      "redirect_uri"=>"https://www.wellnessliving.com",
      "currentUserEmail"=>self::currentUserEmail,
      "token_persistence_path"=>__DIR__."/../token_storage"
    ];
    ZCRMRestClient::initialize($configuration);
  }

  public static function generateAccessTokenFromGrantToken()
  {
    $oAuthClient = ZohoOAuth::getClientInstance();
    $grantToken = "1000.3c24f810690b4d21079c9139333693f7.4cd9659e25356f6c2982ac764a4d821d";
    $oAuthTokens = $oAuthClient->generateAccessToken($grantToken);
  }

  public static function generateAccessTokenFromRefreshToken()
  {
    $oAuthClient = ZohoOAuth::getClientInstance();
    $refreshToken = "paste_the_refresh_token_here";
    $userIdentifier = self::currentUserEmail;
    $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken,$userIdentifier);
    echo $oAuthTokens;
  }

  public function getAuthToken()
  {

    #https://www.zoho.com/crm/developer/docs/api/access-refresh.html
    #https://www.zoho.com/crm/developer/docs/api/external-oauth.html



    $username = "support@wellnessliving.com";
    $password = "\\;'>?}9?=s=93Na";
    $param = "SCOPE=ZohoCRM/crmapi&EMAIL_ID=".$username."&PASSWORD=".$password;
    $ch = curl_init("https://accounts.zoho.com/apiauthtoken/nb/create");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    $result = curl_exec($ch);
    /*This part of the code below will separate the Authtoken from the result.
    Remove this part if you just need only the result*/
    print_r($result);
    $anArray = explode("\n",$result);
    $authToken = explode("=",$anArray['2']);
    $cmp = strcmp($authToken['0'],"AUTHTOKEN");
    echo $anArray['2']."";
    curl_close($ch);
    if ($cmp == 0)
    {
      echo "Created Authtoken is : ".$authToken['1'];
      file_put_contents(__DIR__."/../token_storage/token.txt", $authToken['1']);
      return $authToken['1'];
    }
    return null;
  }

  public function doo()
  {
    #$this->getAuthToken();exit;
    echo __METHOD__."\n";
    $rest=ZCRMRestClient::getInstance();//to get the rest client
    self::generateAccessTokenFromGrantToken();

    $orgIns=$rest->getOrganizationDetails()->getData();//to get the organization in form of ZCRMOrganization instance
    echo $orgIns->getCompanyName();//to get the company name of the organization
    echo $orgIns->getOrgId();//to get the organization id of the organization
    echo $orgIns->getCountryCode();//to get the country code of the organization
    echo $orgIns->getCountry();//to get the the country of the organization
    echo $orgIns->getCurrencyLocale();//to get the country locale of the organization
    echo $orgIns->getFax();//to get the fax number of the organization
    echo $orgIns->getAlias();//to get the alias  of the organization
    echo $orgIns->getDescription();//to get the description of the organization
    echo $orgIns->getStreet();//to get the street name of the organization
    echo $orgIns->getCity();//to get the city name  of the organization
    echo $orgIns->getState();//to get the state  of the organization
    echo $orgIns->getZgid();//to get the zoho group id of the organization
    echo $orgIns->getWebSite();//to get the website  of the organization
    echo $orgIns->getPrimaryEmail();//to get the primary email of the organization
    echo $orgIns->getPrimaryZuid();//to get the primary zoho user id of the organization
    echo $orgIns->getIsoCode();//to get the iso code of the organization
    echo $orgIns->getPhone();//to get the phone number of the organization
    echo $orgIns->getMobile();//to get the mobile number of the organization
    echo $orgIns->getEmployeeCount();//to get the employee count of the organization
    echo $orgIns->getCurrencySymbol();//to get the currency symbol of the organization
    echo $orgIns->getTimeZone();//to get the time zone of the organization
    echo $orgIns->getMcStatus();//to get the multicurrency status of the organization
    echo $orgIns->isGappsEnabled();//to check whether the google apps is enabled
    echo $orgIns->isPaidAccount();//to check whether the account is paid account
    echo $orgIns->getPaidExpiry();//to get the paid expiration
    echo $orgIns->getPaidType();//to get the paid type
    echo $orgIns->getTrialType();//to get the trial type
    echo $orgIns->getTrialExpiry();//to get the trial expiration
    echo $orgIns->getZipCode();//to get the zip code of the organization
  }
}

$a = new Auth();
$a->doo();