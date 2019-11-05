<?php

namespace MyApp\Controller;

class IndexController extends \MyApp\Controller {

  public function run() {
    // if(!$this->isLoggedIn()){
    //   header('Location:'.SITE_URL.'/login.php');
    //   exit;
    // }
    $questModel = new \MyApp\Model\IndexModel();
    $this->setValues('quests',$questModel->findLimit5());
  }
}
