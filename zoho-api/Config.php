<?php
namespace zohoApi;

use zcrmsdk\crm\setup\restclient\ZCRMRestClient;

class Config
{
  public const token_persistence_path = "token_storage";
  public $token_file_name = '';

  protected function getTokenPath()
  {
    $dir = __DIR__ . '/../' . self::token_persistence_path . '/';
    if(!is_dir($dir))
    {
      Log::put(sprintf("Mkdir %s", $dir));
      mkdir($dir,0777);
    }
    return $dir;
  }

  protected function getPathToToken($name)
  {
    return $this->getTokenPath() . $name . $this->token_file_name;
  }

  public function __construct($configuration = [])
  {
    $configuration = array_merge([
      "client_id" => "1000.YZO05BI18M18TAUKJGUA38BKMVNYKH",
      "client_secret" => "e17bc239cf031167f2a20cfc707a518383c04a5cb0",
      #"redirect_uri"=>self::redirect_uri,
      #"currentUserEmail"=>self::userEmail,
      "sandbox" => true, ///<<<<<<<<<< TODO false
      #'apiBaseUrl'=>'www.zohoapis.eu',
      "token_persistence_path" => $this->getTokenPath()
    ], $configuration);

    ZCRMRestClient::initialize($configuration);
  }
}