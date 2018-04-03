<?php

namespace Data\Repository\Cns;

use Spell\Data\Doctrine\AbstractRepository;
use Spell\Flash\Localization;


/**
 * Description of Level
 *
 * @author moyses-oliveira
 */
class Level extends AbstractRepository{
    

    /**
     * 
     * @return array
     */
    public function options()
    {
        $data = $this->getEm()->createQueryBuilder()
                ->select(['t.id', 't.chrLevel'])
                ->from(\Data\Entity\Cns\Level::class, 't')
                ->where('t.dttDeleted IS NULL')
                ->orderBy('t.tnyValue', 'ASC')
                ->getQuery()->getResult();

        $options = [];
        foreach($data as $f)
            $options[$f['id']] = Localization::T(__CLASS__ . '::alias::' . $f['chrLevel']);

        return $options;
    }

}
