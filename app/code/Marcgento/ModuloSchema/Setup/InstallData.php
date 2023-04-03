<?php


namespace Marcgento\ModuloSchema\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Marcgento\ModuloSchema\Model\TablaCustomFactory;

class InstallData implements InstallDataInterface
{
    /**
     * TablaCustomFactory
     */
    private $tablaCustomFactory;

    /**
     * init
     * 
     * @param tablaCustomFactory $tablaCustomFactory
     */
    public function __construct(TablaCustomFactory $tablaCustomFactory)
    {
        $this->tablaCustomFactory = $tablaCustomFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppreeWarnings(PHPMD.ExcessiveMethidLenght)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $tablaCustomData = [
            'nombre' => 'Luis Alamillo',
            'is_visible' => 1
        ];
        /**
         * Insert tablaCustom data
         */
        $this->createTablaCustom()->setData($tablaCustomData)->save();
    }

    /**
     * Create register tablaCustom
     * 
     * @return TablaCustom
     */
    public function createTablaCustom()
    {
        return $this->tablaCustomFactory->create();
    }
}