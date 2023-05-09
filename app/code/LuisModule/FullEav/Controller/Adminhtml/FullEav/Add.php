<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Framework\Controller\ResultFactory;

class Add extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Añadir nuevo registro'));
        return $resultPage;
    }
}