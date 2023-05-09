<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use LuisModule\FullEav\Model\ResourceModel\FullEav\Collection;

class InlineEdit extends Action
{
    protected $fulleavCollection;

    public function __construct(
        Context $context,
        Collection $fulleavCollection,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->fulleavCollection = $fulleavCollection;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $post_items = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($post_items))) {
            return $resultJson->setData([
                'messages' => [__('Por favor corrija la información enviada.')],
                'error' => true,
            ]);
        }
        try {
            $this->fulleavCollection
                ->setStoreId($this->getRequest()->getParam('store', 0))
                ->addFieldToFilter('entity_id', ['in' => array_keys($post_items)])
                ->walk('saveCollection', [$post_items]);
        } catch (\Exception $e) {
            $messages[] = __('Hay un error en la información guardada: ') . $e->getMessage();
            $error = true;
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}