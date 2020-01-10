<?php
namespace MyApp\Model;

class QuestAnswerModel extends \MyApp\Model{

  public function checkGetCode($code){
    $sql = sprintf('select id from quests where  code = "%s"',$code);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    if($stmt -> fetchColumn() === false){
      header('Location:'.SITE_URL);
    }
  }

  public function find($code){
    $sql = sprintf('select * from quests where  code = "%s"',$code);
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
    $sql = sprintf('SELECT id,numberOfResponses FROM quests WHERE code = "%s"',$values["code"]);
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

  public function findResultChoices($code){
    //選択肢を取得
    $sql = sprintf('select choicesList,numberOfResponses from quests where code = "%s"',$code);
    $stmt=$this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $result= $stmt->fetch();
    $choicesListText = $result->choicesList;
    $choicesListArray = explode(',',$choicesListText);

    $numberOfResponses = $result->numberOfResponses;

    foreach($choicesListArray as $choice){
      $sql = sprintf('select count(choice) from answers where code = "%s" AND choice = "%s"',$code,$choice);
      $stmt = $this->db->query($sql);
      $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
       $votes[] =  $stmt->fetchColumn();
    }


    foreach($choicesListArray as $choice){
      $sql = sprintf('select count(choice) from answers where code = "%s" AND choice = "%s" AND sex = "%s"',$code,$choice,'男');
      $stmt = $this->db->query($sql);
      $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
      $manVotes[] =  $stmt->fetchColumn();
    }

    foreach($choicesListArray as $choice){
      $sql = sprintf('select count(choice) from answers where code = "%s" AND choice = "%s" AND sex = "%s"',$code,$choice,'女');
      $stmt = $this->db->query($sql);
      $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
      $womanVotes[] =  $stmt->fetchColumn();
    }

    $ages = [00,10,20,30,40,50,60,70];
  foreach($choicesListArray as $choice){
    foreach($ages as $age){
        $sql = sprintf('select count(choice) from answers where code = "%s" AND choice = "%s" AND age = "%d"',$code,$choice,$age);
        $stmt = $this->db->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
        $array[] =  $stmt->fetchColumn();
      }
      $ageVotes[$choice] = $array;
      $array=[];
    }

    return [
      json_encode($choicesListArray),
      json_encode($votes),
      json_encode($manVotes),
      json_encode($womanVotes),
      json_encode($ageVotes),
    ];
  }
}
