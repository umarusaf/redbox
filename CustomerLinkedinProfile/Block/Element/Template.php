<?php
namespace Redbox\CustomerLinkedinProfile\Block\Element;
use Redbox\CustomerLinkedinProfile\Helper\Data;
class Template extends \Magento\Framework\View\Element\Template{
    /**
     * @var Data
     */
    protected $context;
    /**
     * @var Data
     */
    protected $customerSession;
    /**
     * @var Data
     */
    protected $objectManager;
    /**
     * @var Data
     */
    protected $helper;
    /**
     * @var ProductAttributeRepository
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = [],
        Data $helper
    ) {
        parent::__construct($context, $data);
        $this->helper = $helper;
    }

    /**
     * @return bool
     */
    public function getLinkedInStatus()
    {
        return $this->helper->getLinkedInStatus();
    }
    /**
     * @return bool
     */
    public function getValidation(){
        $val = $this->getLinkedInStatus();
        if($val == '1'){
            return 'false';
        }else if($val == '2') {
            return '';
        }else{
            return 'true';
        }
    }
}