<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        /* Entity Empleados */
        $empleadosEntity = \Marcgento\ModuloEav\Model\Empleados::ENTITY.'_entity';
        $departamentoTable = 'marcgento_departamento'
        
        $setup->getConnection()
            ->addForeignKey(
                $setup->getFkName(
                    $empleadosEntity,
                    'department_id',
                    $departamentoTable,
                    'entity_id'
                ),
                $setup->getTable($empleadosEntity),
                'department_id',
                $setup->getTable($departamentoTable),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );        
        $setup->endSetup();
    }
}