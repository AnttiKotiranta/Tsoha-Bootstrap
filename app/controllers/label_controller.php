<?php

class LabelController extends BaseController{

  public static function index(){
    $user = parent::get_user_logged_in();
    $labels = Label::all($user->user_id);
    View::make('label/index.html', array('labels' => $labels));
  }

 public static function view($id){
    $user = parent::get_user_logged_in();
    $label = Label::find($id, $user);
    View::make('/label/view.html', array('attributes' => $label));
 }

  public static function store(){
    $user = parent::get_user_logged_in();
    $params = $_POST;
    $attributes = array(
        'useeer_id' => $user->user_id,
       'name' => $params['name'],
      'description' => $params['description']
    );

   //validation
   $v = new Valitron\Validator($attributes);
   self::add_rules($v);
   if($v->validate()){
	$label = new Label($attributes);
	$label->save();
  	Redirect::to('/labels', array('message' => 'Label added!')); 
   }else{
	$errors = array();
	foreach($v->errors() as $error){
          foreach($error as $e){
			 $errors[]=$e;
		 }
     }
	$labels = Label::all($user->user_id);
	View::make('/label/index.html', array('errors' => $errors,'labels' =>$labels, 'attributes' => $attributes));
    }
  }

 public static function update($id){
    $user = parent::get_user_logged_in();
    $params = $_POST;
    $attributes = array(
	'id' => $id,
	'useeer_id' => $user->user_id,
	'name' => $params['name'],
      	'description' => $params['description'],
    	);
   //validation
   $v = new Valitron\Validator($attributes);
   self::add_rules($v);
   if ($v->validate()){
	//if validation is ok:
	$label = new Label($attributes);
	$label->update();
	Redirect::to('/labels', array('message' => 'Label updated!'));
   }else{
	$errors = array();
	foreach($v->errors() as $error){
          foreach($error as $e){
			 $errors[]=$e;
		 }
     }
	 View::make('/label/view.html', array('errors' => $errors, 'attributes' => $attributes));
   }
 }

 public static function destroy($id){
  $label = new Label(array('id' => $id));
  $label->destroy();
  Redirect::to('/labels', array('message' => 'Label deleted.'));
 }

//Validation rules
  private function add_rules($v){
    $v->rule('required', 'useeer_id');
    $v->rule('required', 'name');
    $v->rule('lengthMax', 'name', 40);
    $v->rule('lengthMax','description', 100);
  }

}
