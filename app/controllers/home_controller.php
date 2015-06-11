<?php

class HomeController extends BaseController{


  public static function index(){
      View::make('home.html');
  }

  public static function login(){
    $params = $_POST;
	Kint::dump($_POST);
    $user = Useeer::authenticate($params['username'], $params['password']);
    Kint::dump($user);

    if(!$user){
      View::make('home.html', array('error' => 'Wrong password or username!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->user_id;
      Redirect::to('/chores', array('message' => 'Welcome back ' . $user->username . '!'));
    }
  }


}

