<?php


namespace Marcgento\ModuloEav\Model\ResourceModel\Departamento;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Marcgento\ModuloeEav\Model\Departamento',
            'Marcgento\ModuloEav\Model\ResourceModel\Departamento'
        );
    }
}