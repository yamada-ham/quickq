<?php
// ログインページ
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\LoginController();
$app->run();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Log In</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <div id="wrap">
    <?php require_once(PARTS_PASS.'headerPart2.php')?><!--ヘッダー-->

    <div class="contentsBox">
      <div class="inContentsBox">
        <h2>QuickQにログイン</h2>
        <hr>
        <form action="" method="post" id="login">
          <div class="inputTextBox">
            <label for="email" class="emailLabel">email:</label>
            <p class="typeText">
              <input id="email" type="text" name="email" placeholder="quick@example.com" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
            </p>
          </div>
          <div class="inputTextBox">
            <label for="password" class="emailLabel">pass:</label>
            <p class="typeText">
              <input id="password" type="password" name="password" placeholder="" value="<?= isset($app->getValues()->password) ? h($app->getValues()->password) : ''; ?>">
            </p>
          </div>

          <p class="errBox"><?= h($app->getErrors('login')); ?></p>

          <div class="submitBox">
            <p class="inSubmitBox">
              <input type="submit" name="id" value="ログイン">
            </p>
          </div>

          <div class="signupBox">
            <p class="inSignupBox"><a href="<?= SITE_URL . '/signup.php'?>">新しいQuickQアカウントを作成</a></p>
          </div>

          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
      </div>
    </div><!-- contentsBox -->

  </div>
</body>
</html>
