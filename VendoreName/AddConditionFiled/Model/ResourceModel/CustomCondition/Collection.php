<?php

namespace VendoreName\AddConditionFiled\Model\ResourceModel\CustomCondition;

use VendoreName\AddConditionFiled\Model\CustomCondition as CustomConditionModel;
use VendoreName\AddConditionFiled\Model\ResourceModel\CustomCondition as CustomConditionResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            CustomConditionModel::class,
            CustomConditionResourceModel::class
        );
    }
}
