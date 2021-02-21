<?php

require_once("./sukure.php");
require_once("./sql.php");
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

//CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '937bf98973bbd864910f459b5fe5bd65']);

// LINE Messaging APIがリクエストに付与した署名を取得
$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
if(duplicate('kentakunkentakun', 'ふりな')) echo '77';
else echo 'h11';
/*$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);

foreach ($events as $event) {
    {//しりとり開始



    }
    {//しりとりのつづき
        $text = $event->getText();
        $userId = $event->getUserId();
        $preword = prword($userId);
        $content = textChecker($text, $preword);
        $reply;
        if($content!=""){
            $ftext = mb_substr($content,0,strpos($text, '【'));
            if(duplicate($userId,$ftext)){
                //正しい

                insert($ftext, $content, $userId, substr($content, mb_strpos($text, '【')-1, 1));

            }else{
                $response = $bot->replyMessage(
                    $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('既に使われた単語です！')
                );
            }
        }else{
            //そんな単語存在しません
            $response = $bot->replyMessage(
                $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('単語が見つかりませんでした..別の単語にしてください。')  
            );
        }
    }
    {//しりとり終了

    }
    
}*/