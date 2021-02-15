<?php

require_once("./phpQuery-onefile.php");

$html = file_get_contents("https://ja.wikipedia.org/wiki/%E4%B8%89%E5%9B%BD%E5%BF%97");

echo phpQuery::newDocument($html)->find(".mw-parser-output")->find('p:first')->text();

/*require './vendor/autoload.php';

// composerのパッケージ一覧から、名前に"helloworld"を含むパッケージを取得
$htmlStr = file_get_contents("https://packagist.org/search/?q=helloworld");

// htmlテキストをスクレイピングして、h4タグの一覧を取得
$dom = phpQuery::newDocument($htmlStr);
$titles = pq($dom)->find("h4");

// 取得したすべてのh4タグタイトルを画面に出力
foreach( $titles as $title ) {
    echo trim( pq($title)->text() ) . "\n";
}
