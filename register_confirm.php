<?php
mb_internal_encoding("utf8");

// 仮保存されたファイル名で画像を取得（サーバーへ仮アップロードされたディレクトリとファイル名
$temp_pic_name = $_FILES['picture']['tmp_name'];


// 元のファイル名で画像を取得。事前に画像を格納する「image」という名前のフォルダを用意しておく必要あり
$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/' . $original_pic_name;

// 仮保存のファイル名をimageフォルダに、元のファイル名で移動させる
move_uploaded_file($temp_pic_name, './image/' . $original_pic_name);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" type="text/css" href="register_confirm.css">
</head>

<body>
  <header>
    <img src="4eachblog_logo.jpg">
    <div class="login"><a href="login.php">ログイン</a></div>
  </header>

  <main>
    <div class="confirm">
      <div class="confirm-contents">
        <h2>登録情報の確認</h2>
        <p>登録情報はこちらでよろしいでしょうか？
          <br>
          よろしければ「登録する」ボタンを押して下さい。
        </p>
        <div class="name">
          <p>氏名 : <?php echo $_POST['name']; ?></p>
        </div>
        <div class="mail">
          <p>メールアドレス : <?php echo $_POST['mail']; ?></p>
        </div>
        <div class="password">
          <p>パスワード : <?php echo $_POST['password']; ?></p>
        </div>
        <div class="picture">
          <!-- 一番上の$_FILESのところからファイル名を引っ張ってくる -->
          <p>プロフィール写真 : <?php echo $original_pic_name; ?></p>
        </div>
        <div class="comments">
          <p>コメント : <?php echo $_POST['comments']; ?></p>
        </div>
      </div>
      <form action="register.php">
        <input type="submit" class="modoru_button" value="入力画面に戻る" size="35">
      </form>
      <form action="register_insert.php" method="post">
        <input type="submit" class="submit_button" size="35" value="登録する">
        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?> ">
        <input type="hidden" name="mail" value="<?php echo $_POST['mail']; ?> ">
        <input type="hidden" name="password" value="<?php echo $_POST['password']; ?> ">
        <!-- 画像データではなく、「移動先のファイルのパス」と「画像のファイル名」を格納する -->
        <input type="hidden" name="picture" value="<?php echo $path_filename; ?> ">
        <input type="hidden" name="comments" value="<?php echo $_POST['comments']; ?> ">
      </form>
    </div>
  </main>

  <footer>
    ©2018 InterNous.inc. All rights reserved
  </footer>

</body>

</html>