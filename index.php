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
echo textChecker('昔', 'む');
$text = '昔';
$kasira = 'む';
$html = file_get_contents("https://www.weblio.jp/content/".$text);

$contentsNum = count(phpQuery::newDocument($html)->find('.kijiWrp:eq(0)')->find("h2"));
echo $contents = phpQuery::newDocument($html)->find('.kijiWrp:eq(0)');
for($i = 0; $i < $contentsNum; $i++){
    $content = $contents->find("h2:eq(".$i.")")->text();
    echo $content;
    if(substr($content,0,1)==$kasira){
        echo $content;
    }
}
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
            $ftext = substr($content,0,strpos($text, '【'));
            if(duplicate($userId,$ftext)){
                //正しい

                insert($ftext, $content, $userId, substr($content, strpos($text, '【')-1, 1));

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