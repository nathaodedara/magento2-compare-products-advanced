<?php

namespace Natha\CompareAdvanced\Plugin\Compare;

use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Catalog\Helper\Product\Compare;
use Natha\CompareAdvanced\Helper\Data;

class LimitItems
{
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /** @var Compare */
    protected $helper;

    /** @var Data */
    protected $myHelper;

    /**
     * RestrictCustomerEmail constructor.
     * @param Compare $helper
     * @param RedirectFactory $redirectFactory
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        RedirectFactory $redirectFactory,
        Compare $helper,
        Data $myHelper,
        ManagerInterface $messageManager
    )
    {
        $this->helper = $helper;
        $this->myHelper = $myHelper;
        $this->resultRedirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
    }

     public function aroundExecute(
    \Magento\Catalog\Controller\Product\Compare\Add $subject,
    \Closure $proceed
    ){
        $count = $this->helper->getItemCount() + 1;
        if($this->myHelper->getItemLimit() && $count > $this->myHelper->getItemLimit()) {
            $this->messageManager->addErrorMessage(
            __($this->myHelper->getErrorMsg())
            );

            /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setRefererOrBaseUrl();
        }

        return $proceed();
   }
}