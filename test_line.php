<?php
// LINEからきたPOST値（JSON）を取得
$json_string = file_get_contents('php://input');
$json_obj = json_decode($json_string);

// タイプとユーザID
$type = $json_obj->events[0]->type . "\n";
$user_id = $json_obj->events[0]->source->userId . "\n";

// ファイル出力
file_put_contents(
    'info.php',
    $type . $user_id
);

file_put_contents(
    'log.php',
    print_r($json_obj, true)
);
