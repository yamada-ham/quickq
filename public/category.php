<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\CategoryController();
$app -> run();

$currentPage = isset($_GET['page'])?(int)$_GET['page']:1;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=SITE_TITLE?></title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="styles/style.css">
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
<div id="wrap">
<?php require_once(PARTS_PASS .'headerPart.php') ?>
<div class="theCategoryBox">
  <div class="inTheCategoryBox">
  <?php if(!isset($app->getValues()->pageRecords)||empty($app->getValues()->pageRecords)) :?>
    <p>『<?= h($_GET['category']);?>』カテゴリーのアンケートは作られておりません</p>
  <?php else: ?>
    <h2>『<?= h($_GET['category']);?>』カテゴリー</h2>
<ul>
  <?php foreach($app->getValues()->pageRecords as $quest) : ?>
    <li><a href="<?= SITE_URL . '/questAnswer.php?code='. h($quest->code) ?>"><?= h($quest->questTitle); ?></a>
    <div class="categoryQuestData">
      <img src='./image/icon/anserNumIcon.png' class="answerNumIcon"><span><?=h($quest->numberOfResponses)?></span></div>
    </li>
  <?php endforeach; ?>
<?php endif; ?>
</ul>

</div><!-- inTheCategoryBox -->
</div><!-- theCategoryBox -->


<div class="paginationBox">
<div class="inPaginationBox">
  <ul class="pagination">
    <?php if($currentPage > 1) :?>
    <li><a href="<?=SITE_URL.'/category.php?category='.h($_GET['category']).'&page='.($currentPage-1 > 0 ? $currentPage-1:1);?>" class="pageTop">&lt&lt</a></li>
    <?php endif; ?>
  <?php if($currentPage > 2):?>
  <?php for($i = $currentPage - 2; $i < $currentPage+3; $i++): ?>
      <?php if($i >$app->getValues()->maxpage){break;}?>
      <li><a href="<?=SITE_URL.'/category.php?category='.h($_GET['category']).'&page='.$i;?>" class="<?= ($currentPage == $i ? 'active' : '') ?>"><?=$i;?></a></li>
  <?php endfor;?>
  <?php else:?>
  <?php for($i=1; $i < 6;$i++):?>
        <?php if($i >$app->getValues()->maxpage){break;}?>
    <li><a href="<?=SITE_URL.'/category.php?category='.h($_GET['category']).'&page='.$i;?>" class="<?= ($currentPage == $i ? 'active' : '') ?>"><?=$i;?></a></li>
  <?php endfor;?>
  <?php endif;?>

  <?php if($currentPage+1 <=$app->getValues()->maxpage):?>
  <li><a href="<?=SITE_URL.'/category.php?category='.h($_GET['category']).'&page='.$app->getValues()->maxpage;?>" class="pageEnd">&gt&gt</a></li>
  <?php endif; ?>
  </ul>
</div>
</div>

</div><!-- div#wrap -->
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
