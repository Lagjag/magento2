<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Validate extends Action {

    protected $jsonFactory;
    protected $response;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->response = new \Magento\Framework\DataObject();
    }

    public function validateRequireEntries(array $data) {
        $requiredFields = [
           'identifier' => __('Full Eav Identifier'),
       ];
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $this->_addErrorMessage(
                    __('Para aplicar los cambios necesitas rellenar los siguientes campos requeridos "%1"', $requiredFields[$field])
                );
            }
       }
    }

    protected function _addErrorMessage($message) {
        $this->response->setError(true);
        if (!is_array($this->response->getMessages())) {
            $this->response->setMessages([]);
       }
        $messages = $this->response->getMessages();
       $messages[] = $message;
        $this->response->setMessages($messages);
    }

    public function execute() {
        $this->response->setError(0);
        $this->validateRequireEntries($this->getRequest()->getParams());
        $resultJson = $this->jsonFactory->create()->setData($this->response);
        return $resultJson;
    }
}