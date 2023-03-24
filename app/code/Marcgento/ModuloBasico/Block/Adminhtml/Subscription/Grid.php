<?php


namespace Marcgento\ModuloBasico\Block\Adminhtml\Subscription;

use Magento\Backend\Block\Widget\Grid\Extended as Extended;

class Grid extends Extended
{
    /**
     * @var \Marcgento\ModuloBasico\Block\Adminhtml\Subscription\Collection
     */
    protected $_subscriptionCollection;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Marcgento\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Marcgento\ModuloBasico\Model\ResourceModel\Subscription\Collection $subscriptionCollection,
        array $data = []
    )
    {
        $this->_subscriptionCollection = $subscriptionCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText(__('No Subscription Found'));
    }

    /**
     * Initialize the subscription collection
     * 
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_subscriptionCollection);
        return parent::_prepareCollection();
    }
}