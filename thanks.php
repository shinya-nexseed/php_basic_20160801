<?php
    // DBへデータを登録するプログラム
    // ①DBへ接続
    $dsn = 'mysql:dbname=phpkiso5;host=localhost';
    $user = 'root'; // XAMPPの設定で決まっています
    $password = ''; // XAMPPの設定で決まっています
    $dbh = new PDO($dsn, $user, $password); // DBとの接続を行う命令文
    $dbh->query('SET NAMES utf8'); // 文字コード

    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $goiken = htmlspecialchars($_POST['goiken']);

    // ②SQL実行
    $sql = 'INSERT INTO `anketo` (`nickname`, `email`, `goiken`) VALUES ("' . $nickname . '", "' . $email . '", "' . $goiken . '")'; // SQL文を用意
    // 読みやすさを考慮して、テーブル名とカラム名はすべてアクサングラーブで囲う
    $stml = $dbh->prepare($sql); // DBオブジェクトにSQL文をセット
    $stml->execute(); // セットされたSQLをDBに対して実行

    // ③DBとの切断
    $dbh = null;

    print $nickname . '様<br>';
    print 'ご意見有難うございました<br>';
    print '頂いたご意見『';
    print $goiken;
    print '』<br>';
    print $email;
    print 'にメールをお送りしましたのでご確認ください';
 ?>
