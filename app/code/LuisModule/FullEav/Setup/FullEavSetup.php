<?php

namespace LuisModule\FullEav\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;

class FullEavSetup extends EavSetup {
    const ENTITY_TYPE_CODE = 'luismodule_fulleav_fulleav';
    const EAV_ENTITY_TYPE_CODE = 'luismodule_fulleav';

    protected function getAttributes() 
    {
        $attributes = [];
        $attributes['main_title'] = [
            'group' => 'General',
            'type' => 'varchar',
            'label' => 'Main Title',
            'input' => 'text',
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'required' => '1',
            'user_defined' => false,
            'default' => '',
            'unique' => false,
            'position' => '10',
            'note' => '',
            'visible' => '1',
            'wysiwyg_enabled' => '0',
        ];
        // Add your more entity attributes here...
        return $attributes;
    }

    public function getDefaultEntities() 
    {
        $entities = [
            self::ENTITY_TYPE_CODE => [
                'entity_model' => 'LuisModule\FullEav\Model\ResourceModel\FullEav',
                'attribute_model' => 'LuisModule\FullEav\Model\ResourceModel\Eav\Attribute',
                'table' => self::ENTITY_TYPE_CODE,
                'increment_model' => null,
                'additional_attribute_table' => 'luismodule_fulleav_eav_attribute',
                'entity_attribute_collection' => 'LuisModule\FullEav\Model\ResourceModel\Attribute\Collection',
                'attributes' => $this->getAttributes(),
            ],
        ];
        return $entities;
    }
}