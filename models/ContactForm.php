<?php

namespace app\models;

use app\models\Model;

class ContactForm extends Model
{
  public $subject = "";
  public $body = "";

  public function rules(): array
  {
    return [
      "subject" => [self::RULE_REQUIRED],
      "body" => [self::RULE_REQUIRED],

    ];
  }

  public function labels(): array
  {
    return [
      "subject" => "Enter your subject",
      "body" => "Body",
    ];
  }

  public function send()
  {
    return true;
  }
}