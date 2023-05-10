<?php

namespace Marcgento\ModuloEventManager\Observer;

use Magento\Framework\Event\ObserverInterface;

class RegisterVisitObserver implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface */
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $this->logger->debug('Acción observer registrada');
    
        $product = $observer->getProduct();
        $category = $observer->getCategory();
        $this->logger->debug(print_r($product->debug(), true));
        $this->logger->debug(print_r($category->debug(),true));
    }
}