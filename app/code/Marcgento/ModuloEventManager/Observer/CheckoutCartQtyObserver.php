<?php

namespace Marcgento\ModuloEventManager\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckoutCartQtyObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface */
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->debug('Acción evento añadir carrito registrada');
    
        if($observer->getProduct()->getQty() %2 != 0){
            $this->logger->debug('No se agrego el producto al carro');
            throw new \Exception('Error must be even');
        } else {
            $this->logger->debug('El producto se agregó correctamente');
        }
    }
}