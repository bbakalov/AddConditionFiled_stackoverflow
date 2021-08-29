<?php

namespace VendoreName\AddConditionFiled\Controller\Adminhtml\Index;

use VendoreName\AddConditionFiled\Model\CustomConditionFactory;
use Magento\Backend\App\Action;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $ruledatamodel;
    protected $dataPersistor;
    protected $productCollectionFactory;

    public function __construct(
        Action\Context $context,
        CollectionFactory $productCollectionFactory,
        CustomConditionFactory $ruledatamodel
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->ruledatamodel = $ruledatamodel;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (isset($data['rule']['conditions'])) {
            $data['conditions'] = $data['rule']['conditions'];
        }
        if (isset($data['rule'])) {
            unset($data['rule']);
        }
        try {
            $model = $this->ruledatamodel->create();
            $id = $this->getRequest()->getParam('rule_id');
            if ($id) {
                $model->load($id);
            }
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This rule is no longer exists.'));
                return $resultRedirect->setPath('addconditionfiled/index/index');
            }
            $model->loadPost($data);
            $model->save();
            $this->messageManager->addSuccess(__('Rule has been successfully saved.'));
            if ($this->getRequest()->getParam('back')) {
                if ($this->getRequest()->getParam('back') == 'add') {
                    return $resultRedirect->setPath('addconditionfiled/index/add');
                } else {
                    return $resultRedirect->setPath(
                        'addconditionfiled/index/edit',
                        [
                            'rule_id' => $model->getId(),
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            return $resultRedirect->setPath('addconditionfiled/index/add');
        }
        return $resultRedirect->setPath('addconditionfiled/index/index');
    }
}
