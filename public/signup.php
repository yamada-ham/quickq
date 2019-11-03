<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\Signup();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <div id="wrap">
    <?php require_once(PARTS_PASS.'/headerPart2.php')?>

    <div class="contentsBox">
      <div class="inContentsBox">
        <h2>アカウントの作成</h2>
        <hr>
        <form action="" method="post" id="signup">
          <div class="inputTextBox">
            <label for="email" class="emailLabel">email:</label>
            <p class="typeText">
              <input type="text" name="email" placeholder="quick@example.com" value="<?=isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
              <p class="err"><?= h($app->getErrors('email'));?></p>
            </p>
          </div>

          <div class="inputTextBox">
            <label for="password" class="emailLabel">pass:</label>
            <p>
              <input type="password" name="password" placeholder="•••••••••">
            </p>
            <p class="err"><?= h($app->getErrors('password'));?></p>
          </div>

          <div class="inputTextBox">
            <label for="userName" class="emailLabel">ユーザー名</label>
            <p>
              <input type="text" name="userName" placeholder="Q田Q太郎">
            </p>
            <p class="err"><?= h($app->getErrors('password'));?></p>
            <p class="err"><?= h($app->getErrors('userName'));?></p>
          </div>

          <div class="submitBox">
          <p class="inSubmitBox">
            <input type="submit" name="id" value="サインアップ">
          </p>
        </div>
        <div class="signupBox">
          <p class="inSignupBox"><a href="<?= SITE_URL . '/login.php'?>">すでにアカウントはお持ちですか？</a></p>
        </div>

          <!--CSRF対策③トークンを送信-->
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
      </div>
    </div>
  </div>

</body>
</html>
