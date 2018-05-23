<?php
/**
 * Copyright © Redbox, Inc. All rights reserved.
 *
 */
namespace Redbox\CustomerLinkedinProfile\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Redbox\CustomerLinkedinProfile\Helper\Data;
class ConfigObserver implements ObserverInterface
{

    /**
     * @var Data
     */
    protected $helper;
    /**
     * @var ProductAttributeRepository
     */

    public function __construct( Data $helper
    ) {
        $this->helper = $helper;
    }

    public function execute(EventObserver $observer)
    {
        $val = $this->getLinkedInStatus();
        $attributeCode = 'linkedin_profile';
        $entityType = 'customer';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $attributeInfo = $objectManager->get(\Magento\Eav\Model\Entity\Attribute::class)
            ->loadByCode($entityType, $attributeCode);
        if($val == '1' || $val == '2'){
            $attributeInfo->setIsRequired('0');
        }else{
            $attributeInfo->setIsRequired('1');
        }
        $attributeInfo->save();
    }
    /**
     * @return bool
     */
    public function getLinkedInStatus()
    {
        return $this->helper->getLinkedInStatus();
    }
}
