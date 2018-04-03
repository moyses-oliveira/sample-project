<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;
use Spell\Flash\Localization;

/**
 * Profile
 *
 * @author moysesoliveira
 */
class ProfileModule extends AbstractRepository {
    
    /**
     * @return array
     */
    public function getOptions(): array
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select([
                't.id',
                't.vrcAlias AS module',
                'a.vrcAlias AS app',
                'c.vrcLabel AS category',
            
            ])
            ->from('Data\Entity\Acl\Module', 't')
            ->join('Data\Entity\Acl\Category', 'c', Join::WITH, 'c.id=t.fkCategory AND c.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\App', 'a', Join::WITH, 'a.id=t.fkApp AND a.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL')
            ->orderBy('c.tnyPriority')->addOrderBy('t.tnyPriority')
            ->addOrderBy('t.vrcAlias');
        
        $qb->andWhere('c.vrcLabel NOT IN (:ignore)');
        $qb->setParameter('ignore', ['system'], \Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
        
        $results = $qb->getQuery()->getResult();
        $options = [];
        foreach($results as $data)
            $options[$data['id']] =  Localization::T("nav::{$data['category']}") . ' > ' . Localization::T("nav::{$data['app']}::{$data['module']}");
        
        return $options;
    }
    
    /**
     * 
     * @param string $fkProfile
     * @return array
     */
    public function getValues(string $fkProfile): array {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select(['m.id'])
            ->from('Data\Entity\Acl\ProfileModule', 't')
            ->join('Data\Entity\Acl\Module', 'm', Join::WITH, 'm.id=t.fkModule AND m.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\App', 'a', Join::WITH, 'a.id=m.fkApp AND a.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkProfile=:fkProfile')
            ->setParameter('fkProfile', $fkProfile);
        
        $results = $qb->getQuery()->getResult();
        $actives = [];
        foreach($results as $data)
            $actives[] = $data['id'];
        
        return $actives;
    }
}
