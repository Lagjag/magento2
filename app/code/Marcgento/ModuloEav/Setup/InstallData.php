<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $empleadoSetup;

    public function __construct(
        Marcgento\ModuloEav\Setup\EmpleadoSetup $empleadoSetup
    ){
        $this->empleadoSetup = $empleadoSetup;
    }

    public function install(
        ModuleDataSetupInterface $setup, 
        ModuleContextInterface $context)
    {
        $setup->startSetup();

        $empleadoEntity = \Marcgento\ModuloEav\Model\Empleados::ENTITY;
        $empleadoSetup = $this->empleadoSetup->create(['setup'=>$setup]);
        $empleadoSetup->installEntities();
        $empleadoSetup->addAttribute(
            $empleadoEntity,
            'service_years',
            ['type' => 'int']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity,
            'dob',
            ['type' => 'datetime']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity,
            'salary',
            ['type'=>'decimal']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity,
            'vat_number',
            ['type'=>'varchar']
        );
        $empleadoSetup->addAttribute(
            $empleadoEntity,
            'note',
            ['type'=>'text']
        );

        $setup->endSetup();
    }
}