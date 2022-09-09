<?php

namespace Magenest\Movie\Model\Config\Source;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 1, 'label' => __('show')],
            ['value' => 2, 'label' => __('not-show')],
        ];
    }
}
