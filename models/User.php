<?php

namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
  const STATUS_INACTIVE = 0;
  const STATUS_ACTIVE = 1;
  const STATUS_DELETED = 2;

  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $passwordConfirm;
  public $status = self::STATUS_INACTIVE;

  public function save() {
    $this->status = self::STATUS_INACTIVE;
    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    return parent::save();
  }

  public function rules(): array
  {
    return [
      "firstname" => [self::RULE_REQUIRED],
      "lastname" => [self::RULE_REQUIRED],
      "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
      "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
      "passwordConfirm" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]]

    ];
  }

  public static function tableName(): string
  {
    return 'users';
  }

  public static function primaryKey(): string
  {
    return 'id';
  }

  public function attributes(): array
  {
    return ['firstname', 'lastname', 'email', 'password', 'status'];
  }

  public function labels(): array
  {
    return [
      'firstname' => 'First name',
      'lastname' => 'Last name',
      'email' => 'Email',
      'password' => 'Password',
      'status' => 'Status',
      'passwordConfirm' => 'Password Confirm'
    ];
  }

  public function getDisplayName(): string
  {
    return $this->firstname . " " . $this->lastname;
  }
}