<?php

namespace VendoreName\AddConditionFiled\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomCondition extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('VendoreName_custom_condition', 'rule_id');
    }
}
