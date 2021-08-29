<?php

namespace VendoreName\AddConditionFiled\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $customConditionModel;

    public function __construct(
        Action\Context $context,
        \VendoreName\AddConditionFiled\Model\CustomConditionFactory $customConditionModel
    ) {
        parent::__construct($context);
        $this->customConditionModel = $customConditionModel;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('rule_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->customConditionModel->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The rule is deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['rule_id' => $id]);
            }
        }
        $this->messageManager->addError(__('The rule does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
