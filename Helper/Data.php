<?php
/**
 * Copyright © Natha Odedara, All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Natha\CompareAdvanced\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    const ITEM_LIMIT = 'catalog/recently_products/natha_limit_compare_product';

    const ERR_MSG = 'catalog/recently_products/natha_limit_compare_err_msg';

    const ENABLE_DISABLE_PATH = 'catalog/recently_products/natha_disable_compare_option';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function getItemLimit() {
        return $this->scopeConfig->getValue(self::ITEM_LIMIT, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getErrorMsg() {
        $msg = $this->scopeConfig->getValue(self::ERR_MSG, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if(!$msg || empty($msg)) {
            $msg = "You can add the compared products under %i% items.";
        }
        return str_replace("%i%",$this->getItemLimit(), $msg);
    }

    public function isEnabled() {
        return $this->scopeConfig->getValue(self::ENABLE_DISABLE_PATH, 
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}





