<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Marcgento\ModuloEav\Setup\EmpleadoSetupFactory;

class InstallData implements InstallDataInterface
{
    private $empleadoSetupFactory;

    public function __construct(
        EmpleadoSetupFactory $empleadoSetupFactory
    ){
        $this->empleadoSetupFactory = $empleadoSetupFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup, 
        ModuleContextInterface $context)
    {
        $setup->startSetup();

        $empleadoEntity = \Marcgento\ModuloEav\Model\Empleados::ENTITY;
        $empleadoSetup = $this->empleadoSetupFactory->create(['setup'=>$setup]);
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