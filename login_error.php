<?php
session_start();
if(isset($_SESSION['id'])){
  header("Location:mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" href="login_error.css">
</head>
<body>
  <header>
    <img src="image/logo.png">
    <div class="login">
      <a href="login.php">ログイン</a>
    </div>
  </header>

  <main>
    <form action="mypage.php" method="post">
      <div class="form_contents">
        <div class="error_message">
          メールアドレスまたはパスワードが間違っています。
        </div>
        <div class="mail">
          <label>メールアドレス</label>
          <br>
          <input type="text" class="formbox" size="40" name="mail" value="">
        </div>
        <div class="password">
          <label>パスワード</label>
          <br>
          <input type="password" class="formbox" size="40" name="password" value="">
        </div>
        <div class="checkbox">
          <label><input type="checkbox" size="40" value="login_keep" name="login_keep">ログイン状態を保持する</label>
        </div>
        <div class="login_button">
          <input type="submit" class="submit_button" size="35" name="login" value="ログイン">
        </div>
      </div>
    </form>
  </main>

  <footer>
  ©2020 Mori.Inc. All rights reserved
  </footer>
</body>
</html>