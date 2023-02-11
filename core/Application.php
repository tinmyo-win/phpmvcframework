<?php

namespace app\core;

use app\controllers\Controller;

class Application
{

  public $request;
  public $router;
  public $response;
  public $controller;
  public $db;

  public static $ROOT_DIR;
  public static $app;

  public function __construct($rootPath, array $config) {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->controller = new Controller();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database($config['db']);
  }

  public function run() {
    echo $this->router->resolve();
  }
}