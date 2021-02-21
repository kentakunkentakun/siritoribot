<?php



/*try {
    
    
} catch (PDOException $e) {

    echo $error = $e->getMessage();

}*/


function prWord($userId){
    $url = parse_url(getenv('DATABASE_URL'));
    $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
    $pdo = new PDO($dsn, $url['user'], $url['pass']);
    $stmt = $pdo->prepare("SELECT * FROM siritori WHERE userid = ? ORDER BY id DESC ");
    $stmt->execute([$userId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
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
    $stmt = $pdo->prepare("SELECT * FROM siritori WHERE userId = ? AND hurigana = ? ORDER BY id DESC  FETCH FIRST 1 ROWS ONLY");
    $stmt->execute([$userId, $ftext]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(empty($result)){
        return true;
    }else{
        return false;
    }
}
