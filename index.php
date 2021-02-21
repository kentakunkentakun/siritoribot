<?php

require_once("./sukure.php");
require_once("./sql.php");
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

//CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '937bf98973bbd864910f459b5fe5bd65']);
$str = "おお・い〔おほい〕【多い】";
$result = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
var_dump($result);
// LINE Messaging APIがリクエストに付与した署名を取得
/*$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);*/

/*foreach ($events as $event) {
    $text = $event->getText();
    $userId = $event->getUserId();

    if($text == 'しりとり始め'){//しりとり開始
        if(checkPlay($userId)){
            $response = $bot->replyMessage(
                $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('既にしりとり中ですよ！')
            );
            continue;
        }
        initialize($userId);
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('ではしりとりの「り」からお願いします！')
        );
    }else if($text == 'しりとり終了'){//しりとり終了
        reset($userId);
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('お疲れ様でした！')
        );
    }else{//しりとり中
        $preword = prword($userId);
        $content = textChecker($text, $preword);
        $reply;
        if($content!=""){
            $ftext = mb_substr($content,0,mb_strpos($text, '【'));
            if(duplicate($userId,$content)){
                //正しい
                $gobi = mb_substr($content, mb_strpos($text, '【')-1, 1);
                insert($ftext, $content, $userId, $gobi);
                $replyMes = replyMes($userId, $gobi);
                
                $response = $bot->replyMessage(
                    $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($replyMes);
                );

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
}*/