<?php

namespace LuisModule\FullEav\Controller\Adminhtml\FullEav;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use LuisModule\FullEav\Model\ResourceModel\FullEav\Collection;

class MassDelete extends Action
{    
    protected $filter;
    protected $fulleavCollection;

    public function __construct(Context $context, Filter $filter, Collection $fulleavCollection)
    {
        $this->filter = $filter;
        $this->fulleavCollection = $fulleavCollection;
        parent::__construct($context); 
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->fulleavCollection);
        $collectionSize = $collection->getSize();
        $collection->walk('delete');
        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

}