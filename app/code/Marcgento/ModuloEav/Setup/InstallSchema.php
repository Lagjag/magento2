<?php


namespace Marcgento\ModuloEav\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /* Script tables */
        /*Table Departamentos */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable('marcgento_departamento'))
                        ->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
                            'Entity ID'
                        )
                        ->addColumn(
                            'name',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                            64,
                            [],
                            'Name'
                        )
                        ->setComment('Table de Departamentos de Area');

        $setup->getConnection()->createTable($table);

        /* Table Empleados Entity */
        /* _entity */
        $empleadosEntity = \Marcgento\ModuloEav\Model\Empleados::ENTITY;
        $table = $setup->getConnection()
                    ->newTable($setup->getTable($empleadosEntity.'_entity'))
                    ->addColumn(
                        'entity_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
                        'Entity ID'
                    )->addColumn(
                        'department_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        ['unsigned'=>true,'nullable'=>false],
                        'Departamento ID'
                    )->addColumn(
                        'email',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'Email'
                    )->addColumn(
                        'first_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'First Name'
                    )->addColumn(
                        'last_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        64,
                        [],
                        'Last Name'
                    )->setComment('Marcgento Departamento Table Base Entity');
            $setup->getConnection()->createTable($table);
        /* _entity_int */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable($empleadosEntity.'_entity_int'))
                        ->addColumn(
                            'value_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'nullable'=>false,'primary'=>true],
                            'Value ID'
                        )->addColumn(
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Attribute ID'
                        )->addColumn(
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Store ID'
                        )->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Entity ID'
                        )->addColumn(
                            'value',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            [],
                            'Value'
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_int',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['entity_id','attribute_id','store_id'],
                            ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_int',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['attribute_id']
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_int',['store_id']),
                            ['store_id']
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_int','attribute_id','eav_attribute','attribute_id'),
                            'attribute_id',
                            $setup->getTable('eav_attribute'),
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_int','entity_id',$empleadosEntity.'_entity','entity_id'),
                            'entity_id',
                            $setup->getTable($empleadosEntity.'_entity'),
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_int','store_id','store','store_id'),
                            'store_id',
                            $setup->getTable('store'),
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->setComment('Marcgento Empleados Integer Attribute Backend Table');
            $setup->getConnection()->createTable($table);
        /* _entity_datetime */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable($empleadosEntity.'_entity_datetime'))
                        ->addColumn(
                            'value_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'nullable'=>false,'primary'=>true],
                            'Value ID'
                        )->addColumn(
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Attribute ID'
                        )->addColumn(
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Store ID'
                        )->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Entity ID'
                        )->addColumn(
                            'value',
                            \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                            null,
                            [],
                            'Value'
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_datetime',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['entity_id','attribute_id','store_id'],
                            ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_datetime',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['attribute_id']
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_datetime',['store_id']),
                            ['store_id']
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_datetime','attribute_id','eav_attribute','attribute_id'),
                            'attribute_id',
                            $setup->getTable('eav_attribute'),
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_datetime','entity_id',$empleadosEntity.'_entity','entity_id'),
                            'entity_id',
                            $setup->getTable($empleadosEntity.'_entity'),
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_datetime','store_id','store','store_id'),
                            'store_id',
                            $setup->getTable('store'),
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )
                        ->setComment('Marcgento Empleados Datetime Attribute Backend Table');
            $setup->getConnection()->createTable($table);
        /* _entity_decimal */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable($empleadosEntity.'_entity_decimal'))
                        ->addColumn(
                            'value_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'nullable'=>false,'primary'=>true],
                            'Value ID'
                        )->addColumn(
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Attribute ID'
                        )->addColumn(
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Store ID'
                        )->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Entity ID'
                        )->addColumn(
                            'value',
                            \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                            '12,4',
                            [],
                            'Value'
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_decimal',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['entity_id','attribute_id','store_id'],
                            ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_decimal',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['attribute_id']
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_decimal',['store_id']),
                            ['store_id']
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_decimal','attribute_id','eav_attribute','attribute_id'),
                            'attribute_id',
                            $setup->getTable('eav_attribute'),
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_decimal','entity_id',$empleadosEntity.'_entity','entity_id'),
                            'entity_id',
                            $setup->getTable($empleadosEntity.'_entity'),
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_decimal','store_id','store','store_id'),
                            'store_id',
                            $setup->getTable('store'),
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->setComment('Marcgento Empleados Decimal Attribute Backend Table');
            $setup->getConnection()->createTable($table);
        /* _entity_varchar */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable($empleadosEntity.'_entity_varchar'))
                        ->addColumn(
                            'value_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'nullable'=>false,'primary'=>true],
                            'Value ID'
                        )->addColumn(
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Attribute ID'
                        )->addColumn(
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Store ID'
                        )->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Entity ID'
                        )->addColumn(
                            'value',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                            255,
                            [],
                            'Value'
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_varchar',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['entity_id','attribute_id','store_id'],
                            ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_varchar',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['attribute_id']
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_varchar',['store_id']),
                            ['store_id']
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_varchar','attribute_id','eav_attribute','attribute_id'),
                            'attribute_id',
                            $setup->getTable('eav_attribute'),
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_varchar','entity_id',$empleadosEntity.'_entity','entity_id'),
                            'entity_id',
                            $setup->getTable($empleadosEntity.'_entity'),
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_varchar','store_id','store','store_id'),
                            'store_id',
                            $setup->getTable('store'),
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->setComment('Marcgento Empleados Varchar Attribute Backend Table');
            $setup->getConnection()->createTable($table);
        /* _entity_text */
        $table = $setup->getConnection()
                        ->newTable($setup->getTable($empleadosEntity.'_entity_text'))
                        ->addColumn(
                            'value_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['identity'=>true,'nullable'=>false,'primary'=>true],
                            'Value ID'
                        )->addColumn(
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Attribute ID'
                        )->addColumn(
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Store ID'
                        )->addColumn(
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                            null,
                            ['unsigned'=>true,'nullable'=>false,'default'=>'0'],
                            'Entity ID'
                        )->addColumn(
                            'value',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                            '64k',
                            [],
                            'Value'
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_text',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['entity_id','attribute_id','store_id'],
                            ['type'=>\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_text',['entity_id','attribute_id','store_id'],\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                            ['attribute_id']
                        )->addIndex(
                            $setup->getIdxName($empleadosEntity.'_entity_text',['store_id']),
                            ['store_id']
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_text','attribute_id','eav_attribute','attribute_id'),
                            'attribute_id',
                            $setup->getTable('eav_attribute'),
                            'attribute_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_text','entity_id',$empleadosEntity.'_entity','entity_id'),
                            'entity_id',
                            $setup->getTable($empleadosEntity.'_entity'),
                            'entity_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->addForeignKey(
                            $setup->getFkName($empleadosEntity.'_entity_text','store_id','store','store_id'),
                            'store_id',
                            $setup->getTable('store'),
                            'store_id',
                            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                        )->setComment('Marcgento Empleados Text Attribute Backend Table');
            $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}