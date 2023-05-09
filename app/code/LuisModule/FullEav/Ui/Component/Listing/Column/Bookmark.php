<?php

namespace LuisModule\FullEav\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Api\BookmarkManagementInterface;
use Magento\Ui\Api\BookmarkRepositoryInterface;

class Bookmark extends \Magento\Ui\Component\Bookmark
{
    /**
    * @var \LuisModule\FullEav\Model\FullEav
    */
    protected $fulleav;
    /**
    * [__construct description]
    * @param  ContextInterface                $context            [description]
    * @param  \LuisModule\FullEav\Model\FullEav $fulleav         [description]
    * @param  BookmarkRepositoryInterface     $bookmarkRepository [description]
    * @param  BookmarkManagementInterface     $bookmarkManagement [description]
    * @param  {Array}  array                  $components         [description]
    * @param  {Array}  array                  $data               [description]
    */
    public function __construct(
        ContextInterface $context,
        \LuisModule\FullEav\Model\FullEav $fulleav,
        BookmarkRepositoryInterface $bookmarkRepository,
        BookmarkManagementInterface $bookmarkManagement,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $bookmarkRepository, $bookmarkManagement, $components, $data);
        $this->fulleav = $fulleav;
    }
    /**
    * Register component
    *
    * @return void
    */
    public function prepare()
    {
        $namespace = $this->getContext()->getRequestParam('namespace', $this->getContext()->getNamespace());
        $config = [];

        if (!empty($namespace)) {
            $storeId = $this->getContext()->getRequestParam('store');
            
            if (empty($storeId)) {
                $storeId = $this->getContext()->getFilterParam('store_id');
            }

            $bookmarks = $this->bookmarkManagement->loadByNamespace($namespace);
            /** @var \Magento\Ui\Api\Data\BookmarkInterface $bookmark */
            foreach ($bookmarks->getItems() as $bookmark) {
                if ($bookmark->isCurrent()) {
                    $config['activeIndex'] = $bookmark->getIdentifier();
                }

                $config = array_merge_recursive($config, $bookmark->getConfig());

                if (!empty($storeId)) {
                    $config['current']['filters']['applied']['store_id'] = $storeId;
                }
            }
        }   
    $this->setData('config', array_replace_recursive($config, $this->getConfiguration($this)));
    parent::prepare();
    $jsConfig = $this->getConfiguration($this);
    $this->getContext()->addComponentDefinition($this->getComponentName(), $jsConfig);
    }
}