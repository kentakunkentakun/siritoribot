<?php

function prWord($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("SELECT * FROM siritori WHERE userid = ? ORDER BY id DESC ");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['gobi'];
}
function insert($hurigana, $text, $userId, $gobi){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $sql = "INSERT INTO siritori (hurigana, word, userid, gobi) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$hurigana, $text, $userId, $gobi]);
    var_dump($pdo -> errorInfo());
}
//重複確認
function duplicate($userId, $content){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("SELECT * FROM siritori WHERE userId = ? AND word = ? ORDER BY id DESC ");
    $stmt->execute([$userId, $content]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        return true;
    }else{
        return false;
    }
}
function initialize($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $reset = $pdo->prepare("INSERT INTO siritori (hurigana, word, userid, gobi) VALUES (?, ?, ?, ?)");
    $reset->execute(['しりとり', 'しりとり', $userId, 'り']);
}
function resets($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("DELETE FROM siritori WHERE userId = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
function checkPlay($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("SELECT * FROM playing WHERE userId = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($result)){
        return true;
    }else{
        return false;
    }
}
