<?php
/**
 * Copyright © Natha Odedara, All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Natha\CompareAdvanced\Observer;

use Natha\CompareAdvanced\Helper\Data;

class LayoutLoadBefore implements \Magento\Framework\Event\ObserverInterface
{

    protected $helper;

    public function __construct(
        Data $helper
    )
    {
        $this->helper = $helper;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        if($this->helper->isEnabled()) {        
            $layout = $observer->getLayout();
            $layout->getUpdate()->addHandle('natha_remove_comparison_blocks'); 
        }
        return $this;
    }
}

