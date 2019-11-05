<?php
require_once(__DIR__ . '/../config/config.php');
$app = new MyApp\Controller\CreateQuestController();
$app->run();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>アンケート作成中</title>
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
        <textarea name="questTitle" class="questTitle" placeholder="例:" maxlength="200"></textarea>
      </div>



      <div class="choicesListBox clear">
        <p>2.アンケートの選択欄を作成してください。</p>
        <ul id="choicesList">
          <li ><input type="text" name="choice[]" value="賛成" placeholder="未入力"></li>
          <li><input type="test" name="choice[]" value="反対" placeholder="未入力"></li>
        </ul>
        <div class="addRemoveChoiceBox">
          <label><input type="button" id="addChoiceInput" value="+"></label>
          <label><input type="button" id="removeChoiceInput" value="−"></label>
        </div>
      </div>

      <div class="createCategoryBox">
        <p>3.カテゴリーを選択してください。</p>
        <div class="parentInCreateCategoryBox">
          <select class="parentCategory">
            <option value="" selected="selected" disabled>選択</option>
        <?php foreach(CATEGORY as $key => $arr ) :?>
          <option value="<?=$key?>"><?=$key?></option>
        <?php endforeach;?>
          </select>
        </div>

        <div class="childInCreateCategoryBox hidden">
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
