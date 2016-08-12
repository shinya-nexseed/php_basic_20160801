<?php
    // echo 'ようこそ！';
    // スーパーグローバル変数とは
    // 予めPHP側が定義した変数のことで、いくつか種類があります。
    // 各変数ごとに役割や生成されるタイミングが異なるが、開発を進めるにあたり非常に便利に働きます。

    // 命名規則
    // $_大文字変数名
    // $_POST ← formが送信された際に作成されるスーパーグローバル変数です
    // methodがpostになっている場合に作成される。
    // スペルミスをしていた際やデフォルト値としてはmethodにはgetが指定されるので注意
    // method="get"の場合は$_GETスーパーグローバル変数になる
    // echo $_POST['nickname'];
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $goiken = htmlspecialchars($_POST['goiken']);
    // チェックが入って入ればcheckという値が返ってくる
    $info = ''; // 初期値を定義
    if (!empty($_POST['info'])) {
        // もし$_POST['info']の値が空でなければ
        $info = $_POST['info'];
    }

    // 入力チェック機能
      // フォームのバリデーション
        // WEBサービスにとって重要
    // フォームの空チェック
    if ($nickname == '') {
        print 'ニックネーが入力されていません';
        print '<br>';
    // フォームの文字数チェック
    } elseif (strlen($nickname) <= 3) {
        print 'ニックネームは2文字以上で入力してください';
        print '<br>';
        // 日本語文字は一文字で2を返すため
        // strlen('abc') → 3
        // strlen('あいう') → 6
        // strlen()はバイト数を返す関数
        // 日本語が入ってくるフォームに対してはmb_strlen()を使用
    } else {
        print 'ようこそ';
        print $nickname;
        print '様';
        print '<br>';
    }

    // emailのバリデーション (入力チェック)
    if ($email == '') {
        print 'メールアドレスを入力してください';
        print '<br>';
    } else {
        print 'メールアドレス:';
        print $email;
        print '<br>';
    }

    // goikenのバリデーション (入力チェック)
    if ($goiken == '') {
        print 'ご意見を入力してください';
        print '<br>';
    } else {
        print 'ご意見『';
        print $goiken;
        print '』<br>';
    }

    // infoのバリデーション (入力チェック)
    if ($info == '') {
        print '「個人情報チェック」にチェックしてください';
        print '<br>';
    } else {
        print '個人情報チェック: はい';
        print '<br>';
    }

    // echo と printの違い
    // echo 'Hello', 'world'; ← ◯
    // print 'Hello', 'world'; ← ☓
    // $str = echo 'Hello'; ← ☓
    // $str = print 'Hello'; ← ◯

    // print '<a href="index.html">戻る</a>';
    // シングルクォートとダブルクォート入れ子
    // PHPのprintで使用しているシングルクォートと
    // HTMLのaタグで使用しているダブルクォートは
    // 同じクォートを使用すると競合するので注意

    // 各変数がすべて空でなければ処理
    if ($nickname == '' || $email == '' || $goiken == '' || $info == '') {
        // 戻るボタンのみ表示
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        // OKボタンを表示
        print '<form method="post" action="thanks.php">';
        print '<input type="hidden" name="nickname" value="' . $nickname . '">';
        print '<input type="hidden" name="email" value="' . $email . '">';
        print '<input type="hidden" name="goiken" value="' . $goiken . '">';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK">';
        print '</form>';
    }

 ?>











