<?php

namespace MyApp\Exception;

class CannotAnswerQuest extends \Exception {
  protected $message = 'アンケートに回答できません(Can not Answer Quest)';
}
