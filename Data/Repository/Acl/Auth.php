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
        $email = strtolower($vrcEmail);
        $inspector = new \Data\Inspector\Acl\User();
        $user = $this->getUserByEmail($email);

        if (!$user)
            return 'EMAIL';

        if ($user['vrbPass'] !== $inspector->hash($email, $vrbPass))
            return 'PASS';

        return $user['id'];
    }

    public function getUserByEmail(string $vrcEmail): ?array
    {
        return $this->getEm()->createQueryBuilder()
                ->select(['t.id', 't.vrcName', 't.vrcEmail', 't.vrbPass', 't.vrcToken'])
                ->from('Data\Entity\Acl\User', 't')
                ->where('t.vrcEmail=:vrcEmail AND t.dttDeleted IS NULL')
                ->setParameters(compact('vrcEmail'))
                ->getQuery()
                ->getOneOrNullResult();
    }

    public function getUserById(string $id)
    {
        $result = $this->getEm()->createQueryBuilder()
            ->select(['t.id AS id', 't.vrcName AS name', 't.vrcEmail AS email', 't.vrcImage AS image', 't.vrcToken AS token'])
            ->from('Data\Entity\Acl\User', 't')
            ->where('t.id=:id')
            ->setParameters(compact('id'))
            ->getQuery()
            ->getOneOrNullResult();

        $result['icon'] = isset($result['image']) ? Gallery::toSize($result['image'], 'icon') : '';
        return $result;
    }

    public function getSessionParams(string $fkUser)
    {
        $results = $this->isDev($fkUser) ? $this->getAllAppModules() : $this->getUserAppModules($fkUser);
        $auth = [];
        $acl = [];
        foreach ($results as $v):
            $auth[] = [$v['app'], $v['alias']];
            $k = $v['id'];
            if (!isset($acl[$k]))
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
        $qb = $this->getEm()->createQueryBuilder();

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

    /**
     * @return array
     */
    private function getAllAppModules(): array
    {
        $qb = $this->getEm()->createQueryBuilder();

        $qb->select([
                'c.id',
                'c.vrcIcon as icon',
                'c.vrcLabel as category',
                'a.vrcAlias as app',
                'm.vrcAlias as alias'
            ])
            ->from('Data\Entity\Acl\Module', 'm')
            ->join('Data\Entity\Acl\App', 'a', Join::WITH, 'a.id=m.fkApp AND a.dttDeleted IS NULL')
            ->join('Data\Entity\Acl\Category', 'c', Join::WITH, 'c.id=m.fkCategory AND c.dttDeleted IS NULL')
            ->where('m.dttDeleted IS NULL')
            ->orderBy('c.tnyPriority')->addOrderBy('m.tnyPriority')
            ->groupBy('m.id');

        return $qb->getQuery()->getResult();
    }

    public function getProfiles(string $fkUser): array
    {
        return $this->isDev($fkUser) ? $this->getAllProfiles() : $this->getUserProfiles($fkUser);
    }
    
    /**
     * 
     * @param string $fkUser
     * @return array
     */
    private function getUserProfiles(string $fkUser): array
    {
        $qb = $this->getEm()->createQueryBuilder();

        $qb->select(['p.vrcAlias'])
            ->from('Data\Entity\Acl\UserProfile', 't')
            ->join('Data\Entity\Acl\Profile', 'p', Join::WITH, 'p.id=t.fkProfile AND p.dttDeleted IS NULL')
            ->where('t.dttDeleted IS NULL AND t.fkUser=:fkUser')
            ->setParameters(compact('fkUser'));
        $result = $qb->getQuery()->getResult();
        return array_column($result, 'vrcAlias');
    }

    /**
     * 
     * @param string $fkUser
     * @return array
     */
    private function getAllProfiles(): array
    {
        $qb = $this->getEm()->createQueryBuilder();

        $qb->select(['t.vrcAlias'])
            ->from('Data\Entity\Acl\Profile', 't')
            ->where('t.dttDeleted IS NULL');
        $result = $qb->getQuery()->getResult();
        return array_column($result, 'vrcAlias');
    }

    private function isDev(string $fkUser)
    {
        return $this->getEm()->find(\Data\Entity\Acl\User::class, $fkUser)->getChrType() === 'dev';
    }

}
