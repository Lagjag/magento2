<?php


namespace Marcgento\ModuloEav\Model\ResourceModel\Empleados;


class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Marcgento\ModuloEav\Model\Empleados',
            'Marcgento\ModuloEav\Model\ResourceModel\Empleados'
        );
    }
}