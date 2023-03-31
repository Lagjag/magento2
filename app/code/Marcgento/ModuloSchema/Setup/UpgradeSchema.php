<?php


namespace Marcgento\ModuloSchema\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * 
     * dropTable( tableName, schemaName )
     * renameTable( oldTableName, newTableName, schemaName )
     * addColumn( tableName, columnName, definition [ type, Lenght, Default, Nullable, Identify/Auto_Increment, Comment, After], schemaName )
     * changeColumn( tableName, oldColumnName, newColumnName, definition, flushDate, schemaName )
     * modifyColumn( tableName, columnName, schemaName )
     * dropColumn( tableName, ColumnName, schemaName )
     * addIndex( tableName, indexName, fields, indexType[INDEX_TYPE_PRIMARY, INDEX_TYPE_UNIQUE, INDEX_TYPE_INDEX, INDEX_TYPE_FULLTEXT], schemaName )
     * dropIndex( tableName, indexName, schemaName )ç
     * addForeignKey( fkName, tableName, columnName, refTableName, refColumnName, OnDelete, purge, schemaName, refSchemaName )
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if(version_compare($context->getVersion(),'1.0.1','<')){
            $connection = $setup->getConnection();

            $column = [
                'type' => Table::TYPE_SMALLINT,
                'lenght' => 6,
                'nullable' => false,
                'comment' => 'Is Visible',
                'default' => '1'
            ];

            $connection->addColumn($setup->getTable('marcgento_tablacustom'),'is_visible',$column);
        }
        $setup->endSetup();
    }
}