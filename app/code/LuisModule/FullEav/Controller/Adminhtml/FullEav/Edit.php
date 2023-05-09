<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use LuisModule\FullEav\Model\FullEavFactory;

class Edit extends Action
{

    protected $_coreRegistry = null;
    protected $resultPageFactory;
    protected $fulleavFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        FullEavFactory $fulleavFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->fulleavFactory = $fulleavFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('LuisModule_FullEav::fulleav');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $fulleavData = $this->fulleavFactory->create();
        if ($id) {
            $fulleavData->load($id);
            if (!$fulleavData->getId()) {
                $this->messageManager->addErrorMessage(__('Este registro ya no existe.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_session->getFormData(true);
        if (!empty($data)) {
            $fulleavData->addData($data);
        }
        $this->_coreRegistry->register('entity_id', $id);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('LuisModule_FullEav::fulleav');
        $resultPage->getConfig()->getTitle()->prepend(__('Editar registro'));
        return $resultPage;
    }
}