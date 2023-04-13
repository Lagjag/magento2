<?php


namespace Marcgento\ModuloEav\Model\ResourceModel;


class Departamento extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('marcgento_departamento', 'entity_id');
    }
}