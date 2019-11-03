<?php

namespace MyApp\Exception;

//ユーザー作成失敗
class DuplicateEmail extends \Exception {
  protected $message = 'Duplicate Email!';
}
