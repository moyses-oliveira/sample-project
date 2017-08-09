<?php

namespace App\Doctrine\Controller;

use Spell\Flash\Path;
use Spell\MVC\Flash\Route;
use Spell\MVC\Flash\App;
use App\Acl\Controller\AbstractController;

class Home extends AbstractController {

    public function __construct()
    {
        parent::__construct();
        $this->isPublic = true;
        $this->setTitle('Auth');
    }

    public function index()
    {
        
        $this->getTheme()->setFile('clean.php');
        $tables = isset($_GET['prefix']) ? $this->getRepository()->tables($_GET['prefix']) : false;
        $this->render(compact('tables'));
    }

    public function build()
    {
        if(!$_POST)
            return;
        
        foreach($_POST['entity'] as $table):
            $this->buildEntity($table);
        endforeach;
    }

    private function buildEntity($table)
    {
        $tbInfoData = $this->getRepository()->columns($table);
        $tbConf = [];
        foreach($tbInfoData as $colConfArray):
            $colConf = (object) $colConfArray;
            $k = $colConf->col;
            unset($colConf->col);
            $colConf->ucname = $this->toUc($k);
            if($colConf->pk)
                $pk = $k;

            $colConf->types = [];
            if($colConf->not_null)
                $colConf->types[] = 'not_null';

            if($colConf->places)
                $colConf->types[] = 'decimal_' . $colConf->places;

            $colConf->types[] = $colConf->type;

            $colConf->php_type = $this->phpType($colConf->type);

            $colConf->str_types = "'" . implode("', '", $colConf->types) . "'";

            $tbConf[$k] = $colConf;
        endforeach;
        return $this->createFile($_GET['prefix'], $_GET['nsp'], $table, $tbConf, $pk);
    }

    private function createFile($prefix, $nsp, $table, $tbConf, $pk)
    {
        $namespace = Path::combine(['Data', 'Entity', $nsp], '\\');
        $classname = $this->toUc(substr($table, strlen($prefix)));
        
        \Rain\Tpl::configure([
            "tpl_dir"       => realpath($this->getTheme()->getView('content')->getPath() . '/../Home') . '/',
            "cache_dir"     => realpath($this->getTheme()->getView('content')->getPath() . '/../Cache') . '/' 
        ]);
        $rain = new \Rain\Tpl();
        $rain->objectConfigure(['tpl_ext' => 'tpl', 'auto_escape' => false, 'cache_dir' => App::getPath() . 'sandbox']);
        $rain->assign('table', $table);
        $rain->assign('tbConf', $tbConf);
        $rain->assign('pk', $pk);
        $rain->assign('classname', $classname);
        $rain->assign('namespace', $namespace);
        $rain->assign('repositoryNamespace', str_replace('\\Entity','\\Repository',$namespace));
        $tplPath = '/entity.rain';

        $model_php = str_replace(['&lt;?php', '->[$key]'], ['<?php', '->{$key}'], $rain->draw($tplPath, true));
        $path = Path::combine([$namespace]);

        if(!file_exists($path))
            Path::make($path);

        $filename = $path . '/' . $classname . '.php';
        if(file_exists($filename))
            unlink($filename);

        file_put_contents($filename, $model_php);
        printf('\'%s\' Sucesfull created.<br/>', $filename);
    }

    private function toUc($str)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }

    private function phpType($type)
    {
        $types = [
            'string' => ['varchar', 'char', 'longtext', 'mediumtext', 'enum', 'tinytext', 'text', 'nvarchar', 'varbinary'],
            'integer' => ['tinyint', 'smallint', 'int', 'mediumint', 'bigint'],
            'float' => ['decimal', 'float', 'double']
        ];
        foreach($types as $t => $options)
            if(in_array(strtolower($type), $options))
                return $t;

        return $type;
    }

    /**
     * 
     * @return \Data\Doctrine\Repository
     */
    public function getRepository(): \Data\Doctrine\Repository
    {
        return $this->getEm()->getRepository('Data\Doctrine\Entity');
    }

}
