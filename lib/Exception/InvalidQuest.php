<?php
//アンケート方式用のExceptionクラスの作成
namespace MyApp\Exception;

class InvalidQuest extends \Exception {
  protected $message = '正しく入力してください(Invalid Quest)';
}
