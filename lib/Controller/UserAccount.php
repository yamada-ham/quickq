<?php

namespace MyApp\Controller;

class UserAccount extends \MyApp\Controller {

  public function run($id) {
    if(!$this->isLoggedIn()){
      header('Location:'.SITE_URL.'/login.php');
      exit;
    }
    $questModel =  new \MyApp\Model\UserAccountModel();
    $this->setValues('userQuests',$questModel->findUserAccount($id));
  }

  public function dateFormat($date){
    $dateTime = new \DateTime($date);
    return $dateTime->format('Y年m月d日');
  }
}
