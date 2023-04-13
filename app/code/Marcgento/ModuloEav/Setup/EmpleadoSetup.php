<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Eav\Setup\EavSetup;

class EmpleadoSetup extends EavSetup
{
    public function getDefaultEntity()
    {
        $empleadoEntity = \Marcgento\ModuloEav\ResourceModel\Empleados::ENTITY;

        $entities = [
            $empleadoEntity => [
                'entity_model' => 'Marcgento\ModuloEav\ResourceModel\Empleados',
                'table' => $empleadoEntity.'_entity',
                'attributes' => [
                    'deparment_id' => [
                        'type' => 'static',
                    ],
                    'email' => [
                        'type' => 'static',
                    ],
                    'first_name' => [
                        'type' => 'static',
                    ],
                    'last_name' => [
                        'type' => 'static',
                    ],
                ],
            ],
        ];
        return $entities;
    }
}