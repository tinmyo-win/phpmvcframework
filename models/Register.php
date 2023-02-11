<?php

namespace app\models;

class Register extends Model
{
  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $passwordConfirm;

  public function register() {
    echo "Creating new User";
  }

  public function rules(): array
  {
    return [
      "firstname" => [self::RULE_REQUIRED],
      "lastname" => [self::RULE_REQUIRED],
      "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
      "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
      "passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]]

    ];
  }
}