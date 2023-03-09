<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
  public function login(Request $request, Response $response) {
    $loginForm = new LoginForm();
    if($request->isPost()) {
      $data = $request->getBody();
      $loginForm->loadData($data);

      if($loginForm->validate() && $loginForm->login()) {
        $response->redirect('/');
        return;
      }
    }

    $this->setLayout('auth');
    return $this->render('login', [
      'model' => $loginForm,
    ]);
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

  public function logout(Request $request, Response $response) {
    Application::$app->logout();
    $response->redirect('/');
  }
}