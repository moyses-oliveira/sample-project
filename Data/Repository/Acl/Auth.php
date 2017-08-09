<?php

namespace Data\Repository\Acl;

use Spell\Data\Doctrine\AbstractRepository;
use Doctrine\ORM\Query\Expr\Join;
use Data\Service\File\Gallery;

/**
 * User Login Authentication
 *
 * @author moysesoliveira
 */
class Auth extends AbstractRepository {

    public function login(string $vrcEmail, string $vrbPass): string
    {
        $inspector = new \Data\Inspector\Acl\User();
        $user = $this->getUserByEmail($vrcEmail);

        if(!$user)
            return 'EMAIL';

        if($user['vrbPass'] !== $inspector->hash($vrcEmail, $vrbPass))
            return 'PASS';

        return $user['id'];
    }

    public function getUserByEmail(string $vrcEmail): ?array
    {
        return $this->_em->createQueryBuilder()
                ->select(['t.id', 't.vrcName', 't.vrcEmail', 't.vrbPass', 't.vrcToken'])
                ->from('Data\Entity\Acl\User', 't')
                ->where('t.vrcEmail=:vrcEmail AND t.dttDeleted IS NULL')
                ->setParameters(compact('vrcEmail'))
                ->getQuery()
                ->getOneOrNullResult();
    }

    public function getUserById(string $id)
    {
        $result = $this->_em->createQueryBuilder()
            ->select(['t.id AS id', 't.vrcName AS name', 't.vrcEmail AS email', 't.vrcImage AS image', 't.vrcToken AS token'])
            ->from('Data\Entity\Acl\User', 't')
            ->where('t.id=:id')
            ->setParameters(compact('id'))
            ->getQuery()
            ->getOneOrNullResult();

        $result['icon'] = Gallery::toSize($result['image'], 'icon');
        return $result;
    }

    public function getSessionParams(string $fkUser)
    {
        $results = $this->getUserAppModules($fkUser);
        $auth = [];
        $acl = [];
        foreach($results as $v):
            $auth[] = [$v['app'], $v['alias']];
            $k = $v['id'];
            if(!isset($acl[$k]))
                $acl[$k] = [$v['icon'], $v['category'], []];

            $acl[$k][2][] = [$v['app'], $v['alias'], []];
        endforeach;
        return [$auth, $acl];
    }

    /**
     * @return array
     */
    private function getUserAppModules(string $fkUser): array
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select([
                'c.id',
                'c.vrcIcon as icon',
                'c.vrcLabel as category',
                'a.vrcAlias as app',
                'm.vrcAlias as alias'
            ])
            ->from('Data\Entity\Acl\UserProfile', 't')
            ->join('Data\Entity\Acl\ProfileModule', 'pm', Join::WITH, 'pm.fkProfile=t.fkProfile AND pm.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\Module', 'm', Join::WITH, 'm.id=pm.fkModule AND m.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\App', 'a', Join::WITH, 'a.id=m.fkApp AND a.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\Category', 'c', Join::WITH, 'c.id=m.fkCategory AND c.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
            ->orderBy('c.tnyPriority')->addOrderBy('m.tnyPriority')
            ->setParameters(compact('fkUser'))
            ->groupBy('m.id');

        return $qb->getQuery()->getResult();
    }

}
