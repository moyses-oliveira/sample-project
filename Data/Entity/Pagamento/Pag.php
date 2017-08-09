<?php

namespace Data\Entity\Pagamento;

use Doctrine\ORM\Mapping as ORM;
use Spell\Data\Doctrine\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="portal_pagamento_pag")
 * @ORM\Entity(repositoryClass="Data\Repository\Pagamento\Pag")
 */
class Pag extends AbstractEntity {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", length=10)
     * @ORM\GeneratedValue
     * @var integer 
     */
    protected $id;
	
    /**
     * @ORM\Column(name="idfk_requerente", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_requerente;
	
    /**
     * @ORM\Column(name="idfk_diretor", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_diretor;
	
    /**
     * @ORM\Column(name="idfk_fornecedor", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_fornecedor;
	
    /**
     * @ORM\Column(name="idfk_status", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_status;
	
    /**
     * @ORM\Column(name="idfk_grupo", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_grupo;
	
    /**
     * @ORM\Column(name="idfk_cat", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_cat;
	
    /**
     * @ORM\Column(name="idfk_servico", type="integer", length=10)
     * @var integer 
     */
    protected $idfk_servico;
	
    /**
     * @ORM\Column(name="detalhes", type="string", length=3000)
     * @var string 
     */
    protected $detalhes;
	
    /**
     * @ORM\Column(name="valor", type="float", length=13)
     * @var float 
     */
    protected $valor;
	
    /**
     * @ORM\Column(name="variacao_cambial", type="integer", length=3)
     * @var integer 
     */
    protected $variacao_cambial;
	
    /**
     * @ORM\Column(name="imp_iss_rf", type="float", length=13)
     * @var float 
     */
    protected $imp_iss_rf;
	
    /**
     * @ORM\Column(name="imp_iss_cpom", type="float", length=13)
     * @var float 
     */
    protected $imp_iss_cpom;
	
    /**
     * @ORM\Column(name="imp_irrf", type="float", length=13)
     * @var float 
     */
    protected $imp_irrf;
	
    /**
     * @ORM\Column(name="imp_cofins", type="float", length=13)
     * @var float 
     */
    protected $imp_cofins;
	
    /**
     * @ORM\Column(name="imp_csll", type="float", length=13)
     * @var float 
     */
    protected $imp_csll;
	
    /**
     * @ORM\Column(name="imp_pis_pasep", type="float", length=13)
     * @var float 
     */
    protected $imp_pis_pasep;
	
    /**
     * @ORM\Column(name="imp_inss", type="float", length=13)
     * @var float 
     */
    protected $imp_inss;
	
    /**
     * @ORM\Column(name="valor_liquido", type="float", length=13)
     * @var float 
     */
    protected $valor_liquido;
	
    /**
     * @ORM\Column(name="contrato_vencimento", type="date", length=20)
     * @var date 
     */
    protected $contrato_vencimento;
	
    /**
     * @ORM\Column(name="contrato_anexo", type="string", length=2000)
     * @var string 
     */
    protected $contrato_anexo;
	
    /**
     * @ORM\Column(name="nota_fiscal_previsao", type="date", length=20)
     * @var date 
     */
    protected $nota_fiscal_previsao;
	
    /**
     * @ORM\Column(name="nota_fiscal_lancada", type="integer", length=3)
     * @var integer 
     */
    protected $nota_fiscal_lancada;
	
    /**
     * @ORM\Column(name="sem_nota_fiscal", type="integer", length=3)
     * @var integer 
     */
    protected $sem_nota_fiscal;
	
    /**
     * @ORM\Column(name="sem_pagamento", type="integer", length=3)
     * @var integer 
     */
    protected $sem_pagamento;
	
    /**
     * @ORM\Column(name="motivo_negado", type="string", length=1000)
     * @var string 
     */
    protected $motivo_negado;
	
    /**
     * @ORM\Column(name="status_update", type="datetime", length=20)
     * @var datetime 
     */
    protected $status_update;
	
    /**
     * @ORM\Column(name="added", type="datetime", length=20)
     * @var datetime 
     */
    protected $added;
	
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
	
    public function getIdfkStatus()
    {
        return $this->idfk_status;
    }
	
