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
        $qb = $this->_em->createQueryBuilder()
                ->select([
                    't.id', 
                    't.vrcSrc AS src',
                    't.chrExt AS ext',
                    't.vrcName AS name'
                ])
                ->from('Data\Entity\Cms\ArticleAttachment', 't')
                ->where('t.dttDeleted IS NULL AND t.fkArticle=:fkArticle')
                ->setParameter('fkArticle', $fkArticle);

        return $qb->getQuery()->getResult();
    }

}
