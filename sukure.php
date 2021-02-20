<?php

    require_once("./phpQuery-onefile.php");
    function textChecker($text){
        $html = file_get_contents("https://www.weblio.jp/content/" . $text);
        $contents = phpQuery::newDocument($html)->find('.kijiWrp')->find(".midashigo");
        foreach($contents as $content){
            return $content->text();
        }
    }