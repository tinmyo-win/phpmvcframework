<?php

namespace app\controllers;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class Controller 
{
  public $layout = 'main';
  public $action = '';

  protected $middlewares = [];

  public function render($view, $params = []) {
    return Application::$app->view->renderView($view, $params);
  }

  public function setLayout($layout) {
    $this->layout = $layout;
  }

  public function registerMiddleware(BaseMiddleware $middleware) {
    $this->middlewares[] = $middleware;
  }

  public function getMiddlewares() {
    return $this->middlewares;
  }
}