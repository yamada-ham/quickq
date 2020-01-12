<?php
require_once(__DIR__ . '/../config/config.php');
if(!isset($_GET['code'])||empty($_GET['code'])){
  header('Location:'.SITE_URL);
  exit;
}
$app = new MyApp\Controller\QuestAnalysisController();
$app->run(h($app->me()->id),($_GET['code']));

$resultChoices = $app->getValues()->resultChoices;
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
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" ></script>
<script type="text/javascript" src="scripts/chartjs-plugin-labels.js"></script>
</head>
<body>
<div id="wrap">
<?php require_once(PARTS_PASS .'headerPart.php') ?>

<div class="questAnalysisBox">
<div class="inQuestAnalysisBox">
    <div class="questTitle"><p><span>アンケート内容：</span><?=$app->getValues()->questTitle?></p></div>

<div class="chartBox">
<div class="inChartBox">
  <h3>総合結果</h3>
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

<div class="chartBox">
<div class="inChartBox">
  <h3>年齢別</h3>
<canvas id="myChart" style="position: relative; height:70vh; width:100vw;"></canvas>
</div>
</div>
<script>

var ctx = document.getElementById("myChart").getContext('2d');

ageVotes = JSON.parse('<?= $resultChoices[4];?>');


  var getdatasets = [];
  var num = 0;
  for(key in ageVotes){
    getdatasets.push( {label:key,data:ageVotes[key],backgroundColor:colors[num]});
    num++;
  }
var myChart = new Chart(ctx, {
  type: 'horizontalBar',
  data: {
    labels: ["10才未満", "10代", "20代", "30代", "40代", "50代", "60代","70才以上"],
    datasets: getdatasets ,
  },
  options: {
      plugins: {
        labels: {
          fontSize:0,
      }
    },
    scales: {
      xAxes: [{
        ticks: {
            fontSize: 18,
            stepSize: 1,//軸間隔
        },
      }],
      yAxes: [{                         //x軸設定
        display: true,                //表示設定
        barPercentage: 1,           //棒グラフ幅
        categoryPercentage: 1,      //棒グラフ幅
    }],
    }
  }
});
</script>

<div class="chartBox">
<div class="inChartBox">
  <h3>男性限定</h3>
<canvas id="myChartDoughnutMan" style="position: relative; height:60vh; width:100vw;"></canvas>
</div>
</div>
<script>
var ctx = document.getElementById("myChartDoughnutMan").getContext('2d');
var myChartDoughnutMan = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: JSON.parse('<?= $resultChoices[0]; ?>'),
    datasets: [{
      backgroundColor: colors,
      data: JSON.parse('<?= $resultChoices[2]; ?>')
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


<div class="chartBox">
<div class="inChartBox">
  <h3>女性限定</h3>
<canvas id="myChartDoughnutWoman" style="position: relative; height:60vh; width:100vw;"></canvas>
</div>
</div>
<script>
var ctx = document.getElementById("myChartDoughnutWoman").getContext('2d');
var myChartDoughnutWoman = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: JSON.parse('<?= $resultChoices[0]; ?>'),
    datasets: [{
      backgroundColor: colors,
      data: JSON.parse('<?= $resultChoices[3]; ?>')
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

</div>
</div>

</div><!--div#wrap-->
<style>

</style>
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
