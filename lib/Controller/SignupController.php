<?php

namespace MyApp\Controller;

class SignupController extends \MyApp\Controller {
  public function run(){
    if($this->isLoggedIn()){
      header('Location:'.SITE_URL);
      exit;
    }
    if($_SERVER['REQUEST_METHOD']==='POST'){
      $this->postProcess();
    }
  }

  private function postProcess(){
    try{
      $this->_validate();
    }catch(\MyApp\Exception\InvalidEmail $e){
      $this->setErrors('email',$e->getMessage());
    }catch(\MyApp\Exception\InvalidPassword $e){
      $this->setErrors('email',$e->getMessage());
    }catch(\MyApp\Exception\InvalidUserName $e){
      $this->setErrors('userName',$e->getMessage());
    }

    if($this->hasError()){
      return;
    }else{
      try{
        $userModel = new \MyApp\Model\UserModel();
        $userModel->create(['email'=>$_POST['email'],'password'=>$_POST['password'],'userName'=>$_POST['userName']]);
      }catch(\MyApp\Exception\DuplicateEmail $e){
        $this->setErrors('email',$e->getMessage());
        return;
      }
      header('Location:'.SITE_URL . '/login.php');
      exit;
    }
    $this->setValues('email',$_POST['email']);
  }

  private function _validate(){
    if(!isset($_SESSION['token'])||!isset($_POST['token'])||$_SESSION['token']!==$_POST['token']){
      echo "invalid token!";
      exit;
    }

    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      throw new \MyApp\Exception\InvalidEmail();
    }

    if(!preg_match('/\A[0-9A-Za-z]+\z/',$_POST['password'])){
      throw new \MyApp\Exception\InvalidPassword();
    }

    if(!isset($_POST['userName'])||empty($_POST['userName'])){
      throw new \MyApp\Exception\InvalidUserName();
    }
  }
}
