<?php
namespace MyApp\Model;
class QuestAnalysisModel extends \MyApp\Model{

  public function checkGetCode(){
    $sql = sprintf('select id from quests where  code = "%s"',h($_GET['code']));
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    if($stmt -> fetchColumn() === false){
      header('Location:'.SITE_URL);
    }
  }

  public function findUserAccount($id){
    $sql = sprintf('select * from quests where userId = "%s" order by id desc',$id);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt -> fetchAll();
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
  public function getQuestTitle(){
    $sql = sprintf('SELECT questTitle FROM quests WHERE code = "%s"',$_GET["code"]);
    $stmt = $this->db->query($sql);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    return $stmt->fetchColumn();
  }
}
