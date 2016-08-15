<?php
    // $_POSTが存在するかどうかで処理を分ける
    $col = ''; // 初期化
    $data = ''; // 初期化
    if (!empty($_POST)) {
        print '検索ボタンが押されたとき';
        // フォームに入力されたデータを代入
        $col = $_POST['col'];
        $data = $_POST['data'];
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
    if ($_POST['search']) {
        $sql = 'SELECT * FROM `anketo` WHERE
        `' . $col . '`="' . $data . '"'; // SQL文を用意
        echo $sql;
    } else {
        $sql = 'SELECT * FROM `anketo` WHERE
        `' . $col . '` LIKE "%' . $data . '%"'; // SQL文を用意
        echo $sql;
    }

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
  <form method="post" action="kensaku_all_button.php">
    検索対象のカラム名を選択してください。<br>
    <input type="radio" name="col" value="code" id="code" checked> <label for="code">code</label>
    <input type="radio" name="col" value="nickname" id="nickname"> <label for="nickname">nickname</label>
    <input type="radio" name="col" value="email" id="email"> <label for="email">email</label>
    <input type="radio" name="col" value="goiken" id="goiken"> <label for="goiken">goiken</label>
    <br>
    <!-- $_POST['col'] -->
    <input type="radio" name="search" value="true"> 完全一致
    <input type="radio" name="search" value="false"> 部分一致
    <br>
    検索したい値を入力してください。<br>
    <input type="text" name="data"><br>
    <!-- $_POST['data'] -->
    <input type="submit" value="検索">
  </form>

  <!-- 検索フォーム作成 -->
  <form method="post" action="kensaku_all_button.php">
    検索対象のカラム名を選択してください。<br>
    <select name="col">
      <option value="code">code</option>
      <option value="nickname">nickname</option>
      <option value="email">email</option>
      <option value="goiken">goiken</option>
    </select>
    <br>
    <!-- $_POST['col'] -->
    検索したい値を入力してください。<br>
    <input type="text" name="data"><br>
    <!-- $_POST['data'] -->
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
