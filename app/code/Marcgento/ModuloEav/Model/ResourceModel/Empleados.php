<?php


namespace Marcgento\ModuloEav\Model\ResourceModel;


class Empleados extends \Magento\Eav\Model\Entity\AbstractEntity
{
    protected function _construct()
    {
        $this->_read = "marcgento_empleados_read";
        $this->_write = "marcgento_empleados_write";
    }

    public function getEntityType()
    {
        if(empty($this->_type)){
            $this->setType(\Marcgento\ModuloEav\Model\Empleados::ENTITY);
        }
        return parent::getEntityType();
    }
}