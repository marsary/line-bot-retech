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

// LINEからのコールバックデータ取得
$json_string = file_get_contents('php://input');
$json_obj = json_decode($json_string);

// webhookイベントタイプ
$type = $json_obj->events[0]->type;
// ユーザID
$user_id = $json_obj->events[0]->source->userId . "\n";

if ($type == 'follow') {
        // ユーザIDをuser.lstに保存
        file_put_contents("user.lst",$user_id,FILE_APPEND);
} else if ($type == 'unfollow') {
        $buf = "";
        $users = file('user.lst');

        foreach($users as $user) {
                if ($user != $user_id) {
                        $buf .= $user;
                }
        }
        // user.lst.wkに保存
        file_put_contents('user.lst.wk',$buf);
        // user.lst.wk を user.lst にリネーム
        exec('mv -f user.lst.wk user.lst');
} else {
        // noop        
}