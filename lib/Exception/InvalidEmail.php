<?php
//メアド用のExceptionクラスの作成

namespace MyApp\Exception;

class InvalidEmail extends \Exception {
  protected $message = 'Invalid Email!';
}
