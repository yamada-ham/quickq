<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\IndexController();
$app->run();
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

  <div class="topImgBox">
    <div class="inTopImgBox">
      <img src = "./image/quickq_title.png">
    </div>
  </div>
  <ul class="questLimitBox">
    <li class="newListBox">
      <div class="inNewListBox">
        <div><h2>最新アンケート</h2></div>
        <ul>
          <?php foreach($app->getValues()->quests as $quest) :?>
          <li><a href="<?= SITE_URL.'/questAnswer.php?code=' .h($quest->code);?>"><?= h($quest->questTitle);?></a></li>
        <?php endforeach; ?>
        </ul>
      </div>
    </li><!-- newListBox -->
    <li class="newListBox">
      <div class="inNewListBox">
        <div><h2>人気アンケート</h2></div>
        <ul>
          <?php foreach($app->getValues()->popularQuests as $quest) :?>
          <li><a href="<?= SITE_URL.'/questAnswer.php?code=' .h($quest->code);?>"><?= h($quest->questTitle);?></a></li>
        <?php endforeach; ?>
        </ul>
      </div>
    </li><!-- newListBox -->
  </ul>

<div class="categoryBox">
    <div class="inCategoryBox">
    <ul class="accordion_ul clear">
      <?php foreach(CATEGORY as $key => $arr) :?>
        <li>
          <section>
          <h1><?= $key?></h1>
          <ul>
            <?php foreach($arr as $val) :?>
              <li><a href="<?= SITE_URL . '/category.php?category=' . h($val) ?>"><?= $val ?></a></li>
            <?php endforeach; ?>
          </ul>
          </section>
      </li>
    <?php endforeach; ?>
  </ul>
  </div>
</div><!-- categoryBox -->


  <div class='createBox'>
    <p><a href="createQuest.php">+</a></p>
  </div>
  <?php require_once(PARTS_PASS .'footerPart.php') ?>

</div><!-- #wrap -->
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
