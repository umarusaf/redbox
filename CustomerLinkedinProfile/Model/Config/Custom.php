<?php
namespace Redbox\CustomerLinkedinProfile\Model\Config;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Required')],
            ['value' => 1, 'label' => __('Optional')],
            ['value' => 2, 'label' => __('Invisible')]
        ];
    }
}