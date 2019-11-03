<?php

namespace MyApp\Controller;

class CategoryController extends \MyApp\Controller {

  public function run() {
    $questModel = new \MyApp\Model\CategoryModel();
    // $this->setValues('category',$questModel->findCategory());
    $this->setValues('pageRecords',$questModel->findPage());
    $this->setValues('maxpage',$questModel->findPageCount());

  }
}
