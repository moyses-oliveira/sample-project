<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\AbstractRepository;

/**
 * Description of App
 *
 * @author moysesoliveira
 */
class ArticleAttachment extends AbstractRepository {

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
                    't.dttAdded AS added'
                ])
                ->from('Data\Entity\Cms\ArticleAttachment', 't')
                ->where('t.dttDeleted IS NULL AND t.fkArticle=:fkArticle')
                ->setParameter('fkArticle', $fkArticle);

        return $qb->getQuery()->getResult();
    }

    /**
     * 
     * @return array
     */
    public function getLastFromArticle($fkArticle)
    {
        $qb = $this->getEm()->createQueryBuilder()
                ->select([
                    't.id', 
                    't.vrcSrc AS src',
                    't.chrExt AS ext',
                    't.vrcName AS name',
                    't.dttAdded AS added'
                ])
                ->from('Data\Entity\Cms\ArticleAttachment', 't')
                ->where('t.dttDeleted IS NULL AND t.fkArticle=:fkArticle')
                ->setParameter('fkArticle', $fkArticle)
                ->orderBy('t.id', 'DESC');

        return $qb->getQuery()->getOneOrNullResult();
    }

}
