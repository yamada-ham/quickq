<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\UserAccountController();
$app->run(h($app->me()->id));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>アカウント情報</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="styles/style.css">
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div id="wrap">
<?php require_once(PARTS_PASS .'headerPart.php') ?>
<div class="accountInfoBox">
  <div class="inAccountInfoBox">
    <div class="accountBarBox">
      <p><?= h($app->me()->userName);?>さん</p>
    </div>
    <div>
      <div>
        <p>ユーザー名:<?= h($app->me()->userName);?></p>
        <p>アドレス:<?= h($app->me()->email);?></p>
      </div>
    </div>
    <div class="accountInfoChangeCase">
      <div class="inAccountInfoChangeCase">
        <a href="./userAccountInfoChange.php">アカウント情報の変更</a>
      </div>
    </div>
    <div>
      <div>
        <p><a href="./userQuests.php">作成したアンケート</a></p>
      </div>
    </div>
  </div>
</div>


</div><!--div#wrap-->

<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