    public function setIdfkStatus($idfk_status)
    {
        $this->idfk_status = $idfk_status;
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
	
    public function getIdfkServico()
    {
        return $this->idfk_servico;
    }
	
    public function setIdfkServico($idfk_servico)
    {
        $this->idfk_servico = $idfk_servico;
    }
	
    public function getDetalhes()
    {
        return $this->detalhes;
    }
	
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }
	
    public function getValor()
    {
        return $this->valor;
    }
	
    public function setValor($valor)
    {
        $this->valor = $valor;
    }
	
    public function getVariacaoCambial()
    {
        return $this->variacao_cambial;
    }
	
    public function setVariacaoCambial($variacao_cambial)
    {
        $this->variacao_cambial = $variacao_cambial;
    }
	
    public function getImpIssRf()
    {
        return $this->imp_iss_rf;
    }
	
    public function setImpIssRf($imp_iss_rf)
    {
        $this->imp_iss_rf = $imp_iss_rf;
    }
	
    public function getImpIssCpom()
    {
        return $this->imp_iss_cpom;
    }
	
    public function setImpIssCpom($imp_iss_cpom)
    {
        $this->imp_iss_cpom = $imp_iss_cpom;
    }
	
    public function getImpIrrf()
    {
        return $this->imp_irrf;
    }
	
    public function setImpIrrf($imp_irrf)
    {
        $this->imp_irrf = $imp_irrf;
    }
	
    public function getImpCofins()
    {
        return $this->imp_cofins;
    }
	
    public function setImpCofins($imp_cofins)
    {
        $this->imp_cofins = $imp_cofins;
    }
	
    public function getImpCsll()
    {
        return $this->imp_csll;
    }
	
    public function setImpCsll($imp_csll)
    {
        $this->imp_csll = $imp_csll;
    }
	
    public function getImpPisPasep()
    {
        return $this->imp_pis_pasep;
    }
	
    public function setImpPisPasep($imp_pis_pasep)
    {
        $this->imp_pis_pasep = $imp_pis_pasep;
    }
	
    public function getImpInss()
    {
        return $this->imp_inss;
    }
	
    public function setImpInss($imp_inss)
    {
        $this->imp_inss = $imp_inss;
    }
	
    public function getValorLiquido()
    {
        return $this->valor_liquido;
    }
	
    public function setValorLiquido($valor_liquido)
    {
        $this->valor_liquido = $valor_liquido;
    }
	
    public function getContratoVencimento()
    {
        return $this->contrato_vencimento;
    }
	
    public function setContratoVencimento($contrato_vencimento)
    {
        $this->contrato_vencimento = $contrato_vencimento;
    }
	
    public function getContratoAnexo()
    {
        return $this->contrato_anexo;
    }
	
    public function setContratoAnexo($contrato_anexo)
    {
        $this->contrato_anexo = $contrato_anexo;
    }
	
    public function getNotaFiscalPrevisao()
    {
        return $this->nota_fiscal_previsao;
    }
	
    public function setNotaFiscalPrevisao($nota_fiscal_previsao)
    {
        $this->nota_fiscal_previsao = $nota_fiscal_previsao;
    }
	
    public function getNotaFiscalLancada()
    {
        return $this->nota_fiscal_lancada;
    }
	
    public function setNotaFiscalLancada($nota_fiscal_lancada)
    {
        $this->nota_fiscal_lancada = $nota_fiscal_lancada;
    }
	
    public function getSemNotaFiscal()
    {
        return $this->sem_nota_fiscal;
    }
	
    public function setSemNotaFiscal($sem_nota_fiscal)
    {
        $this->sem_nota_fiscal = $sem_nota_fiscal;
    }
	
    public function getSemPagamento()
    {
        return $this->sem_pagamento;
    }
	
    public function setSemPagamento($sem_pagamento)
    {
        $this->sem_pagamento = $sem_pagamento;
    }
	
    public function getMotivoNegado()
    {
        return $this->motivo_negado;
    }
	
    public function setMotivoNegado($motivo_negado)
    {
        $this->motivo_negado = $motivo_negado;
    }
	
    public function getStatusUpdate()
    {
        return $this->status_update;
    }
	
    public function setStatusUpdate($status_update)
    {
        $this->status_update = $status_update;
    }
	
    public function getAdded()
    {
        return $this->added;
    }
	
    public function setAdded($added)
    {
        $this->added = $added;
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