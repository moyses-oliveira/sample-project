<?php

namespace Data\Service\Fin;

use Spell\Flash\Path;
use Spell\Flash\Server;
use Spell\MVC\Flash\Route;
use Braspag\API\Braspag as SDK;
use Braspag\API\Merchant;
use Braspag\API\Sale;
use Braspag\API\Customer;
use Braspag\API\Payment;
use Braspag\API\Environment;

/**
 * Description of Braspag
 *
 * @author moysesoliveira
 */
class Braspag {

    /**
     *
     * @var Merchant 
     */
    private $merchant = null;

    public function __construct()
    {
        $authPath = Path::combine([Route::getPath(), 'Settings', 'gateway', 'braspag.json']);
        $auth = json_decode(file_get_contents($authPath), true);
        $this->merchant = new Merchant($auth['MerchantId'], $auth['MerchantKey']);
    }

    public function boleto($customerName, $value, $doc)
    {
        $customer = new Customer($customerName);
        $newPayment = new Payment($value * 100);
        $newPayment->setType('Boleto');
        $newPayment->setProvider(Payment::PROVIDER_SIMULADO);
        $newSale = new Sale($doc);
        $newSale->setPayment($newPayment);
        $newSale->setCustomer($customer);
        /* @var $sale Sale */
        return  $this->getSDK()->createSale($newSale)->getPayment()->getPaymentId();
        
        //$auth['MerchantId']
        //$auth['MerchantKey']
    }
    
    /**
     * 
     * @param string $paymentId
     * @return Sale
     */
    public function getSale($paymentId) {
        return $this->getSDK()->getSale($paymentId);
    }
    
    /**
     * 
     * @param string $paymentId
     * @return Sale
     */
    public function captureSale($paymentId, $value) {
        return $this->getSDK()->captureSale($paymentId, $value * 100);
    }
    
    /**
     * 
     * @return \Braspag\API\Braspag
     */
    public function getSDK() {
        return new SDK($this->merchant, Environment::sandbox());
    }

}
