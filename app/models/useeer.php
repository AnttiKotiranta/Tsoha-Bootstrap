<?php

class Useeer extends BaseModel{

 public $user_id, $username;
 public $pass;

  public function __construct($attributes){
    //$v = new Valitron\Validator($attributes);
    //$this->add_rules($v);
    //$v->validate();

    //Kint::dump($attributes);
    parent::__construct($attributes);
    //$this->validators = $v->errors();
  }

 public static function authenticate($username, $pass){
   
   $query = DB::connection()->prepare('SELECT * FROM Useeer WHERE username = :username AND pass = :pass LIMIT 1'); 
   $query->execute(array('username' => $username, 'pass' => $pass));
   $row = $query->fetch();
   if($row){
	$user = new Useeer(array(
		'user_id' => $row['user_id'],
		'username' => $row['username'],
		'pass' => $row['pass']
		));
  	return $user;
   }else{
  	return null;
    }
 }

 public static function find($user_id){
    $query = DB::connection()->prepare('SELECT * FROM Useeer WHERE user_id = :user_id LIMIT 1');
    $query->execute(array('user_id' => $user_id));
    $row = $query->fetch();

    if($row){
	$user = new Useeer(array(
	    'user_id' => $row['user_id'],
		'username' => $row['username'],
		'pass' => $row['pass']
		));
	return $user;
    }
    return null;
 }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Useeer (username, pass) VALUES (:username, :pass) RETURNING id');
    $query->execute(array('username' => $this->username, 'pass' => $this->pass));
    $row = $query->fetch();
    $this->id = $row['id'];
  }

}
