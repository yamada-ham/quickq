<?php
namespace MyApp\Controller;

class CreateQuestController extends \MyApp\Controller {
  public function run(){
    if(!$this->isLoggedIn()){
      header('Location:'.SITE_URL.'/login.php');
      exit;
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $this->postProcess();
    }
  }

  private function postProcess(){
    try{
      $this->_validate();
    }catch(\MyApp\Exception\InvalidQuest $e){
      $this->setErrors('InvalidQuest',$e->getMessage());
    }
    if($this->hasError()){
      return;
    }else{
      try{
        $questModel = new \MyApp\Model\CreateQuestModel();
        $code = $questModel->create(['questTitle'=>$_POST['questTitle'],'choice'=>$_POST['choice'],'category'=>$_POST['category'],'userId'=>$_POST['userId']]);
      }catch(\MyApp\Exception\CannotCreateQuest $e){
        $this->setErrors('Quest',$e->getMessage());
        return;
      }
    }

    header('Location:'.SITE_URL . '/userAccount.php');
    exit;
  }

  private function _validate(){
    if(!isset($_SESSION['token'])||!isset($_POST['token'])||$_SESSION['token']!==$_POST['token']){
      echo "invalid token!";
      exit;
    }

    if(!isset($_POST['questTitle'])||empty($_POST['questTitle'])){
      throw new \MyApp\Exception\InvalidQuest();
    }


    if(!isset($_POST['choice'])||empty($_POST['choice'])){
      throw new \MyApp\Exception\InvalidQuest();
    }

    foreach($_POST['choice'] as $val){
      if($val === ''){
        throw new \MyApp\Exception\InvalidQuest();
      }
    }

    if(!isset($_POST['category'])||empty($_POST['category'])){
      throw new \MyApp\Exception\InvalidQuest();
    }

    if(!isset($_POST['userId'])||empty($_POST['userId'])){
      throw new \MyApp\Exception\InvalidQuest();
    }
  }
}
?>
