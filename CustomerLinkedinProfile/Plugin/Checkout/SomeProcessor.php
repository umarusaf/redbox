<?php
/**
 * Copyright © Redbox, Inc. All rights reserved.
 *
 */

namespace Redbox\CustomerLinkedinProfile\Plugin\Checkout;

use Redbox\CustomerLinkedinProfile\Helper\Data;
class SomeProcessor
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
    /**
     * Checkout LayoutProcessor after process plugin.
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $processor, $jsLayout)
    {
        if($this->getLinkedInStatus() == '0' || $this->getLinkedInStatus() == '1'){
            $customAttributeCode = 'custom_field';
            $customField = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    // customScope is used to group elements within a single form (e.g. they can be validated separately)
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'tooltip' => [
                        'description' => 'this is what the field is for',
                    ],
                ],
                'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
                'label' => 'LinkedIn Profile Url',
                'provider' => 'checkoutProvider',
                'sortOrder' => 100,
                'validation' => [
                    'required-entry' => $this->getValidation()
                ],
                'options' => [],
                'filterBy' => null,
                'customEntry' => null,
                'visible' => true,
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;
        }

        return $jsLayout;
    }
    /**
     * @return bool
     */
    public function getValidation(){
        $val = $this->getLinkedInStatus();
        if($val == '1' || $val == '2'){
            return false;
        }else{
            return true;
        }
    }
    /**
     * @return bool
     */
    public function getLinkedInStatus()
    {
        return $this->helper->getLinkedInStatus();
    }
}