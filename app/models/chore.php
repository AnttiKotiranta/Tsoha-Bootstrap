<?php

class Chore extends BaseModel{

  public $id, $useeer_id, $name, $description, $priority, $done, $deadline;


  public function __construct($attributes){
    $v = new Valitron\Validator($attributes);
    $this->add_rules($v);
    $v->validate();

    //Kint::dump($attributes);
    parent::__construct($attributes);
    $this->validators = $v->errors();
  }

  public static function all($useeer_id){
    $query = DB::connection()->prepare('SELECT * FROM Chore WHERE useeer_id = :useeer_id');
    $query->execute(array('useeer_id' => $useeer_id));
    $rows = $query->fetchAll();
    $chores = array();

    foreach($rows as $row){
      $chores[] = new Chore(array(
		'id' => $row['id'],
		'useeer_id' => $row['useeer_id'],
		'name'  => $row['name'],
		'description' => $row['description'],
		'priority' => $row['priority'],
		'done' => $row['done'],
		'deadline' => $row['deadline']
		));
    }
    return $chores;
  }

  public static function find($id, $user){
    $query = DB::connection()->prepare('SELECT * FROM Chore WHERE id = :id AND useeer_id = :useeer_id LIMIT 1');
    $query->execute(array('id' => $id, 'useeer_id' => $user->user_id));
    $row = $query->fetch();

    if($row){
	$chore = new Chore(array(
		'id' => $row['id'],
		'useeer_id' => $row['useeer_id'],
		'name'  => $row['name'],
		'description' => $row['description'],
		'priority' => $row['priority'],
		'done' => $row['done'],
		'deadline' => $row['deadline']
		));
	return $chore;
    }
    return null;
  }
  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Chore (useeer_id, name, priority, deadline, description) VALUES (:useeer_id, :name, :priority, :deadline, :description) RETURNING id');
    if($this->deadline == ""){
		$this->deadline = null;
	}	
    $query->execute(array('useeer_id' => $this->useeer_id, 'name' => $this->name, 'priority' => $this->priority, 'deadline' => $this->deadline, 'description' => $this->description));
    $row = $query->fetch();

    //Kint::trace();   
    //Kint::dump($row);
    $this->id = $row['id'];
  }


  public function update(){
    $query = DB::connection()->prepare('UPDATE Chore SET name = :name, priority = :priority, deadline = :deadline, description = :description, done = :done WHERE id = :id');
    $query->execute(array('id' => $this->id,  'name' => $this->name, 'priority' => $this->priority, 'deadline' => $this->deadline, 'description' => $this->description, 'done' => $this->done));
    $row = $query->fetch();

    //Kint::trace();   
    //Kint::dump($row);
    //$this->id = $row['id'];
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Chore WHERE id = :id');
    $query->execute(array('id' => $this->id));
    

  }

//add rules to Validator
  private function add_rules($v){
    $v->rule('required', 'name');
    $v->rule('required', 'priority');
    $v->rule('required', 'useeer_id');
    $v->rule('lengthMax', 'name', 40);
    $v->rule('lengthMax','description', 100);
    $v->rule('integer','priority');
    $v->rule('min','priority',1);
    $v->rule('max','priority',6);
    $v->rule('date', 'deadline');
  }


}
