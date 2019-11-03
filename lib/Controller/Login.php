<?php
namespace MyApp\Controller;

class Login extends \MyApp\Controller {
  public function run(){
    if($this->isloggedIn()){
      header('Location:'.SITE_URL);
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
      $this->postProcess();
    }
  }

  protected function postProcess(){
    try{
      $this->_validate();
    }catch(\MyApp\Exception\EmptyPost $e){
      $this->setErrors('login',$e->getMessage());
    }

    $this->setValues('email',$_POST['email']);

    if($this->hasError()){
      return;
    }else{
      try{
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login(['email'=>$_POST['email'],'password' => $_POST['password']]);
      }catch(\MyApp\Exception\UnmatchEmailOrPassword $e){
        $this->setErrors('login',$e->getMessage());
        return;
      }
      session_regenerate_id(true);

      $_SESSION['me'] = $user;

      header('Location:'.SITE_URL);
      exit;
    }
  }

  protected function _validate(){
    if(!isset($_POST['token'])||!isset($_SESSION['token'])||$_POST['token']!==$_SESSION['token']){
      echo 'invalid token!';
      exit;
    }

    if(!isset($_POST['email'])||!isset($_POST['password'])){
      echo "Invalid Form!";
      exit;
    }

    if($_POST['email']===''||$_POST['password']===''){
      throw  new \MyApp\Exception\EmptyPost();
    }
  }
}
