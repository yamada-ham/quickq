<?php

namespace MyApp\Controller;

class UserAccountInfoChangeController extends \MyApp\Controller {

  public function run($id) {
    if(!$this->isLoggedIn()){
      header('Location:'.SITE_URL.'/login.php');
      exit;
    }
    $userModel =  new \MyApp\Model\UserAccountInfoChangeModel();
    $this->setValues('userData',$userModel->findUserAccount($id));

    if($_SERVER['REQUEST_METHOD']==='POST'){
      $this->postProcess($id);
    }
  }

  private function postProcess($id){
    try{
      $this->_validate();
    }catch(\Myapp\Exception\InvalidUserAccountInfoChange $e){
      $this->setErrors('InvalidChange',$e->getMessage());
    }
    if($this->hasError()){
      return;
    }else{
      try{
        $userModel = new \MyApp\Model\UserAccountInfoChangeModel();
        $userModel->update($id,['userName'=>$_POST['userName'],'email'=>$_POST['email']]);
      }catch(\MyApp\Exception\CannotUpdateAccountInfo $e){
        $this->setErrors('CannotUpdateAccount',$e->getMessage());
        return;
      }
    }
  }

  private function _validate(){
    if(!isset($_SESSION['token'])||!isset($_POST['token'])||$_SESSION['token']!==$_POST['token']){
      echo "invalid token!";
      exit;
    }
    if(!isset($_POST['userName'])||empty($_POST['userName'])){
      throw new \MyApp\Exception\InvalidUserAccountInfoChange();
    }

    if(!isset($_POST['email'])||empty($_POST['email'])){
      throw new \MyApp\Exception\InvalidUserAccountInfoChange();
    }
  }
}
