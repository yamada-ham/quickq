<?php
//ユーザー名用のExceptionクラスの作成
namespace MyApp\Exception;

class InvalidUserAccountInfoChange extends \Exception {
  protected $message = '入力値が不十分です。';
}
