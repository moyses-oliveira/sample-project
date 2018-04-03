<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\AbstractRepository;
use Data\Service\File\Gallery;
use Doctrine\ORM\Query\Expr\Join;
use DoctrineExtensions\Query\Mysql\Rand;

/**
 * Description of App
 *
 * @author moysesoliveira
 */
class ArticleImage extends AbstractRepository {

    /**
     * 
     * @return array
     */
    public function getFromArticle($fkArticle)
    {
        $qb = $this->getEm()->createQueryBuilder()
                ->select([
                    't.id', 
                    't.vrcSrc AS src',
                    't.chrExt AS ext',
                    't.vrcName AS name',
                    't.vrcAlt AS alt', 
                    't.vrcTitle AS title',
                    't.vrcSummary AS summary'
                ])
                ->from('Data\Entity\Cms\ArticleImage', 't')
                ->where('t.dttDeleted IS NULL AND t.fkArticle=:fkArticle')
                ->orderBy('t.intOrder', 'ASC')
                ->setParameter('fkArticle', $fkArticle);

        $results = $qb->getQuery()->getResult();
        
        foreach($results as &$result)
            $result['thumb'] = Gallery::toSize($result['src'], 'small');
            
        return $results;
    }

    /**
     * 
     * @return array
     */
    public function getFromArticleAlias(string $vrcAlias, bool $random = false, int $max = 0)
    {
        $this->getEm()->getConfiguration()
            ->addCustomStringFunction('RAND', Rand::class);
        $qb = $this->getEm()->createQueryBuilder()
                ->select([
                    't.id', 
                    't.vrcSrc AS src',
                    't.chrExt AS ext',
                    't.vrcName AS name',
                    't.vrcAlt AS alt', 
                    't.vrcTitle AS title',
                    't.vrcSummary AS summary'
                ])
                ->from(\Data\Entity\Cms\ArticleImage::class, 't')
                ->join(\Data\Entity\Cms\Article::class, 'a', Join::WITH, 'a.id=t.fkArticle AND a.dttDeleted IS NULL AND a.vrcAlias=:vrcAlias')
                ->where('t.dttDeleted IS NULL')
                ->orderBy('t.intOrder', 'ASC')
                ->setParameter('vrcAlias', $vrcAlias);
        
        if($random)
            $qb->orderBy('RAND()');

        if($max > 0)
            $qb->setFirstResult(0)->setMaxResults($max);
        
        $results = $qb->getQuery()->getResult();
        
        foreach($results as &$result)
            $result['thumb'] = Gallery::toSize($result['src'], 'small');
            
        return $results;
    }

}
