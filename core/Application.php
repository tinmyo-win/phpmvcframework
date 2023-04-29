<?php

namespace app\core;

use app\controllers\Controller;
use app\core\db\Database;
use app\core\db\DbModel;
use Exception;

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
  public $view;

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
    $this->view = new View();

    $primaryValue = $this->session->get('user');
    if($primaryValue) {
      $primaryKey = $this->userClass::primaryKey();
      $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
    }
  }

  public static function isGuest() {
    return !self::$app->user;
  }

  public function run() {
    try {
      echo $this->router->resolve();
    } catch (Exception $e) {
      $this->response->setStatusCode($e->getCode());
      echo $this->view->renderView('_error', [
        'exception' => $e,
      ]);
    }
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