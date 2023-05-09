<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use LuisModule\FullEav\Model\FullEavFactory;

class Delete extends Action
{
    protected $fulleavFactory;

    public function __construct(
        Context $context,
        FullEavFactory $fulleavFactory
    ) {
        $this->fulleavFactory = $fulleavFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('LuisModule_FullEav::fulleav');
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id', null);
        try {
            $fulleavData = $this->fulleavFactory->create()->load($id);
            if ($fulleavData->getId()) {
                $fulleavData->delete();
                $this->messageManager->addSuccessMessage(__('Has borrado el registro.'));
            } else {

                $this->messageManager->addErrorMessage(__('El registro no existe.'));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }
        return $resultRedirect->setPath('*/*');
    }
    
}