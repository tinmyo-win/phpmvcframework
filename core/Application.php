<?php

namespace app\core;

use app\controllers\Controller;

class Application
{

  public $userClass;
  public $request;
  public $router;
  public $response;
  public $controller;
  public $db;
  public $session;

  public static $ROOT_DIR;
  public static $app;
  public $user;

  public function __construct($rootPath, array $config) {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->controller = new Controller();
    $this->router = new Router($this->request, $this->response);
    $this->db = new Database($config['db']);
    $this->session = new Session();
    $this->userClass = $config['userClass'];

    $primaryValue = $this->session->get('user');
    if($primaryValue) {
      $primaryKey = $this->userClass::primaryKey();
      $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
    }
  }

  public function isGuest() {
    return !self::$app->user;
  }

  public function run() {
    echo $this->router->resolve();
  }

  public function login(DbModel $user) {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    $this->session->set('user', $primaryValue);

    return true;
  }

  public function logout() {
    $this->user = null;
    $this->session->remove('user');
  }
}