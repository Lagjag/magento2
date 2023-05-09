<?php

namespace LuisModule\FullEav\Block\Adminhtml\FullEav\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $data = [
            'label' => __('Guardar y continuar'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 50,
        ];
        return $data;
    }
}