<?php

namespace app\controllers;

use app\core\Application;
use app\core\middlewares\AuthMiddleware;
use app\models\ContactForm;
use app\core\Request;
use app\core\Response;

class SiteController extends Controller
{
  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['home']));
  }
  public function home() {
    $params = [
      'name' => 'Home Page',
    ];

    return $this->render('home', $params);
  }

  public function contact(Request $request, Response $response) {
    $contact = new ContactForm();

    if($request->isPost()) {
      $contact->loadData($request->getBody());

      if($contact->validate() && $contact->send()) {
        Application::$app->session->setFlash('success', 'Thanks for contacting us.');
        return $response->redirect('/contact'); 
      }
    }
    return $this->render('contact', [
      'model' => $contact,
    ]);
  }
}