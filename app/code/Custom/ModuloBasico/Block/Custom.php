<?php

namespace Custom\ModuloBasico\Block\Custom;

use Magento\Framework\View\Element\Template;

class Custom extends Template
{
    public function __construct(
        \Magento\Framework\View\Template\Context $context,
        array $data = []
    ){
        parent::__construct($context, $data);
    }
}