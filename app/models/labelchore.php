<?php 


class LabelChores extends BaseModel{

public $chore_id, $label_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

 public static function find_chores($id){
   $query = DB::connection()->prepare('SELECT * FROM LabelChores WHERE chore_id = :chore_id');
    $query->execute(array('chore_id' => $id));
    $rows = $query->fetch();
    $lc = array();
    if($rows){
    foreach($rows as $row){
	$lc = new LabelChore(array(
		'chore_id' => $row['chore_id'],
		'label_id' => $row['label_id']
		));
     }
	return $lc;
    }
    return null;
 }

 public static function find($chore, $label){
   $query = DB::connection()->prepare('SELECT * FROM LabelChores WHERE chore_id = :chore_id and label_id = :label_id');
    $query->execute(array('chore_id' => $chore->id, 'label_id' => $label->id));
    $rows = $query->fetch();
    $lc = array();
    if($rows){
    foreach($rows as $row){
	$lc = new LabelChore(array(
		'chore_id' => $row['chore_id'],
		'label_id' => $row['label_id']
		));
     }
	return $lc;
    }
    return null;
 }

  public function save($chore, $label){
    $query = DB::connection()->prepare('INSERT INTO LabelChores (chore_id, label_id) VALUES (:chore_id, :label_id)');
    $query->execute(array('chore_id' => $chore->id, 'label_id' => $label->id));
  }
}

