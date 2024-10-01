<?php

declare(strict_types=1);

namespace Commerce365\Orders\Service;

use Magento\Framework\Phrase;

class GetOrderStatus
{
    private array $orderStatusMapping = [
        0 => 'Open',
        1 => 'Released',
        2 => 'Pending Approval',
        3 => 'Pending Prepayment'
    ];

    /**
     * @param array $order
     * @return Phrase
     */
    public function execute(array $order): Phrase
    {
        if (!isset($order["Status"])) {
            return __('Not Defined');
        }

        $orderStatus = (int) $order["Status"];
        return !empty($this->orderStatusMapping[$orderStatus]) ?
            __($this->orderStatusMapping[$orderStatus]) : __('Open');
    }
}
