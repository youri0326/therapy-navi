<?php

// 接続
// hostはコンテナ名を記載する
$dsn = 'mysql:dbname=therapyNavi-db;host=run-php-db;';
$user = 'root';
$password = 'root123';

try {
    $pdo = new PDO($dsn, $user, $password);
    $sth = $pdo->query("SELECT * FROM test WHERE id = 1");
    $user = $sth->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
    echo("PHP");
} catch (PDOException $e) {
    print('Error:'.$e->getMessage());
    exit;
}
