<?php

namespace Data\Entity\Pagamento;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="portal_pagamento_codigo_servico")
 * @ORM\Entity(repositoryClass="Data\Repository\Pagamento\CodigoServico")
 */
class CodigoServico extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="codigo", type="string", length=8)
     * @var string 
     */
    protected $codigo;
	
    /**
     * @ORM\Column(name="descricao", type="string", length=1024)
     * @var string 
     */
    protected $descricao;
	
    /**
     * @ORM\Column(name="iss_rf", type="float", length=4)
     * @var float 
     */
    protected $iss_rf;
	
    /**
     * @ORM\Column(name="iss_cpom", type="float", length=4)
     * @var float 
     */
    protected $iss_cpom;
	
    /**
     * @ORM\Column(name="irrf", type="float", length=4)
     * @var float 
     */
    protected $irrf;
	
    /**
     * @ORM\Column(name="cofins", type="float", length=4)
     * @var float 
     */
    protected $cofins;
	
    /**
     * @ORM\Column(name="csll", type="float", length=4)
     * @var float 
     */
    protected $csll;
	
    /**
     * @ORM\Column(name="pis_pasep", type="float", length=4)
     * @var float 
     */
    protected $pis_pasep;
	
    /**
     * @ORM\Column(name="inss", type="float", length=4)
     * @var float 
     */
    protected $inss;
	
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
	
    public function getCodigo()
    {
        return $this->codigo;
    }
	
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }
	
    public function getDescricao()
    {
        return $this->descricao;
    }
	
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
	
    public function getIssRf()
    {
        return $this->iss_rf;
    }
	
    public function setIssRf($iss_rf)
    {
        $this->iss_rf = $iss_rf;
    }
	
    public function getIssCpom()
    {
        return $this->iss_cpom;
    }
	
    public function setIssCpom($iss_cpom)
    {
        $this->iss_cpom = $iss_cpom;
    }
	
    public function getIrrf()
    {
        return $this->irrf;
    }
	
    public function setIrrf($irrf)
    {
        $this->irrf = $irrf;
    }
	
    public function getCofins()
    {
        return $this->cofins;
    }
	
    public function setCofins($cofins)
    {
        $this->cofins = $cofins;
    }
	
    public function getCsll()
    {
        return $this->csll;
    }
	
    public function setCsll($csll)
    {
        $this->csll = $csll;
    }
	
    public function getPisPasep()
    {
        return $this->pis_pasep;
    }
	
    public function setPisPasep($pis_pasep)
    {
        $this->pis_pasep = $pis_pasep;
    }
	
    public function getInss()
    {
        return $this->inss;
    }
	
    public function setInss($inss)
    {
        $this->inss = $inss;
    }
	
}