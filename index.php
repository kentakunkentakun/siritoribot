<?php

require_once("./sukure.php");
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

//CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '937bf98973bbd864910f459b5fe5bd65']);

// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
//$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

//$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
//$text = $events->getText();
/*$text="昔";
$html = file_get_contents("https://www.weblio.jp/content/" . $text);
$contents = phpQuery::newDocument($html)->find(".midashigo")->text();
echo $contents;*/
//echo textChecker('昔');
$html = file_get_contents("https://www.weblio.jp/content/" . $text);
        $contents = phpQuery::newDocument($html)->find('.kijiWrp')->find(".midashigo");
        foreach($contents as $content){
           echo pq($content)->text();
        }
        echo '777';
//$userId = $events->getUserId();
/*$html = file_get_contents("https://ja.wikipedia.org/wiki/%E4%B8%89%E5%9B%BD%E5%BF%97");

echo phpQuery::newDocument($html)->find(".mw-parser-output")->find('p:first')->text();*/
/*foreach ($events as $event) {
    // メッセージを返信
    $response = $bot->replyMessage(
        $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($event)  
    );
}*/