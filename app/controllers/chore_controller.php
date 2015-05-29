<?php

class ChoreController extends BaseController{

  public static function index(){
    $games = Chore::all();
    View::make('chore/index.html', array('chores' => $chores));
  }

  public static function store(){
    $params = $_POST;

    $chore = new Chore(array(
      'name' => $params['name'],
      'priority' => $params['priority'],
      'deadline' => $params['deadline'],
      'description' => $params['description']
    ));
    Kint::dump($params);
    $chore->save();

    //Redirect::to('/chore/' . $chore->id, array('message' => 'Chore added!'));
  }


 }





}
