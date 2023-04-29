<?php

namespace app\core\form;

use app\models\Model;

class Field extends BaseField
{
  public $model;
  public $attribute;
  public $type;

  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_NUMBER = 'number';

  public function __construct(Model $model, $attribute)
  {
    $this->type = self::TYPE_TEXT;
    parent::__construct($model, $attribute);
  }

  public function passwordField() {
    $this->type = self::TYPE_PASSWORD;
    return $this;
  }

  public function renderInput(): string
  {

    return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">',
      $this->type,
      $this->attribute,
      $this->model->{$this->attribute},
      $this->model->hasError($this->attribute) ? 'is-invalid' : '',
  );
  }
}