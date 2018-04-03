<?php

namespace Data\Doctrine;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\QueryBuilder;


/**
 *  Repository
 *
 * @author moysesoliveira
 */
class Repository extends AbstractRepository {

    private $connection = 'default';
    
    public function tables($prefix) {
        $conn = $this->getEm($this->connection)->getConnection();
        $sql = $this->getSql(['tables.sql']);
        return $conn->fetchAll($sql, compact('prefix'));
    }

    public function columns($table) {
        $conn = $this->getEm($this->connection)->getConnection();
        $sql = $this->getSql(['columns.sql']);
        return $conn->fetchAll($sql, compact('table'));
    }
    
    private function getSql($arrayPath){
        array_unshift($arrayPath, __DIR__);
        $path = implode(DIRECTORY_SEPARATOR, $arrayPath);
        return file_get_contents($path);
    }
}
