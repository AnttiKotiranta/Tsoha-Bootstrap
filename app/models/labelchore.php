<?php 


class LabelChores extends BaseModel{

public $chore_id, $label_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

//function searches LabelChores with given id, then searches and returns labels where the label_id was found from labels. Pretty clear, isn't it?
 public static function find_chore_labels($chore_id){
   $query = DB::connection()->prepare('SELECT label.id FROM Label WHERE label.id IN (select labelchores.Label_id from LabelChores where labelchores.Chore_id = :chore_id)');
    $query->execute(array('chore_id'=> $chore_id));
    $rows = $query->fetchAll();
    $labels = array();

  if($rows){
    foreach($rows as $row){
	$labels[] = Label::find_id($row['id']);
     }
	return $labels;
  }
    return null;
 }

  public static function find_by_chore_id($cid){
 $query = DB::connection()->prepare('select * from labelchores where chore_id=:cid');
    $query->execute(array('cid' =>$cid));
       $rows = $query->fetchAll();
	Kint::dump($rows);
    $labels = array();
  if($rows){
    foreach($rows as $row){
	$labels[] = new LabelChores(array(
		'chore_id' => $row['chore_id'],
		'label_id' => $row['label_id']
	));
     }
    return $labels;
  } 
   return null;
 }


 public static function find($chore, $label){
   $query = DB::connection()->prepare('SELECT * FROM LabelChores WHERE chore_id = :chore_id and label_id = :label_id');
    $query->execute(array('chore_id' => $chore, 'label_id' => $label));
    $rows = $query->fetch();
    $lc = array();
    if($rows){
    foreach($rows as $row){
	$lc = new LabelChores(array(
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
    $query->execute(array('chore_id' => $chore, 'label_id' => $label));
  }

  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM LabelChores WHERE chore_id = :chore_id and label_id = :label_id');
    $query->execute(array('chore_id' => $this->chore_id, 'label_id' => $this->label_id));
  }
}

