<?php

namespace MyApp\Controller;

class QuestAnswer extends \MyApp\Controller {
  private $_questModel;

  public function run($code) {
    $this->_questModel = new \MyApp\Model\QuestAnswerModel();

      $this->_questModel->checkGetCode();
    $this->setValues('quest',$this->_questModel->find());

      $this->setValues('resultChoices',$this->_questModel->findResultChoices($code));

     if($_SERVER['REQUEST_METHOD']==='POST'){
          $this->postProcess();
      }
  }

  private function postProcess(){
    try{
      $this->_validate();
    }catch(\MyApp\Exception\InvalidAnswer $e){
      $this->setErrors('answer',$e->getMessage());
    }
    if($this->hasError()){
      return;
    }else{
      try{
        $this->_questModel->answer([
          'code'=>$_GET['code'],
          'age'=>$_POST['age'],
          'sex'=>$_POST['sex'],
          'questTitle'=>$_POST['questTitle'],
          'choice'=>$_POST['choice'],
          'remote_addr'=>$_SERVER['REMOTE_ADDR'],
          'user_agent'=>$_SERVER['HTTP_USER_AGENT']
      ]);
    }catch(\MyApp\Exception\CannotAnswerQuest $e){
        $this->setErrors('answer',$e->getMessage());
        return;
      }
    }
  }

  private function _validate(){
    if(!isset($_SESSION['token'])||!isset($_POST['token'])||$_SESSION['token']!==$_POST['token']){
      echo "invalid token!";
      exit;
    }
    if(!isset($_GET['code'])||empty($_GET['code'])){
      throw new \MyApp\Exception\InvalidAnswer();
    }

    if(!isset($_POST['age'])||empty($_POST['age'])){
      throw new \MyApp\Exception\InvalidAnswer();
    }

    if(!isset($_POST['sex'])||empty($_POST['sex'])){
      throw new \MyApp\Exception\InvalidAnswer();
    }

    if(!isset($_SERVER['REMOTE_ADDR'])||empty($_SERVER['REMOTE_ADDR'])){
      throw new \MyApp\Exception\InvalidAnswer();
    }
    if(!isset($_SERVER['HTTP_USER_AGENT'])||empty($_SERVER['HTTP_USER_AGENT'])){
      throw new \MyApp\Exception\InvalidAnswer();
    }
  }

  public function checkAnswer($code){
    if($this->_questModel->isAnswered($code,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT'])){
      return true;
    }
  }
}
