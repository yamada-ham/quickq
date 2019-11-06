<?php
namespace MyApp\Model;
class UserQuestsModel extends \MyApp\Model{
  public function findUserAccount($id){
    $sql = sprintf('select * from quests where userId = "%s" order by id desc',$id);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt -> fetchAll();
  }
}
