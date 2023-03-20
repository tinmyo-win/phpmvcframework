<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\exceptions\ForbbidenException;
use app\core\middlewares\BaseMiddleware;

class AuthMiddleware extends BaseMiddleware
{
  public $actions = [];

  public function __construct(array $actions = [])
  {
    $this->actions = $actions;
  }

  public function execute()
  {
    if(Application::isGuest()) {
      if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
        throw new ForbbidenException();
      }
    }
  }
}