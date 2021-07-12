<?php
DEFINE("ACCESS_TOKEN","HbWibKQrXJRNJB/vOKoIWAi1BbO1m3jzePRLMe6AsdAWd3/j74AokrvsU3pwZoMK9tCsAjbvMK/fusZxk0+VWe/2HWWDqjs5fvb0kESQOsAENTYri4tNSiQ/d6JjGJ/YNfjk9I/pXlsR8bJb2Qt+GwdB04t89/1O/w1cDnyilFU=");
DEFINE("SECRET_TOKEN","8632b8576a98e1d902db42ebb140d655");

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use \LINE\LINEBot\Constant\HTTPHeader;

//LINESDKの読み込み
require_once(__DIR__."/vendor/autoload.php");

//LINEから送られてきたらtrueになる
if(isset($_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE])){

//LINEBOTにPOSTで送られてきた生データの取得
  $inputData = file_get_contents("php://input");

//LINEBOTSDKの設定
  $httpClient = new CurlHTTPClient(ACCESS_TOKEN);
  $Bot = new LINEBot($HttpClient, ['channelSecret' => SECRET_TOKEN]);
  $signature = $_SERVER["HTTP_".HTTPHeader::LINE_SIGNATURE]; 
  $Events = $Bot->parseEventRequest($InputData, $Signature);

//大量にメッセージが送られると複数分のデータが同時に送られてくるため、foreachをしている。
foreach($Events as $event){
    $SendMessage = new MultiMessageBuilder();
    $TextMessageBuilder = new TextMessageBuilder("よろぽん！");
    $SendMessage->add($TextMessageBuilder);
    $Bot->replyMessage($event->getReplyToken(), $SendMessage);
  }
}