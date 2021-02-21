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
        $content;
        $checkStr;
            $html = file_get_contents("https://しりとり.net/「" . $gobi . "」からはじまる言葉/");
            $html = mb_convert_encoding($html, "HTML-ENTITIES", "auto"); 
            $content = phpQuery::newDocument($html)->find('#cntFdWrp')->find(".cntFdHead:eq(". $num2 .")")->find('.cntFdMidashi')->text();
            $checkStr = mb_substr($content, -1,1);

        //insert($content, $content, $userId, mb_substr($content, -1,1));
        return $html;
        //return $checkStr;
    }
    function ftext($text){
        if(mb_strpos($text, '〔') != false){
            return mb_substr($text,0,mb_strpos($text, '〔'));
        }else if(mb_strpos($text, '【') != false){
            return mb_substr($text,0,mb_strpos($text, '【'));
        }else{
            return $text;
        }
    }