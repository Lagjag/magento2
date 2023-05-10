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
        $this->logger->customlog('Acción observer registrada');
    }
}