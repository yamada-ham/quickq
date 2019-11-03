<?php
namespace MyApp\Model;

class QuestAnswerModel extends \MyApp\Model{

  public function checkGetCode(){
    $sql = sprintf('select id from quests where  code = "%s"',h($_GET['code']));
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    if($stmt -> fetchColumn() === false){
      header('Location:'.SITE_URL);
    }
  }

  public function find(){
    $sql = sprintf('select * from quests where  code = "%s"',h($_GET['code']));
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt -> fetch();
  }

  public function answer($values){
    $sql = "insert into answers (code,age,sex,questTitle,choice,remote_addr,user_agent,created) values(:code,:age,:sex,:questTitle,:choice,:remote_addr,:user_agent,now())";
    $stmt=$this->db->prepare($sql);

    $stmt->bindValue(':code',$values['code'],\PDO::PARAM_STR);
    $stmt->bindValue(':age',$values['age'],\PDO::PARAM_STR);
    $stmt->bindValue(':sex',$values['sex'],\PDO::PARAM_STR);
    $stmt->bindValue(':questTitle',$values['questTitle'],\PDO::PARAM_STR);
    $stmt->bindValue(':choice',$values['choice'],\PDO::PARAM_STR);
    $stmt->bindValue(':remote_addr',$values['remote_addr'] , \PDO::PARAM_STR);
    $stmt->bindValue(':user_agent',$values['user_agent'],\PDO::PARAM_STR);
    $res = $stmt->execute();

    if($res === false){
      throw new \MyApp\Exception\CannotAnswerQuest();
    }
    $sql = sprintf('SELECT id,numberOfResponses from quests where code = %d',$values['code']);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $record = $stmt -> fetch();

    $numberOfResponses = ++$record->numberOfResponses;

    $sql = sprintf('UPDATE quests set numberOfResponses = %d where id =%d ',$numberOfResponses,$record->id);
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
  }

  //回答していればtrue していなければfalseを返す
  public function isAnswered($code,$remote_addr,$http_user_agent){
    $sql = sprintf('select COUNT(code),  COUNT(remote_addr),  COUNT(user_agent),user_agent from answers where code = "%s" and remote_addr = "%s" and user_agent = "%s"' ,$code,$remote_addr,$http_user_agent);
    $stmt=$this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    if($stmt->fetchColumn(0) > 0||$stmt->fetchColumn(1)>0||$stmt->fetchColumn(2)){
      return true;
    }
  }
}
