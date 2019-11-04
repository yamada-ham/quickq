<?php
require_once(__DIR__ . '/../config/config.php');
if(!isset($_GET['code'])||empty($_GET['code'])){
  header('Location:'.SITE_URL);
  exit;
}
$app = new MyApp\Controller\QuestAnswer();
$app->run($_GET['code']);
$data = $app->getValues()->quest;

$choicesList = explode(',',$data->choicesList);
$resultChoices = $app->getValues()->resultChoices;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>アンケート回答</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="styles/style.css">
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" ></script>

</head>
<body>
<div id="wrap">
<?php require_once(PARTS_PASS .'headerPart2.php') ?>
  <div class="answerBox">
    <div class="inAnswerBox">

  <?php if($app->checkAnswer($_GET['code'])): ?>
    <p>回答ありがとうございました。二度目の回答はできません</p>
    <div class="chartBox">
    <div class="inChartBox">
      <h3>投票結果</h3>
      <canvas id="myChartPie" style="position: relative; height:60vh; width:100vw;"></canvas>
    </div>
    </div>
    <script>

    let colors = ['red','blue','yellow','green','pink','brown','orange','purple','black','gray'];

    var ctx = document.getElementById("myChartPie").getContext('2d');
      var myChartPie = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: JSON.parse('<?= $resultChoices[0]; ?>'),
          datasets: [{
            backgroundColor: colors,
            data: JSON.parse('<?= $resultChoices[1]; ?>')
          }]
        },
        options: {
            plugins: {
              labels: {
                position:'outside',
                showActualPercentages: true,
                outsidePadding: 4,
                textMargin: 4
            }
          }
        }
      });
    </script>
  <?php else: ?>
<form action="" method="post">
  <input type="hidden" name="questTitle" value="<?= h($data->questTitle);?>">

  <div class="parmanentQuestBox clear">
    <p>Q.あなたの年齢と性別をお答えください。</p>
    <div class="ageSelectBox"><select name = "age">
      <option selected disabled>年齢</option>
      <option value="00">10才未満</option>
      <option value="10">10代</option>
      <option value="20">20代</option>
      <option value="30">30代</option>
      <option value="40">40代</option>
      <option value="50">50代</option>
      <option value="60">60代</option>
      <option value="70">70代以上</option>
    </select></div>

    <div class="sexBox">
      <input type="radio" name="sex" value="男" id="man"><label for="man" class="man">男</label>
      <input type="radio" name="sex" value="女" id="woman"><label for="woman" class="woman">女</label>
    </div>
  </div><!-- parmanentQuestBox -->

  <div class="answerRadioBox">
    <p>Q.<?= h($data->questTitle); ?>(該当するものを一つお答えください)</p>
    <ul class="inAnswerRadioBox">
      <?php for($i = 0; $i < h($data->choicesNum);$i++):?>
      <li><input type="radio" name="choice" class="answerRadio radio" id="answerRadio<?=$i?>" value="<?=$choicesList[$i]?>"><label for="answerRadio<?=$i?>" ><?=h($choicesList[$i]); ?></label></li>
      <?php endfor;?>
    </ul>
  </div>

  <div class="errAnswerBox"><p><?= h($app->getErrors('answer')); ?>　</p></div>

  <div class="answerSubmitBox">
    <input type="submit" value="回答">
  </div>

  <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
</form>
<?php endif; ?>
</div>
</div>
</div>
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
