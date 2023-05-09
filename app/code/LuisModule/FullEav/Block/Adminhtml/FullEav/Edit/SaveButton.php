<?php

namespace LuisModule\FullEav\Block\Adminhtml\FullEav\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $data = [
            'label' => __('Guardar'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 60,
        ];
        return $data;
    }
}