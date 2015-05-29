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

 public static function view($id){
  //lisätään kun edit.html sivu on tehty, eli sovelluksessa ei ole erillistä choren näyttösivua vaan pelkästään edit sivu. 
  //$game = Chore::find($id)
  //View:make('chore/edit.html', array('chore' => $chore));
 }







}
