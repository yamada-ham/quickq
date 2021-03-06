<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\CreateQuestController();
$app->run();
$choices = isset($app->getValues()->choice)?$app->getValues()->choice:'';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>QuickQ</title>
<link rel="stylesheet" href="styles/style.css">
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body onLoad="document.signup.questTitle.focus()">
  <div id="wrap">
  <?php require_once(PARTS_PASS .'headerPart.php') ?>
  <div class="createQuestBox">
    <div class="inCreateQuestBox">

    <form action="" method="post" id="signup" name="signup">
      <!-- <p>
        <input type="text" name="questTitle" placeholder="アンケートのタイトル">
      </p> -->
      <div class="questTitleBox">
        <p>1.アンケートの内容を記述してください。</p>
        <textarea name="questTitle" class="questTitle" placeholder="例1:カレーにカボチャを入れる？
例2:好きな種類の音楽は？" maxlength="200"><?= isset($app->getValues()->questTitle) ? h($app->getValues()->questTitle) : ''; ?></textarea>
<span class="questTitleTtextLength">0/200</span>
      </div>
<!-- &#10 改行文字 -->


      <div class="choicesListBox clear">
        <p>2.アンケートの選択欄を作成してください。</p>
        <ul id="choicesList">
          <?php if(empty($choices)): ?>
            <li ><input type="text" name="choice[]" value="" placeholder="未入力"></li>
          <?php else: ?>
            <?php foreach($choices as $choice): ?>
              <li ><input type="text" name="choice[]" value="<?= $choice ?>" placeholder="未入力"></li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
        <div class="addRemoveChoiceBox">
          <label><input type="button" id="addChoiceInput" value="+"></label>
          <label><input type="button" id="removeChoiceInput" value="−"></label>
        </div>
      </div>

      <div class="createCategoryBox">
        <p>3.カテゴリーを二つ選択してください。</p>
        <div class="parentInCreateCategoryBox">
          <select class="parentCategory">
            <option value="" selected="selected" disabled>選択</option>
        <?php foreach(CATEGORY as $key => $arr ) :?>
          <option value="<?=$key?>"><?=$key?></option>
        <?php endforeach;?>
          </select>
        </div>

        <div class="childInCreateCategoryBox">
          <select name="category" class="childCategory" disabled>
            <option value="" selected="selected" disabled>選択</option>
            <?php foreach(CATEGORY as $key => $arr ) :?>
              <?php foreach($arr as $val): ?>
                <option value="<?=$val?>" data-val="<?=$key?>"><?=$val?></option>
              <?php endforeach;?>
            <?php endforeach;?>
          </select>
        </div>
      </div>

      <div class="errCreateQuestBox">
        <p class="err"><?= h($app->getErrors('Quest')); ?>　</p>
        <p class="err"><?= h($app->getErrors('InvalidQuest')); ?>　</p>
      </div>

      <p><input type="hidden" name="userId" value="<?=$app->me()->id?>"></p>

      <div class="createQuestSubmitBox">
        <input type="submit" value="作成">
      </div>


      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    </div>
  </div>

    <input id = 'hiddenChoice'type="hidden" name="choice[]" value="" placeholder="未入力">
</div>
  <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
