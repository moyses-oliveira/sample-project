<?php

/**
 * DataBase class
 *  
 * @author Moysés Filipe Lopes Peixoto de Oliveira
 * @version 1.0
 * @access public
 * @modification 2016-10-20
 */
namespace App\Doctryne\Model;
	
use \stdClass;
use \PDO;
class InformationSchema
{
	private $db = null;

	public function statementTables() {
		return $this->procedure(__FUNCTION__);
	}

	public function statementType($statement) {
		return $this->procedure(__FUNCTION__, $statement);
	}
	
	public function statementInfo($statement) {
		return $this->procedure(__FUNCTION__, $statement);
	}
	
	public function statementParams($statement) {
		return $this->procedure(__FUNCTION__, $statement);
	}
	
	public function tablePrimaryKey($statement) {
		$info = $this->procedure(__FUNCTION__, $statement);
		if(!$info)
			return '';
		
		$data = (array)current($info);
		return current($data);
	}
	
	public function columnForeignKey($statement, $column) {
		return $this->procedure(__FUNCTION__, $statement, $column);
	}
	
	private function procedure($function, $statement = null, $column = null) {
		$this->db = new \Spell\Data\DB();
		$this->db->connect();
		return $this->db->call('prc_information_schema', [$function, $statement, $column]);
	}
}