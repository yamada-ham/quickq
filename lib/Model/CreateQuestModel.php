<?php
namespace MyApp\Model;

class CreateQuestModel extends \MyApp\Model{
  public function create($values){
    $stmt = $this->db->prepare("insert into quests(questTitle,choicesNum,choicesList,category,code,userId,created_at,updated_at) values(:questTitle,:choicesNum,:choicesList,:category,:code,:userId,now(),now())");

    $stmt->bindValue(':questTitle',$values['questTitle'],\PDO::PARAM_STR);

    $stmt->bindValue(':choicesNum',count($values['choice']),\PDO::PARAM_INT);

    $count = 0;
    $choiceText='';
    foreach($values['choice'] as $choice){
      $count++;
      if($choice === ''){
        continue;
      }
      $choiceText .= $choice;
      if($count !== count($values['choice'])){
        $choiceText .= ',';
      }
    }
    $choiceText;
    $stmt->bindValue(':choicesList',$choiceText,\PDO::PARAM_STR);
    $stmt->bindValue(':category',$values['category'],\PDO::PARAM_STR);

    $code = $this->createCode();
    $stmt->bindValue(':code',$code,\PDO::PARAM_STR);
    $stmt->bindValue(':userId',$values['userId'],\PDO::PARAM_STR);

    $res = $stmt->execute();

    if($res === false){
      throw new \MyApp\Exception\CannotCreateQuest();
    }
    // return $code;
  }

  private function createCode(){
    return uniqid(mt_rand(),true);
  }
}
