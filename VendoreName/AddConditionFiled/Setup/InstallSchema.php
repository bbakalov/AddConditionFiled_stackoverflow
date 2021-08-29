<?php

namespace VendoreName\AddConditionFiled\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('VendoreName_custom_condition')) {
            $tableName = $installer->getTable('VendoreName_custom_condition');
            $table = $installer->getConnection()
                               ->newTable($tableName)
                               ->addColumn(
                                   'rule_id',
                                   Table::TYPE_INTEGER,
                                   10,
                                   [
                                       'identity' => true,
                                       'nullable' => false,
                                       'primary' => true,
                                   ],
                                   'Rule ID'
                               )
                               ->addColumn(
                                   'rule_status',
                                   Table::TYPE_INTEGER,
                                   null,
                                   [
                                       'nullable' => true,
                                       'default' => null,
                                   ],
                                   'Rule Status'
                               )
                               ->addColumn(
                                   'rule_name',
                                   Table::TYPE_TEXT,
                                   255,
                                   [
                                       'nullable' => true,
                                       'default' => null,
                                   ],
                                   'Rule Name'
                               )
                               ->addColumn(
                                   'conditions_serialized',
                                   Table::TYPE_TEXT,
                                   '2M',
                                   [],
                                   'Conditions Serialized'
                               )
                               ->addColumn(
                                   'actions_serialized',
                                   Table::TYPE_TEXT,
                                   '2M',
                                   [],
                                   'Actions Serialized'
                               )
                               ->addColumn(
                                   'create_date',
                                   \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                   null,
                                   [
                                       'nullable' => false,
                                       'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT,
                                   ],
                                   'Create Date Time'
                               )
                               ->setComment('VendoreName Demo For Condition Field')
                               ->setOption('type', 'InnoDB')
                               ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
