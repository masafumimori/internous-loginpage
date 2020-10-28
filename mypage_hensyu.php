<?php
mb_internal_encoding("utf8");
session_start();

if (empty($_POST['from_mypage'])) {
  header("Location:login_error.php");
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" href="mypage_hensyu.css">
</head>

<body>
  <header>
    <img src="image/logo.png">
    <div class="login"><a href="login.php">ログイン</a></div>
  </header>

  <div class="mypage">
    <h2>会員情報</h2>
    <div class="mypage-container">
      <form class="henshu" action="mypage_update.php" method="post">
        <div class="profile">
          <div class="greet">
            <?php echo "こんにちは！ " . $_SESSION['name'] . "さん"; ?>
          </div>
          <div class="profile-left">
            <img src="<?php echo $_SESSION['picture']; ?>">
          </div>
          <div class="profile-right">
            <div class="name">
              <p>氏名 : <input type="text" value="<?php echo $_SESSION['name']; ?>" name="name">
              </p>
            </div>
            <div class="mail">
              <p>メール : <input type="text" value="<?php echo $_SESSION['mail']; ?>" name="mail">
              </p>
            </div>
            <div class="password">
              <p>パスワード : <input type="text" value="<?php echo $_SESSION['password']; ?>" name="password">
              </p>
            </div>
          </div>
        </div>
        <div class="comments">
          <textarea rows="5" name="comments"><?php echo $_SESSION['comments']; ?></textarea>
          </textarea>
        </div>
        <div class="update_btn">
          <input type="hidden" value="<?php echo rand(1,10)?>" name="update">
          <input type="submit" class="henshu_button" value="この内容に変更する" />
        </div>
      </form>
    </div>
  </div>

  <footer>
    ©2020 Mori.Inc. All rights reserved
  </footer>

</body>

</html>