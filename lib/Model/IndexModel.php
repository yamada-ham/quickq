<?php
namespace MyApp\Model;
class IndexModel extends \MyApp\Model{
  public function findLimit5(){
    $stmt = $this->db->query("select code,questTitle from quests order by id desc Limit 5");
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt -> fetchAll();
  }
}
