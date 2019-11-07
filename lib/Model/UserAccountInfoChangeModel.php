<?php
namespace MyApp\Model;
class UserAccountInfoChangeModel extends \MyApp\Model{
  public function findUserAccount($id){
    $sql = sprintf('select * from users where id = "%s"',$id);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt -> fetch();
  }
  public function update($id,$values){
    $sql = sprintf('UPDATE users SET userName = "%s",email="%s" WHERE id = %d',$values['userName'],$values['email'],$id);
    $stmt = $this->db->prepare($sql);
    $res = $stmt->execute();
    if($res === false){
      throw new \MyApp\Exception\CannotUpdateAccountInfo();
    }
  }
}
