<?php

namespace MyApp\Controller;

class QuestAnalysisController extends \MyApp\Controller {

  public function run($id,$code) {
    if(!$this->isLoggedIn()){
      header('Location:'.SITE_URL.'/login.php');
      exit;
    }
    $questAnalysisModel =  new \MyApp\Model\QuestAnalysisModel();
    $questAnalysisModel->checkGetCode();
    $this->setValues('userQuests',$questAnalysisModel->findUserAccount($id));
    $this->setValues('resultChoices',$questAnalysisModel->findResultChoices($code));
  }

  public function dateFormat($date){
    $dateTime = new \DateTime($date);
    return $dateTime->format('Y年m月d日');
  }
}
