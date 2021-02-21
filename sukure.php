<?php

    require_once("./phpQuery-onefile.php");
    function textChecker($text, $kasira){
        $html = file_get_contents("https://www.weblio.jp/content/".$text);
        $contentsNum = count(phpQuery::newDocument($html)->find('.kijiWrp:eq(0)')->find("h2"));
        $contents = phpQuery::newDocument($html)->find('.kijiWrp:eq(0)');
        for($i = 0; $i < $contentsNum; $i++){
            $content = $contents->find("h2:eq(".$i.")")->text();
            if(substr($content,0,1)===$kasira){
                return $content;
            }
        }
        return "";
    }