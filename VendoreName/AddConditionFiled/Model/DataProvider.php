<?php

declare(strict_types=1);

namespace VendoreName\AddConditionFiled\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use VendoreName\AddConditionFiled\Model\ResourceModel\CustomCondition\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var
     */
    protected $loadedData;

    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->loadedData[$this->collection->getFirstItem()->getId()] = $this->collection->getFirstItem()->getData();

        return $this->loadedData;
    }
}
