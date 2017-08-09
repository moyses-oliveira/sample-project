<?php

namespace Data\Entity\Pagamento;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="portal_pagamento_recorrente")
 * @ORM\Entity(repositoryClass="Data\Repository\Pagamento\Recorrente")
 */
class Recorrente extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="idfk_requerente", type="integer", length=10)
     * @var integer     */
    protected $idfk_requerente;
	
    /**
     * @ORM\Column(name="idfk_diretor", type="integer", length=10)
     * @var integer     */
    protected $idfk_diretor;
	
    /**
     * @ORM\Column(name="idfk_fornecedor", type="integer", length=10)
     * @var integer     */
    protected $idfk_fornecedor;
	
    /**
     * @ORM\Column(name="idfk_grupo", type="integer", length=10)
     * @var integer     */
    protected $idfk_grupo;
	
    /**
     * @ORM\Column(name="idfk_cat", type="integer", length=10)
     * @var integer     */
    protected $idfk_cat;
	
    /**
     * @ORM\Column(name="detalhes", type="string", length=3000)
     * @var string     */
    protected $detalhes;
	
    /**
     * @ORM\Column(name="dia_emissao", type="integer", length=3)
     * @var integer     */
    protected $dia_emissao;
	
    /**
     * @ORM\Column(name="dia_vencimento", type="integer", length=3)
     * @var integer     */
    protected $dia_vencimento;
	
    /**
     * @ORM\Column(name="mes_vencimento", type="integer", length=3)
     * @var integer     */
    protected $mes_vencimento;
	
    /**
     * @ORM\Column(name="inicio", type="date", length=20)
     * @var date     */
    protected $inicio;
	
    /**
     * @ORM\Column(name="fim", type="date", length=20)
     * @var date     */
    protected $fim;
	
    /**
     * @ORM\Column(name="desativado", type="datetime", length=20)
     * @var datetime     */
    protected $desativado;
	
    public function __construct($data=null)
    {
        if($data)
            $this->fromArray($data);
    }
	
    public function getId()
    {
        return $this->id;
    }
	
    public function setId($id)
    {
        $this->id = $id;
    }
	
    public function getIdfkRequerente()
    {
        return $this->idfk_requerente;
    }
	
    public function setIdfkRequerente($idfk_requerente)
    {
        $this->idfk_requerente = $idfk_requerente;
    }
	
    public function getIdfkDiretor()
    {
        return $this->idfk_diretor;
    }
	
    public function setIdfkDiretor($idfk_diretor)
    {
        $this->idfk_diretor = $idfk_diretor;
    }
	
    public function getIdfkFornecedor()
    {
        return $this->idfk_fornecedor;
    }
	
    public function setIdfkFornecedor($idfk_fornecedor)
    {
        $this->idfk_fornecedor = $idfk_fornecedor;
    }
	
    public function getIdfkGrupo()
    {
        return $this->idfk_grupo;
    }
	
    public function setIdfkGrupo($idfk_grupo)
    {
        $this->idfk_grupo = $idfk_grupo;
    }
	
    public function getIdfkCat()
    {
        return $this->idfk_cat;
    }
	
    public function setIdfkCat($idfk_cat)
    {
        $this->idfk_cat = $idfk_cat;
    }
	
    public function getDetalhes()
    {
        return $this->detalhes;
    }
	
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }
	
    public function getDiaEmissao()
    {
        return $this->dia_emissao;
    }
	
    public function setDiaEmissao($dia_emissao)
    {
        $this->dia_emissao = $dia_emissao;
    }
	
    public function getDiaVencimento()
    {
        return $this->dia_vencimento;
    }
	
    public function setDiaVencimento($dia_vencimento)
    {
        $this->dia_vencimento = $dia_vencimento;
    }
	
    public function getMesVencimento()
    {
        return $this->mes_vencimento;
    }
	
    public function setMesVencimento($mes_vencimento)
    {
        $this->mes_vencimento = $mes_vencimento;
    }
	
    public function getInicio()
    {
        return $this->inicio;
    }
	
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }
	
    public function getFim()
    {
        return $this->fim;
    }
	
    public function setFim($fim)
    {
        $this->fim = $fim;
    }
	
    public function getDesativado()
    {
        return $this->desativado;
    }
	
    public function setDesativado($desativado)
    {
        $this->desativado = $desativado;
    }
	
}