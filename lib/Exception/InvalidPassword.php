<?php
//パスワード用のExceptionクラスの作成
namespace MyApp\Exception;

class InvalidPassword extends \Exception {
  protected $message = 'Invalid Password!';
}
