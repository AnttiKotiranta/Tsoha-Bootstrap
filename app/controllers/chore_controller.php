<?php

class ChoreController extends BaseController{

  public static function index(){
   $user = parent::get_user_logged_in();
    $chores = Chore::all($user->user_id);
    View::make('chore/index.html', array('chores' => $chores));
  }

  public static function store(){
    $user = parent::get_user_logged_in();
    $params = $_POST;
    $attributes = array(
        'useeer_id' => $user->user_id,
       'name' => $params['name'],
      'priority' => $params['priority'],
      'deadline' => $params['deadline'],
      'description' => $params['description']
    );

   //validation
   $v = new Valitron\Validator($attributes);
   self::add_rules($v);
   if($v->validate()){
	$chore = new Chore($attributes);
	$chore->save();
  	Redirect::to('/chores', array('message' => 'Chore added!')); 
   }else{
	$errors = array();
	foreach($v->errors() as $error){
          foreach($error as $e){
			 $errors[]=$e;
		 }
     }
	//Kint::dump($attributes);
	View::make('/chore/index.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }


 public static function edit($id){
	$user = parent::get_user_logged_in();
    $chore = Chore::find($id, $user);
    View::make('/chore/edit.html', array('attributes' => $chore));
 }

 public static function update($id){
	$user = parent::get_user_logged_in();
    $params = $_POST;
    Kint::dump($params);
    $attributes = array(
	'id' => $id,
	'useeer_id' => $user->user_id,
	'name' => $params['name'],
   	'priority' => $params['priority'],
      	'deadline' => $params['deadline'],
      	'description' => $params['description'],
	'done' => $params['done']
    	);

   $v = new Valitron\Validator($attributes);
   self::add_rules($v);
   if ($v->validate()){
	//if validation is ok:
	$chore = new Chore($attributes);
	$chore->update();
	Kint::dump($chore);
	Redirect::to('/chores', array('message' => 'Chore updated!'));
   }else{
	//if validation fails:
	 Kint::dump($attributes);
	 View::make('/chores/edit.html', array('errors' => $v->errors(), 'attributes' => $attributes));
   }
 }

 //public static function view($id){
  //lisätään kun edit.html sivu on tehty, eli sovelluksessa ei ole erillistä choren näyttösivua vaan pelkästään edit sivu. 
  //$game = Chore::find($id)
  //View:make('chore/edit.html', array('chore' => $chore));
 //}

 public static function destroy($id){
  $chore = new Chore(array('id' => $id));
  $chore->destroy();
  Redirect::to('/chore', array('message' => 'Chore deleted.'));
 }


//Validation rules
  private function add_rules($v){
	$v->rule('required', 'useeer_id');
    $v->rule('required', 'name');
    $v->rule('required', 'priority');
    $v->rule('lengthMax', 'name', 40);
    $v->rule('lengthMax','description', 100);
    $v->rule('integer','priority');
    $v->rule('min','priority',1);
    $v->rule('max','priority',6);
    $v->rule('date', 'deadline');
  }





}
