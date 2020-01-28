<?php


namespace zohoApi;


class Log
{
  protected static function getPathToLogs()
  {
    $dir = __DIR__ . '/../logs/';
    if(!is_dir($dir))
    {
      mkdir($dir,0777);
    }
    return $dir . 'zoho-api.txt';
  }

  public static function put($message)
  {
    file_put_contents(self::getPathToLogs(), date("Y-m-d H-i-s: ") . $message."\n\n", FILE_APPEND|LOCK_EX);
  }
}