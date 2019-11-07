<?php

namespace MyApp\Exception;

class CannotUpdateAccountInfo extends \Exception {
  protected $message = 'アカウント情報を変更できません(Can not update account info)';
}
