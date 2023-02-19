<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
  public function login(Request $request) {
    if($request->isPost()) {
      return "Handle log in";
    }

    $this->setLayout('auth');
    return $this->render('login');
  }

  public function register(Request $request) {
    $user = new User;
    if($request->isPost()) {
      $data = $request->getBody();
      $user->loadData($data);

      if($user->validate() && $user->save()) {
        Application::$app->session->setFlash("success", "Thanks for registering");
        Application::$app->response->redirect("/");
        exit;
      }

      return $this->render('register', [
        'model' => $user
      ]);
    }

    $this->setLayout('auth');

    return $this->render('register', [
      'model' => $user,
    ]);
  }
}