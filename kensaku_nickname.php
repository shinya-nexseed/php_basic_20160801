<?php
    // $_POSTが存在するかどうかで処理を分ける
    $nickname = ''; // 初期化
    if (!empty($_POST)) {
        print '検索ボタンが押されたとき';
        // フォームに入力されたデータを$codeに代入
        $nickname = $_POST['nickname'];
    } else {
        print '普通にページが読み込まれたとき';
    }

    // ①DBへ接続
    $dsn = 'mysql:dbname=phpkiso5;host=localhost';
    $user = 'root'; // XAMPPの設定で決まっています
    $password = ''; // XAMPPの設定で決まっています
    $dbh = new PDO($dsn, $user, $password); // DBとの接続を行う命令文
    $dbh->query('SET NAMES utf8'); // 文字コード

    // ②SQL実行
    $sql = 'SELECT * FROM `anketo` WHERE
    `nickname` LIKE "%' . $nickname . '%"'; // SQL文を用意
    echo $sql;
    $stml = $dbh->prepare($sql); // DBオブジェクトにSQL文をセット
    $stml->execute(); // セットされたSQLをDBに対して実行
    // ↑ $stmlに取得したデータが代入される

    // ③DBとの切断
    $dbh = null;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <!-- 検索フォーム作成 -->
  <form method="post" action="kensaku_nickname.php">
    ニックネームを入力してください。<br>
    <input type="text" name="nickname"><br>
    <input type="submit" value="検索">
  </form>
  <?php
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
  ?>
</body>
</html>
