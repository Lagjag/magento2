<?php

namespace LuisModule\FullEav\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use LuisModule\FullEav\Setup\FullEavSetupFactory;

class InstallData implements InstallDataInterface
{
    protected $fulleavSetupFactory;

    public function __construct(FullEavSetupFactory $fulleavSetupFactory)
    {
        $this->fulleavSetupFactory = $fulleavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $fulleavSetup = $this->fulleavSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $fulleavSetup->installEntities();
        $entities = $fulleavSetup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $fulleavSetup->addEntityType($entityName, $entity);
        }
        $setup->endSetup();
    }
}