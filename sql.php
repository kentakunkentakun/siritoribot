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
function duplicate($userId, $ftext){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("SELECT * FROM siritori WHERE userId = ? AND hurigana = ? ORDER BY id DESC ");
    $stmt->execute([$userId, $ftext]);
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
    $reset = $pdo->prepare("INSERT INTO playing (userid) VALUES (?)");
    $reset->execute([$userId]);
}
function resets($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("DELETE FROM siritori WHERE userId = ?");
    $stmt->execute([$userId]);
    $stmt = $pdo->prepare("DELETE FROM playing WHERE userId = ?");
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
function result($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $sql = 'SELECT hurigana FROM siritori WHERE userid = ? ';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}