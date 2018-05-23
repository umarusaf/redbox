<?php
/**
 * Package : Redbox
 * Module  : CustomerLinkedinProfile
 * File    : Redbox/CustomerLinkedinProfile/Setup
 * Date    : 17-05-2018
 * Copyright : Copyright (c) 2018
 * @Author  : Dev-2
 * @Company : Redbox
 */

namespace Redbox\CustomerLinkedinProfile\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{

    /**
     * Customer Profile Code
     *
     * @var LinkedinProfile
     */
    const CUSTOMER_Linkined_ATTR = "linkedin_profile";

    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;
    /**
     * Init
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory,\Magento\Framework\App\State $state)
    {
        $this->customerSetupFactory = $customerSetupFactory;
        $state->setAreaCode('frontend');
    }
    /**
     * Installs DB schema for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $entityTypeId = $customerSetup->getEntityTypeId(\Magento\Customer\Model\Customer::ENTITY);
        $customerSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, self::CUSTOMER_Linkined_ATTR);

        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, self::CUSTOMER_Linkined_ATTR,  array(
            "type"     => "varchar",
            "backend"  => "",
            "label"    => "Linkedin Profile",
            "input"    => "text",
            "source"   => "",
            "visible"  => true,
            "required" => true,
            "default" => "",
            "frontend" => "",
            "unique"     => true,
            "note"       => "",
            'validate_rules' => '{"max_text_length":250}',
            'admin_checkout' => 1

        ));

        $customerAttribute   = $customerSetup->getAttribute(\Magento\Customer\Model\Customer::ENTITY, self::CUSTOMER_Linkined_ATTR);

        $customerAttribute = $customerSetup->getEavConfig()->getAttribute(\Magento\Customer\Model\Customer::ENTITY, self::CUSTOMER_Linkined_ATTR);

        /*
         *  Add field in forms for Customer dashboard, customer create account
         *  and checkout page etc.
        */
        $used_in_forms[]="adminhtml_customer";
        $used_in_forms[]="checkout_register";
        $used_in_forms[]="customer_account_create"; // Add Field in Account create form
        $used_in_forms[]="customer_account_edit"; // Add Field in Account edit form
        $used_in_forms[]="adminhtml_checkout";

        /*
         *  Save forms references
        */
        $customerAttribute->setData("used_in_forms", $used_in_forms)
            ->setData("is_used_for_customer_segment", true)
            ->setData("is_system", 0)
            ->setData("is_user_defined", 1)
            ->setData("is_visible", 1)
            ->setData("sort_order", 100);
        $customerAttribute->save();
        $installer->endSetup();
    }
}