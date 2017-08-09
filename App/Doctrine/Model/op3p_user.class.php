<?php
namespace App\Model;
	
use \stdClass;
use \PDO;

class Spell_user extends \Spell\base\model {
	public $user_int_id = null;
	public $user_vrc_name = null;
	public $user_vrc_email = null;
	public $user_vrb_password = null;
	
	public function columns(){
		$f = new \stdClass();
		$f->user_int_id = ['user_int_id', 10, 'not_null', 'int'];
		$f->user_vrc_name = ['user_vrc_name', 255, 'not_null', 'varchar'];
		$f->user_vrc_email = ['user_vrc_email', 255, 'not_null', 'varchar'];
		$f->user_vrb_password = ['user_vrb_password', 1000, 'not_null', 'varbinary'];
		return $f;
	}
	
	public function tableName(){
		return 'Spell_user';
	}
	
	public function setID($id){
		$this->user_int_id = $id;
	}
	
	public function primaryKey(){
		return 'user_int_id';
	}
}