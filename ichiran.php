<?php
    // ①DBへ接続
    $dsn = 'mysql:dbname=phpkiso5;host=localhost';
    $user = 'root'; // XAMPPの設定で決まっています
    $password = ''; // XAMPPの設定で決まっています
    $dbh = new PDO($dsn, $user, $password); // DBとの接続を行う命令文
    $dbh->query('SET NAMES utf8'); // 文字コード

    // ②SQL実行
    $sql = 'SELECT * FROM `anketo` WHERE 1'; // SQL文を用意
    $stml = $dbh->prepare($sql); // DBオブジェクトにSQL文をセット
    $stml->execute(); // セットされたSQLをDBに対して実行
    // ↑ $stmlに取得したデータが代入される

    // ③DBとの切断
    $dbh = null;

    // ④取得結果を処理 (SELECTした内容を表示)
    echo '<pre>';
    var_dump($stml); // $stmlの中身を確認してみる
    echo '</pre>';

    while (1) { // breakされるまで繰り返し
        // 1レコード取得
        $rec = $stml->fetch(PDO::FETCH_ASSOC);

        if ($rec == false) {
            break;
        }

        // 表示処理 ($recを使用)
        print $rec['code'];
        print $rec['nickname'];
        print $rec['email'];
        print $rec['goiken'];
        print '<br>';
    }
    // ObjectからArrayに変換
    // 繰り返し文で全件表示
?>






