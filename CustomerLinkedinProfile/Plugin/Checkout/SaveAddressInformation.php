<?php
/**
 * Copyright © Redbox, Inc. All rights reserved.
 *
 */
namespace Redbox\CustomerLinkedinProfile\Plugin\Checkout;


class SaveAddressInformation
{
    protected $quoteRepository;
    protected $customerSession;
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->customerSession = $customerSession;
    }
    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if (!empty($shippingAddressExtensionAttributes->getCustomField())) {
            $this->customerSession->setLinkedInUrl($shippingAddressExtensionAttributes->getCustomField());
        }

    }
}