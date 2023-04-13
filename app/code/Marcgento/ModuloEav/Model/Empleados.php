<?php


namespace Marcgento\ModuloEav\Model;


class Empleados extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = "marcgento_empleados";

    protected function _construct()
    {
        $this->_init('Marcgento\ModuloEav\Model\ResourceModel\Empleados');
    }
}