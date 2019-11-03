<?php
//ユーザー名用のExceptionクラスの作成
namespace MyApp\Exception;

class InvalidUserName extends \Exception {
  protected $message = 'Invalid User Name!';
}
