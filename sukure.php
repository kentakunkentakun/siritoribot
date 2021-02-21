<?php

    require_once("./phpQuery-onefile.php");
    mb_language('Japanese');
    function textChecker($text, $kasira){
        $html = file_get_contents("https://www.weblio.jp/content/".$text);
        $html = mb_convert_encoding($html, "HTML-ENTITIES", "auto"); 
        $contentsNum = count(phpQuery::newDocument($html)->find('.kijiWrp:eq(0)')->find("h2"));
        $contents = phpQuery::newDocument($html)->find('.kijiWrp:eq(0)');
        for($i = 0; $i < $contentsNum; $i++){
            $content = $contents->find("h2:eq(".$i.")")->text();
            if(mb_substr($content,0,1)==$kasira){
                return $content;
            }
        }
        return "";
    }
    function replyMes($userId, $gobi){
        $html = file_get_contents("https://しりとり.net/「ず」からはじまる言葉");
        echo $html;
    }