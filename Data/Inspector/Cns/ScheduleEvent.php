<?php

namespace Data\Inspector\Cns;

use Spell\Data\Inspector\Entry;
use Spell\Data\Inspector\EntryCollection;
use DateTime;

/**
 * Data entry verifier
 *
 * @author moysesoliveira
 */
class ScheduleEvent extends EntryCollection {

    public function __construct()
    {
        $this->set(new Entry('fkUser', 10))->isRequired();
        
        $this->set(new Entry('fkCategory', 10))->isRequired();

        $this->set(new Entry('chrTitle', 128))->isRequired();

        $this->set(new Entry('vrcDescription', 4096))->isRequired();

        $this->set(new Entry('dteEvent', 10))->isRequired();
        
        $this->set(new Entry('timeBegin', 5))->isRequired();

        $this->set(new Entry('timeFinish', 5))->isRequired();
    }

    /**
     * 
     */
    public function validate(): bool
    {
        $data = $this->normalize();

        /* @var $dttFinish \DateTime */
        $dttFinish = $data['dttFinish'];
        $isValid = $dttFinish->diff($data['dttBegin'])->format('%R') === '+';
        if ($data['dttBegin'] && $data['dttFinish'] && $isValid):
            $this->get('timeFinish')->setError('DATE_DIFF');
            return false;
        endif;
        return parent::validate();
    }

    /**
     * Entry value collection as array
     * 
     * @return array
     */
    public function normalize(): array
    {
        $data = $this->toArray();
        $dteEvent = $data['dteEvent'];
        $data['dttBegin'] = $this->normalizeDateTime($dteEvent . ' ' . $data['timeBegin']);
        $data['dttFinish'] = $this->normalizeDateTime($dteEvent . ' ' . $data['timeFinish']);
        return $data;
    }

    /**
     * 
     * @param \DateTime|string $date
     * @return \DateTime|null
     * @throws \Exception
     */
    private function normalizeDate($date): ?\DateTime
    {
        if (!$date)
            return null;

        if ($date instanceof DateTime)
            return $date;

        $dt = DateTime::createFromFormat('d/m/Y', $date);
        if ($dt instanceof DateTime && !array_sum($dt->getLastErrors()))
            return $dt;

        $dt = DateTime::createFromFormat('Y-m-d', $date);
        if ($dt instanceof DateTime && !array_sum($dt->getLastErrors()))
            return $dt;

        throw new \Exception('Invalid date format');
    }

    /**
     * 
     * @param \DateTime|string $date
     * @return \DateTime|null
     * @throws \Exception
     */
    private function normalizeDateTime($date): ?\DateTime
    {
        if (!$date)
            return null;

        if ($date instanceof DateTime)
            return $date;

        $dt = DateTime::createFromFormat('d/m/Y H:i', $date);
        if ($dt instanceof DateTime && !array_sum($dt->getLastErrors()))
            return $dt;

        $dt = DateTime::createFromFormat('Y-m-d H:i', $date);
        if ($dt instanceof DateTime && !array_sum($dt->getLastErrors()))
            return $dt;

        throw new \Exception('Invalid date format');
    }

}
