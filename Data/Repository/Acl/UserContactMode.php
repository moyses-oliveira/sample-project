<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Customer Repository
 *
 * @author moysesoliveira
 */
class UserContactMode extends AbstractRepository {

    public function options() {
        $data = $this->getEm()->createQueryBuilder()
                ->select(['t.id', 't.chrAlias'])
                ->from('Data\Entity\Acl\UserContactMode', 't')
                ->where('t.dttDeleted IS NULL')
                ->getQuery()
                ->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = $f['chrAlias'];

        return $options;
    }
}
