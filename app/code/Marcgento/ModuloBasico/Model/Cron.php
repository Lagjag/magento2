<?php


namespace Marcgento\ModuloBasico\Model;


class Cron
{
    /** @var \Psr\Log\LoggerInterface */
    protected $logger;
    /** @var \Magento\Framework\ObjectManagerInterface */
    protected $objectManager;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\ObjectManagerInterface $objectManager
    ){
        $this->logger = $logger;
        $this->objectManager = $objectManager;
    }

    public function checkSubscription()
    {
        $subscription = $this->objectManager->create('Marcgento\ModuloBasico\Model\Subscription');
        $subscription->setFirstname('Cron');
        $subscription->setLastname('Job');
        $subscription->setEmail('email@email.com');
        $subscription->save();
        $this->logger->debug('Test subscription added');
    }
}