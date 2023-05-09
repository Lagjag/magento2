<?php

namespace LuisModule\FullEav\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
class FullEavActions extends Column {
    /**
    * Url path
    */
    const URL_PATH_EDIT = 'luismodule_fulleav/fulleav/edit';
    const URL_PATH_DELETE = 'luismodule_fulleav/fulleav/delete';
    /**
    * @var UrlInterface
    */
    protected $urlBuilder;
    /**
    * [__construct description]
    * @param ContextInterface   $context            [description]
    * @param UiComponentFactory $uiComponentFactory [description]
    * @param UrlInterface       $urlBuilder         [description]
    * @param array              $components         [description]
    * @param array              $data               [description]
    */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
    * Prepare Data Source
    *
    * @param array $dataSource
    * @return array
    */
    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::URL_PATH_EDIT,
                            ['entity_id' => $item['entity_id'], 'store' => $storeId]
                        ),
                        'label' => __('Edit'),
                        'hidden' => false,
                    ];

                    $item[$this->getData('name')]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(
                            self::URL_PATH_DELETE,
                            ['entity_id' => $item['entity_id'], 'store' => $storeId]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                        'title' => __('Delete ' . $item['main_title']),
                        'message' => __('E¿Estás seguro de que quieres borrar el siguiente registro ' . $item['main_title'] . ' ?'),
                    ],
                    'hidden' => false,
                    ];
                }
            }
        }
        return $dataSource;
    }
}