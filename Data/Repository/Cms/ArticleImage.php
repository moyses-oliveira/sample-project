<?php

namespace Data\Repository\Cms;

use Spell\Data\Doctrine\AbstractRepository;
use Data\Service\File\Gallery;

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
        $qb = $this->_em->createQueryBuilder()
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

}
