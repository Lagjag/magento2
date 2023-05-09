<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('LuisModule_FullEav::fulleav');
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('LuisModule_FullEav::fulleav');
        $resultPage->getConfig()->getTitle()->prepend(__('Full EAV'));
        return $resultPage;
    }
}