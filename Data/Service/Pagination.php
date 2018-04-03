<?php

namespace Data\Service;

use Spell\UI\HTML\Tag;
use Spell\MVC\Router\Route;

/**
 *
 * @author moysesoliveira
 */
class Pagination {

    public $model;
    public $getsVars;
    public $recordByPage;
    public $PagesFound;
    public $totalRecords;
    public $currentPage;
    public $msg_initialPage;
    public $msg_finalPage;
    public $msg_previousPage;
    public $msg_nextPage;
    public $msg_next10Results;
    public $msg_previous10Results;
    public $msg_page;
    public $msg_of;
    public $msg_even;
    public $gets = array();

    /**
     * 
     * @param int $currentPage
     * @param int $recordByPage
     */
    public function __construct(int $currentPage, int $recordByPage)
    {
        $this->currentPage = $currentPage;
        $this->recordByPage = $recordByPage;
        $this->gets = $_GET;
    }
    
    /**
     * 
     * @return int
     */
    public function getStartPosition():int  {
        return ($this->currentPage - 1) * $this->recordByPage;
    }

    public function getRecordByPage():int {
        return $this->recordByPage;
    }
    
    /**
     * 
     * @param int $totalRecords
     */
    public function config(int $totalRecords) {
        $this->totalRecords = $totalRecords;
        if($this->totalRecords % $this->recordByPage != 0 && $this->totalRecords != 0):
            $this->PagesFound = (($this->totalRecords - ($this->totalRecords % $this->recordByPage)) / $this->recordByPage) + 1;
        else:
            $this->PagesFound = $this->totalRecords / $this->recordByPage;
        endif;
        $this->msgTranslate();
    }
    
    public function msgTranslate()
    {
        $this->msg_initialPage = "Página Inicial";
        $this->msg_finalPage = "Página Final";
        $this->msg_previousPage = "Anterior";
        $this->msg_nextPage = "Próxima";
        $this->msg_next10Results = "Próximas 10 páginas";
        $this->msg_previous10Results = "10 Páginas anteriores";
        $this->msg_page = "Ir para Página";
        $this->msg_of = "De";
        $this->msg_to = "a";
    }

    public function getParams()
    {
        return http_build_query($this->gets);
    }

    public function link($key, $value)
    {
        $params = $this->gets;
        $params[$key] = $value;
        return '?' . http_build_query($params);
    }

    /**
     * Outputs the total number of pages
     * @access 	public
     */
    public function getPagesFound()
    {
        return $this->PagesFound;
    }

    /**
     * Outputs the Navigation links
     * @access 	public
     */
    public function linkPrev($show = true)
    {
        if($this->currentPage > 1):
            return $this->li('prev', $this->msg_previousPage, $this->link('page', $this->currentPage - 1));
        elseif($show):
            return $this->li('next', $this->msg_previousPage);
        endif;
        return '';
    }

    /**
     * Outputs the Navigation links
     * @access 	public
     */
    public function linkNext($show = true)
    {
        if($this->currentPage < $this->PagesFound):
            return $this->li('next', $this->msg_nextPage, $this->link('page', $this->currentPage + 1));
        elseif($show):
            return $this->li('next', $this->msg_nextPage);
        endif;
        return '';
    }

    /**
     * Outputs Navigation records list based in current page
     * @access 	public
     */
    public function getCurrentPages()
    {
        $result = '';
        $totalRecordsControl = $this->totalRecords;
        if(($totalRecordsControl % $this->recordByPage != 0)):
            while($totalRecordsControl % $this->recordByPage != 0):
                $totalRecordsControl++;
            endWhile;
        endif;
        $ultimo = substr($this->currentPage, -1);
        if($ultimo == 0):
            $begin = ($this->currentPage - 9);
            $pageInicial = ($this->currentPage - $ultimo);
            $end = $this->currentPage;
        else:
            $pageInicial = ($this->currentPage - $ultimo);
            $begin = ($this->currentPage - $ultimo) + 1;
            $end = $pageInicial + 10;
        endif;
        $num = $this->PagesFound;
        if($end > $num):
            $end = $num;
        endif;
        for($a = $begin; $a <= $end; $a++):
            $link = intval($a) === intval($this->currentPage) ? null : $this->link('page', $a);
            $result .= $this->li('pag', $a, $link);
        endfor;
        return $result;
    }

    /**
     * Outputs the records list based in current page
     * @access 	public
     */
    public function getListCurrentRecords()
    {
        $regFinal = $this->recordByPage * $this->currentPage;
        $regInicial = $regFinal - $this->recordByPage;
        if($regInicial == 0):
            $regInicial++;
        endif;
        if($this->currentPage == $this->PagesFound):
            $regFinal = $this->totalRecords;
        endif;
        if($this->currentPage > 1):
            $regInicial++;
        endif;
        $result = "{$this->msg_of} <font class='paginacao_color'>$regInicial</font> {$this->msg_to} <font class='paginacao_color'>$regFinal</font>";
        return $result;
    }

    /**
     * Outputs the links for browsing from 1 to 10, 11 to 20, 21 to 30, and so forth
     * @access 	public
     */
    public function getPaginationInfo()
    {
        $start = 1 + (($this->currentPage - 1) * $this->recordByPage);
        $end = $start + $this->recordByPage - 1;
        return sprintf('%s até %s de %s registros.', $start, ($this->totalRecords > $end ? $end : $this->totalRecords), $this->totalRecords);
    }

    /**
     * Outputs the links for browsing from 1 to 10, 11 to 20, 21 to 30, and so forth
     * @access 	public
     */
    public function getPaginationBar()
    {
        return Tag::mk('ul', 'pagination')
                ->setChilds([
                    $this->linkPrev(),
                    $this->getCurrentPages(),
                    $this->getNavigationGroupLinks(),
                    $this->linkNext()
                ])->render();
    }

    /**
     * Outputs the links for browsing from 1 to 10, 11 to 20, 21 to 30, and so forth
     * @access 	public
     */
    public function getNavigationGroupLinks()
    {
        $result = '';
        if(($this->currentPage <= 10) && ($this->PagesFound >= 1)):
            $end = 11;
        else:
            $cp = $this->currentPage - 1;
            $end = ($cp - $cp % 10) + 11;
            $begin = $end - 20;
        endif;
        if(!(($this->currentPage >= 1) && ($this->currentPage <= 10))):
            $attr = [
                'title' => $this->msg_previous10Results,
                'onMouseOver' => sprintf("window.status='%s';return true;", $this->msg_previous10Results),
                'onMouseOut' => "window.status='';return true",
            ];
            $result = Tag::mk('li', 'pag')
                    ->appendChild(
                        Tag::a($this->link('page', $begin))
                        ->setAttributes($attr)
                        ->setContent($this->msg_previous10Results)
                    )->render();
        endif;
        if($end <= $this->PagesFound):
            $attr = [
                'title' => $this->msg_previous10Results,
                'onMouseOver' => sprintf("window.status='%s';return true;", $this->msg_next10Results),
                'onMouseOut' => "window.status='';return true",
            ];
            $result .= Tag::mk('li', 'pag')
                    ->appendChild(
                        Tag::a($this->link('page', $end))
                        ->setAttributes($attr)
                        ->setContent($this->msg_next10Results)
                    )->render();
        endif;
        return $result;
    }

    public function li(string $class, string $text, $link = null): string
    {
        $li = Tag::mk('li', $class);
        if(!$link)
            $li->appendChild(Tag::mk('span')->setContent($text));
        else
            $li->appendChild(Tag::a($link)->setContent($text));

        return $li->render();
    }

}
