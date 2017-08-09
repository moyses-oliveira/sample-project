<?php
namespace App\Model;
	
use \stdClass;
use \PDO;

class Spell_log extends \Spell\base\model {
	public $log_bgn_id = null;
	public $log_int_user = null;
	public $log_dtt_log = null;
	public $log_vrc_url = null;
	public $log_chr_method = null;
	
	public function columns(){
		$f = new \stdClass();
		$f->log_bgn_id = ['log_bgn_id', 20, 'not_null', 'bigint'];
		$f->log_int_user = ['log_int_user', 10, 'not_null', 'int'];
		$f->log_dtt_log = ['log_dtt_log', 20, 'not_null', 'timestamp'];
		$f->log_vrc_url = ['log_vrc_url', 2048, 'not_null', 'varchar'];
		$f->log_chr_method = ['log_chr_method', 8, 'not_null', 'char'];
		return $f;
	}
	
	public function tableName(){
		return 'Spell_log';
	}
	
	public function setID($id){
		$this->log_bgn_id = $id;
	}
	
	public function primaryKey(){
		return 'log_bgn_id';
	}
}