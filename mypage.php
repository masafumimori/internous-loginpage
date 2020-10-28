<?php
  mb_internal_encoding("utf8");
  session_start();

  if (empty($_SESSION['id'])) {
    try {
      $pdo = new PDO ("mysql:dbname=masafumi;host=localhost;", "root", "");
    }catch (PDOException $e){
      die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスができません。
      <br>
      しばらくたってから再度ログインしてください。</p>
      <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
      );
    }
  
    $stmt = $pdo -> prepare("select * from login_mypage where mail=? and password=?");
  
    $stmt -> bindValue(1, $_POST['mail']);
    $stmt -> bindValue(2, $_POST['password']);
    $stmt -> execute();
    $pdo = NULL;
  
    while ($row = $stmt -> fetch()){
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['mail'] = $row['mail'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['picture'] = $row['picture'];
      $_SESSION['comments'] = $row['comments'];
    }

    // もし上記$_SESSION['']にデータが入っていなければ、エラー画面にリダイレクト
    if (empty($_SESSION['id'])){
      header("Location:login_error.php");
    }

    // ログイン保持にチェックがあれば、セッションに代入
    if (!empty($_POST['login_keep'])){
      $_SESSION['login_keep'] = $_POST['login_keep'];
    }
  }

  // ログインしていてログイン情報保持のセッションがある場合は、Cookieを作成
  if (!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])) {
    setcookie('mail', $_SESSION['mail'], time()+60*60*24*7);
    setcookie('password', $_SESSION['password'], time()+60*60*24*7);
    setcookie('login_keep', $_SESSION['login_keep'], time()+60*60*24*7);
    // ログインキープのセッションがなければCookie削除
  }else if (empty($_SESSION['login_keep'])){
    setcookie('mail', time()-1);
    setcookie('password', time()-1);
    setcookie('login_keep', time()-1);
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ登録</title>
  <link rel="stylesheet" href="mypage.css">
</head>

<body>
  <header>
    <img src="image/logo.png">
    <div class="login"><a href="log_out.php">ログアウト</a></div>
  </header>
  
  <div class="mypage">
      <h2>会員情報</h2>
      <div class="mypage-container">
        <div class="profile">
          <div class="greet">
            <?php echo "こんにちは！ ".$_SESSION['name']."さん"; ?>
          </div>
          <div class="profile-left">
            <img src="<?php echo $_SESSION['picture']; ?>">
          </div>
          <div class="profile-right">
            <div class="name">
              <p>氏名 : <?php echo $_SESSION['name']; ?></p>
            </div>
            <div class="mail">
              <p>メール : <?php echo $_SESSION['mail']; ?></p>
            </div>
            <div class="password">
              <p>パスワード : <?php echo $_SESSION['password']; ?></p>
            </div>     
          </div>
        </div>
        <div class="comments">
          <?php echo $_SESSION['comments']; ?>
        </div>
        <form action="mypage_hensyu.php" method="post" class="henshu">
          <input type="hidden" value="<?php echo rand(1,10); ?>" name="from_mypage">
          <input type="submit" class="henshu_button" value="編集する"/>
        </form>
      </div>
  </div>

  <footer>
    ©2020 Mori.Inc. All rights reserved
  </footer>

</body>

</html>