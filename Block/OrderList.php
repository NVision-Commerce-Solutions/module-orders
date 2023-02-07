<?php

namespace Commerce365\Orders\Block;

use Commerce365\Core\Block\AbstractList;
use Commerce365\Core\Service\GetSalesDocuments;
use Commerce365\Core\Service\SalesDocumentInterface;
use Commerce365\Orders\Service\GetOrderStatus;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template\Context;

class OrderList extends AbstractList
{
    const URL = 'orders/orderlist';
    protected const VIEW_URL = 'orders/orderdetails';

    private GetSalesDocuments $getSalesDocuments;
    private GetOrderStatus $getOrderStatus;

    /**
     * @param Context $context
     * @param GetSalesDocuments $getSalesDocuments
     * @param GetOrderStatus $getOrderStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        GetSalesDocuments $getSalesDocuments,
        GetOrderStatus $getOrderStatus,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalesDocuments = $getSalesDocuments;
        $this->getOrderStatus = $getOrderStatus;
    }

    public function getOrders(): array
    {
        $query = $this->processQuery([
            'tableNo' => SalesDocumentInterface::QUOTE_ORDER_TABLE_NO,
            'documentType' => 1,
        ]);

        return $this->getSalesDocuments->execute($query);
    }

    /**
     * @param array $order
     * @return Phrase
     */
    public function getOrderStatus(array $order): Phrase
    {
        return $this->getOrderStatus->execute($order);
    }
}
