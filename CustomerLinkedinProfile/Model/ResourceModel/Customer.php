<?php
/**
 * Copyright © Redbox, Inc. All rights reserved.
 *
 */
namespace Redbox\CustomerLinkedinProfile\Model\ResourceModel;
use Magento\Framework\Validator\Exception as ValidatorException;
use Magento\Framework\Exception\AlreadyExistsException;

/**
 * Customer entity resource model
 *
 */
class Customer extends \Magento\Customer\Model\ResourceModel\Customer
{
    /**
     * @var \Magento\Framework\Validator\Factory
     */
    protected $_validatorFactory;

    /**
     * Core store config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $dateTime;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;


    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    /**
     * @param \Magento\Eav\Model\Entity\Context $context
     * @param \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot
     * @param \Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite $entityRelationComposite
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Validator\Factory $validatorFactory
     * @param \Magento\Framework\Stdlib\DateTime $dateTime
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        \Magento\Eav\Model\Entity\Context $context,
        \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot,
        \Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite $entityRelationComposite,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Validator\Factory $validatorFactory,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        $data = []
    ) {
        parent::__construct($context, $entitySnapshot, $entityRelationComposite,$scopeConfig,$validatorFactory, $dateTime,$storeManager,$data);
        $this->customerSession = $customerSession;
    }

    /**
     * Check customer scope, email and confirmation key before saving
     *
     * @param \Magento\Framework\DataObject $customer
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _beforeSave(\Magento\Framework\DataObject $customer)
    {
        /** @var \Magento\Customer\Model\Customer $customer */
        $linkedInUrl = "";
        if(!empty($this->customerSession->getLinkedInUrl())){
            $linkedInUrl = $this->customerSession->getLinkedInUrl();
            $customer->setLinkedinProfile($linkedInUrl);
        }
        parent::_beforeSave($customer);
    }


}
