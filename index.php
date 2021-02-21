<?php

require_once("./sukure.php");
require_once("./sql.php");
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));

//CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
var_dump(replyMes('hh','は'));
// LINE Messaging APIがリクエストに付与した署名を取得
/*$signature = $_SERVER["HTTP_" . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
foreach ($events as $event) {
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
        resets($userId);
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('お疲れ様でした！')
        );
    }else if(!checkPlay($userId)){
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('しりとりを開始する場合は「しりとり始め」と、しりとりを終了する場合は「しりとり終了」と打ってください!')
        );
    }else{//しりとり中
        $preword = prword($userId);// 次の頭文字
        $content = textChecker($text, $preword);//正しい単語か
        if(mb_substr($text, -1,1)=='ん'){
            $response = $bot->replyMessage(
                $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('「ん」で終わってますよ!')
            );
        }else if($content!=""){
            $ftext = ftext($content);
            if(duplicate($userId,$ftext)){
                //正しい
                $gobi = mb_substr($ftext, -1, 1);
                insert($ftext, $content, $userId, $gobi);
                $replyMes = replyMes($userId, $gobi);
                $last = mb_substr($replyMes, -1,1);
                $reply = '私は「'. $replyMes .'」です。「'.$last.'」からお願いします!';
                $response = $bot->replyMessage(
                    $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($reply)
                );
            }else{
                $response = $bot->replyMessage(
                    $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('既に使われた単語です！')
                );
            }
        }else{
            //そんな単語存在しません
            $response = $bot->replyMessage(
                $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('単語が見つかりませんでした..ひらがなにしたり、別の単語に変えてください。')  
            );
        }
    } 
}*/