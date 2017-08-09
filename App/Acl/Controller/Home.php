<?php

namespace App\Acl\Controller;

use Spell\Data\MySQL\Data;

class Home extends \App\Acl\Controller\AbstractController {

    public function index() {
        return $this->render();
    }
    
    public function data(){
        $model = new \Model\Acl\App();
        $data['app_int_id'] = 1;
        $data['app_vrc_alias'] = 'asdasd';
        $data['app_vrc_icon'] = 'asdasd';
        $data['app_vrc_name'] = 'asdsadsa';
        $data['app_dtt_deleted'] = date('Y-m-d H:i:s');
        //$model->fromArray($data);
        //$sql = new \Spell\Data\MySQL\SQL();
        //$sql->save($model);
        $sql = new Data('nb');
        
        $prepare = $sql
            ->setSelects(['t.id', 't.alias', 't.icon', 't.name'])
            ->addFrom($model->getDb() . ' t');
        $rows = $prepare->getObjects(0,10);
        $total = $prepare->getTotal();
        
        $datatable = new \Spell\UI\JQuery\DataTable\Data();
        $datatable->setData($rows);
        $datatable->setRecordsFiltered(count($rows));
        $datatable->setRecordsTotal($total);
        $this->json($datatable->toArray());
    }

}
