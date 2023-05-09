<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use LuisModule\FullEav\Model\FullEavFactory;

class Save extends Action
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
        $storeId = (int)$this->getRequest()->getParam('store_id');
        $data = $this->getRequest()->getParams();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $params = [];
            $fulleavData = $this->fulleavFactory->create();
            $fulleavData->setStoreId($storeId);
            $params['store'] = $storeId;
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            } else {
                $fulleavData->load($data['entity_id']);
                $params['entity_id'] = $data['entity_id'];
           }
            $fulleavData->addData($data);
            $this->_eventManager->dispatch(
               'md_helloworld_helloworld_prepare_save',
                ['object' => $this->fulleavFactory, 'request' => $this->getRequest()]
            );
            try {
                $fulleavData->save();
                $this->messageManager->addSuccessMessage(__('Se ha guardado el registro.'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $params['entity_id'] = $fulleavData->getId();
                    $params['_current'] = true;
                    return $resultRedirect->setPath('*/*/edit', $params);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e, __('Algo ha ocurrido guardando el registro.'));
            }
            $this->_getSession()->setFormData($this->getRequest()->getPostValue());
            return $resultRedirect->setPath('*/*/edit', $params);
        }
        return $resultRedirect->setPath('*/*/');
    }

}