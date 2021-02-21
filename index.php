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
        reset($userId);
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('お疲れ様でした！')
        );
    }else if(!checkPlay($userId)){
        $response = $bot->replyMessage(
            $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('しりとりを開始する場合は「しりとり始め」と、\nしりとりを終了する場合は「しりとり終了」と打ってください!')
        );
    }else{//しりとり中
        $preword = prword($userId);// 次の頭文字
        $content = textChecker($text, $preword);//正しい単語か
        if($content!=""){
            $ftext = ftext($content);
            if(duplicate($userId,$ftext)){
                //正しい
                $gobi = mb_substr($ftext, -1, 1);
                insert($ftext, $content, $userId, $gobi);
                $replyMes = replyMes($userId, $gobi);
                $last = mb_substr($content, -1,1);
                $reply = '私は「'. $replyMes .'」です。\n「'.$last.'」からお願いします!';
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
                $event->getReplyToken(), new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('単語が見つかりませんでした..別の単語にしてください。')  
            );
        }
    } 
}