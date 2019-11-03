<?php
namespace MyApp\Model;

class CategoryModel extends \MyApp\Model{
  public function findPage(){
    if (isset($_GET['page'])) {
      $page = (int)$_GET['page'];
    } else {
      $page = 1;
    }
    if ($page > 1) {
      $start = ($page * 10) - 10;
    } else {
      $start = 0;
    }
    $category = $_GET['category'];
    $sql = "select * from quests where category ='{$category}' LIMIT {$start} ,10";
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt->fetchAll();
  }
  public function findPageCount(){
    $category = $_GET['category'];
    $sql = sprintf("SELECT COUNT(*) id FROM quests where category = '%s'",$category);
    $page_num = $this->db->query($sql);
    $page_num = $page_num->fetchColumn();

      $maxpage = ceil($page_num / 10);
      return $maxpage;
  }

}
