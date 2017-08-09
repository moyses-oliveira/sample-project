<?php
namespace model;
use \stdClass;
use \op3p\ppp;

class {$table} extends \op3p\base\model {
{loop="$tbConf"}
	public ${$key} = null;
{/loop}
	
	public function columns(){
		$f = new \stdClass();
{loop="$tbConf"}
		$f->{$key} = ['{$key}', {$value->length}, {$value->str_types}];
{/loop}
		return $f;
	}
	
	public function tableName(){
		return '{$table}';
	}
{if="!!$pk"}
	
	public function setID($id){
		$this->{$pk} = $id;
	}
	
	public function primaryKey(){
		return '{$pk}';
	}
{/if}
}