<?php

class Chore extends BaseModel{

  public $id, $useeer_id, $name, $description, $priority, $done, $deadline;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Chore');
    $query->execute();
    $rows = $query->fetchAll();
    $chores = array();

    foreach($rows as $row){
      $chores[] = new Chore(array(
		'$id' => $row['id'],
		'$useeer_id' => $row['useeer_id'],
		'$name'  => $row['name'],
		'$description' => $row['description'],
		'$priority' => $row['priority'],
		'$done' => $row['done'],
		'$deadline' => $row['deadline']
		));
    }
    return $chores;
  }

  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Chore WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
	$chore = new Chore(array(
		'$id' => $row['id'],
		'$useeer_id' => $row['useeer_id'],
		'$name'  => $row['name'],
		'$description' => $row['description'],
		'$priority' => $row['priority'],
		'$done' => $row['done'],
		'$deadline' => $row['deadline']
		));
	return $chore;
    }
    return null;
  }
  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Chore (name, priority, deadline, description) VALUES (:name, :priority, :deadline, :description) RETURNING id');
    $query->execute(array('name' => $this->name, 'priority' => $this->priority, 'deadline' => $this->deadline, 'description' => $this->description));
    $row = $query->fetch();

    Kint::trace();   
    Kint::dump($row);
    //$this->id = $row['id'];
  }


}
