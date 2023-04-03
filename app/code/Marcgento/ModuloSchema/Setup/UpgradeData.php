<?php


namespace Marcgento\ModuloSchema\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Marcgento\ModuloSchema\Model\TablaCustom;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * TablaCustom factory
     * 
     * @var TablaCustom
     */
    protected $_modelCustom;

    /**
     * init
     * 
     * @param tablaCustom $tablaCustom
     */
    public function __construct(TablaCustom $modelCustom)
    {
        $this->_modelCustom = $modelCustom;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethidLenght)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        if(version_compare($context->getVersion(),'1.0.3','<')){
            $id = 1;
            $this->updateTablaCustom($installer,$id);
            $this->insertTablaCustom();
        }
    }

    /**
     * Update tablaCustom
     * 
     * @return TablaCustom
     */
    public function updateTablaCustom($installer, $id)
    {
        if($installer->getTableRow($installer->getTable('marcgento_tablacustom'), 'entity_id', $id)){
            $installer->updateTableRow(
                $installer->getTable('marcgento_tablacustom'),
                'entity_id',
                $id,
                'nombre',
                'Luis Ala'
            );
        }
    }

    /**
     * Insert tablaCustom
     * 
     * @return TablaCustom
     */
    public function insertTablaCustom()
    {
        $tablaCustomData = [
            'nombre' => 'Carlota Carlota',
            'is_visible' => 0
        ];
        $this->_modelCustom->setData($tablaCustomData)->save();
    }
}