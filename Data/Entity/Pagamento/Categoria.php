<?php

namespace Data\Entity\Pagamento;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="portal_pagamento_categoria")
 * @ORM\Entity(repositoryClass="Data\Repository\Pagamento\Categoria")
 */
class Categoria extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="idfk_grupo", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_grupo;
	
    /**
     * @ORM\Column(name="nome", type="string", length=255)
     * @var string 
     */
    protected $nome;
	
    /**
     * @ORM\Column(name="limite_aprovacao", type="float", length=13)
     * @var float 
     */
    protected $limite_aprovacao;
	
    /**
     * @ORM\Column(name="nf_type", type="string", length=3)
     * @var string 
     */
    protected $nf_type;
	
    /**
     * @ORM\Column(name="sem_nota_fiscal", type="integer", length=3)
     * @var integer 
     */
    protected $sem_nota_fiscal;
	
    /**
     * @ORM\Column(name="deleted", type="datetime", length=20)
     * @var datetime 
     */
    protected $deleted;
	
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
	
    public function getIdfkGrupo()
    {
        return $this->idfk_grupo;
    }
	
    public function setIdfkGrupo($idfk_grupo)
    {
        $this->idfk_grupo = $idfk_grupo;
    }
	
    public function getNome()
    {
        return $this->nome;
    }
	
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
	
    public function getLimiteAprovacao()
    {
        return $this->limite_aprovacao;
    }
	
    public function setLimiteAprovacao($limite_aprovacao)
    {
        $this->limite_aprovacao = $limite_aprovacao;
    }
	
    public function getNfType()
    {
        return $this->nf_type;
    }
	
    public function setNfType($nf_type)
    {
        $this->nf_type = $nf_type;
    }
	
    public function getSemNotaFiscal()
    {
        return $this->sem_nota_fiscal;
    }
	
    public function setSemNotaFiscal($sem_nota_fiscal)
    {
        $this->sem_nota_fiscal = $sem_nota_fiscal;
    }
	
    public function getDeleted()
    {
        return $this->deleted;
    }
	
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }
	
}