<?php


namespace api\auth;


class zohov1
{

  public function doo()
  {
    $module = 'Calls';
    $response_path = __DIR__."/../response1/zohov1_".$module."_getRecords_";
    header("Content-type: application/xml");
    $token=$this->getToken();
    $url = "https://crm.zoho.com/crm/private/xml/".$module."/getRecords";
    $ch = curl_init();

    $elements = 200;
    $end = 0;
    $new_arr = [];
    for($i=0;$i<200;$i++)
    {
      $start = 1 + $end;
      $end = $end + $elements;
      $param= "authtoken=".$token."&scope=crmapi&lastModifiedTime=2019-06-01 11:09:23&fromIndex=".($start)."&toIndex=".($end)."&sortColumnString=Created Time&sortOrderString=asc";
      echo $param . "\n";

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
      $result = curl_exec($ch);
      $xml = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
      $xml1 = simplexml_load_string($result, 'SimpleXMLElement');
      $json = json_encode($xml);
      $json1 = json_encode($xml1);
      $array = json_decode($json,TRUE);
      $array1 = json_decode($json1,TRUE);
      if(isset($array1['result']['Calls']['row']))
      foreach ($array1['result']['Calls']['row'] as $k=>$call) {
        foreach ($call['FL'] as $kay=>$item) {
          if(!isset($item['@attributes'])){

          }
          elseif(!isset($item['@attributes']['val'])){

          }
          elseif($item['@attributes']['val'] === 'Call Owner'){
            if(!isset($new_arr[$array['result']['Calls']['row'][$k]['FL'][$kay]])){
              $new_arr[$array['result']['Calls']['row'][$k]['FL'][$kay]] = 0;
            }
            $new_arr[$array['result']['Calls']['row'][$k]['FL'][$kay]]++;
          }
          else{
            /*echo "!!!!";
            echo "\n";
            echo "\n";*/
          }
        }
      }
      #file_put_contents($response_path .$i."_.txt", $json, FILE_APPEND);
    }
    print_r($new_arr);
    curl_close($ch);
    return $result;

  }

  public function getToken()
  {
    $token_path = __DIR__."/../token_storage/zohov1.txt";
    if(file_exists($token_path))
    {
      $token = file_get_contents($token_path);
      if($token)
      {
        return $token;
      }
    }
    else
    {
      file_put_contents($token_path, '');
    }
    $username = "support@wellnessliving.com";
    $password = "\;'>?}9?=s=93Na";
    $param = "SCOPE=ZohoCRM/crmapi&EMAIL_ID=" . $username . "&PASSWORD=" . $password;
    $ch = curl_init("https://accounts.zoho.com/apiauthtoken/nb/create");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    $result = curl_exec($ch);
    echo $result."\n\n";
    file_put_contents(__DIR__."/../log/zohov1.txt", $result." ___________".date("Y-m-d H:i:s"), FILE_APPEND);
    /*This part of the code below will separate the Authtoken from the result.
    Remove this part if you just need only the result*/
    $anArray = explode("\n", $result);
    $authToken = explode("=", $anArray['2']);
    $cmp = strcmp($authToken['0'], "AUTHTOKEN");
    echo $anArray['2'] . "";
    if ($cmp == 0) {
      echo "Created Authtoken is : " . $authToken['1'];
      file_put_contents($token_path, $authToken['1']);
      return $authToken['1'];
    }
    curl_close($ch);
  }

  public function doo1()
  {


    $module = 'phonebridge';
    $response_path = __DIR__."/../response1/zohov1_".$module."_getRecords_";
    header("Content-type: application/xml");
    $token=$this->getToken();
    $url = "https://crm.zoho.com/crm/private/xml/".$module."/getRecords";
    $url = "https://www.zohoapis.com/crm/v2/phonebridge/users";
    $ch = curl_init();

    $elements = 200;
    $end = 0;
    for($i=0;$i<1;$i++)
    {
      $start = 1 + $end;
      $end = $end + $elements;
      $param= "authtoken=".$token."&scope=crmapi&lastModifiedTime=2019-06-01 11:09:23&fromIndex=".($start)."&toIndex=".($end)."&sortColumnString=Created Time&sortOrderString=asc";
      echo $param . "\n";

      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
      $result = curl_exec($ch);
      $xml = simplexml_load_string($result);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      file_put_contents($response_path .$i."_.txt", $json, FILE_APPEND);
    }
    curl_close($ch);
    return $result;

  }
}
(new zohov1())->doo();