<?php

namespace MyApp\Exception;

class InvalidAnswer extends \Exception {
  protected $message = '未入力の欄があります(Invalid Answer)';
}
