<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\UserAccountInfoChangeController();
$app->run(h($app->me()->id));
$userData = $app->getValues()->userData;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>アカウント情報の変更</title>
<meta name="viewport" content="width=device-width">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="styles/style.css">
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div id="wrap">
<?php require_once(PARTS_PASS .'headerPart.php') ?>
  <div class="changeFormBox">
    <div class="inChangeFormBox">
      <h2>あなたの情報を変更</h2>

  <form action="" method="POST">
    <label for="userName">ユーザー名:</label><input type='text' id="userName" name="userName" value="<?= $userData->userName ?>">
    <label for="email">メールアドレス:</label><input type='text' id="email" name="email" value="<?= $userData->email ?>">
    <p><input type="submit" value="変更内容を保存"></p>
    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
  </form>
    <div class="cancel"><a href="./userAccount.php">キャンセル</a></div>
    </div>
    <div class="">
      <p class="err"><?= h($app->getErrors('InvalidChange')); ?>　</p>
      <p class="err"><?= h($app->getErrors('CannotUpdateAccount')); ?></p>
    </div>
  </div>
</div>


</div><!--div#wrap-->

<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
