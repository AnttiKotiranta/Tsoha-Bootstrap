<?php

class Label extends BaseModel{

 public $id, $useeer_id, $name, $description, $chores;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

 public static function all($useeer_id){
    $query = DB::connection()->prepare('SELECT * FROM Label WHERE useeer_id = :useeer_id');
    $query->execute(array('useeer_id' => $useeer_id));
    $rows = $query->fetchAll();
    $labels = array();

    foreach($rows as $row){
      $labels[] = new Label(array(
		'id' => $row['id'],
		'useeer_id' => $row['useeer_id'],
		'name'  => $row['name'],
		'description' => $row['description']
		));
    }
    return $labels;
  }

  public static function find($id, $user){
    $query = DB::connection()->prepare('SELECT * FROM Label WHERE id = :id AND useeer_id = :useeer_id LIMIT 1');
    $query->execute(array('id' => $id, 'useeer_id' => $user->user_id));
    $row = $query->fetch();

    if($row){
	$label = new Label(array(
		'id' => $row['id'],
		'useeer_id' => $row['useeer_id'],
		'name'  => $row['name'],
		'description' => $row['description']
		));
	return $label;
    }
    return null;
  }

  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Label (useeer_id, name, description) VALUES (:useeer_id, :name, :description)');
    $query->execute(array('useeer_id' => $this->useeer_id, 'name' => $this->name, 'description' => $this->description));
  }

  public function update(){
    $query = DB::connection()->prepare('UPDATE Label SET name = :name, description = :description WHERE id = :id');
    $query->execute(array('id' => $this->id,  'name' => $this->name, 'description' => $this->description));
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Label WHERE id = :id');
    $query->execute(array('id' => $this->id));
  }

}
