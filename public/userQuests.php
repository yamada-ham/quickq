<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\UserQuestsController();
$app->run(h($app->me()->id));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>アンケート作成サイト</title>
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
  </div>
</div>
<div class="createdQuestHistoryBox">
  <div class="inCreatedQuestHistoryBox">
  <h3>作成したアンケート</h3>
    <ul>
      <?php foreach($app->getValues()->userQuests as $userQuest):?>
        <li>
          <div class="questHistoryInfo clear">
            <p>作成日:<?= $app->dateFormat($userQuest->created);?></p>
            <p class="answerNum"><img src='./image/icon/anserNumIcon.png' class="answerNumIcon"><span><?= $userQuest->numberOfResponses ?><span></p>
          </div>
          <div class="questHistoryTitle">
            <p><a href="<?=SITE_URL . '/questAnalysis.php?code='.$userQuest->code?>"><?= h($userQuest->questTitle);?></a></p>
          </div>
        </li>
      <?php endforeach;?>
    </ul>
  </div>
</div>
<div class='createBox'>
  <p><a href="createQuest.php">+</a></p>
</div>
</div><!--div#wrap-->

<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
