<?php

namespace app\controllers;

use app\core\Request;
use app\models\Register;

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
    $register = new Register;
    if($request->isPost()) {
      $data = $request->getBody();
      $register->loadData($data);

      if($register->validate() && $register->register()) {
        return "Success";
      }

      return $this->render('register', [
        'model' => $register
      ]);
    }

    $this->setLayout('auth');

    return $this->render('register', [
      'model' => $register,
    ]);
  }
}