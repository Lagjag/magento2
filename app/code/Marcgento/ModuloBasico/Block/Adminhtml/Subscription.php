<?php


namespace Marcgento\ModuloBasico\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container as Container;

class Subscription extends Container
{
    protected function __construct()
    {
        $this->_blockGroup = 'Marcgento_ModuloBasico';
        $this->_controller = 'adminhtml_subscription';
        parent::__construct();
    }
}