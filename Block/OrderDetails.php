<?php

namespace Commerce365\Orders\Block;

use Commerce365\Core\Service\GetSalesDocument;
use Commerce365\Core\Service\SalesDocumentInterface;
use Commerce365\Orders\Service\GetOrderStatus;
use Magento\Framework\Phrase;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Module\Manager as ModuleManager;

class OrderDetails extends Template
{
    private GetSalesDocument $getSalesDocument;
    private GetOrderStatus $getOrderStatus;
    private ModuleManager $moduleManager;

    /**
     * @param Context $context
     * @param GetSalesDocument $getSalesDocument
     * @param GetOrderStatus $getOrderStatus
     * @param ModuleManager $moduleManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        GetSalesDocument $getSalesDocument,
        GetOrderStatus $getOrderStatus,
        ModuleManager $moduleManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalesDocument = $getSalesDocument;
        $this->getOrderStatus = $getOrderStatus;
        $this->moduleManager = $moduleManager;
    }

    public function getOrder()
    {
        $query = [
            'tableNo' => SalesDocumentInterface::QUOTE_ORDER_TABLE_NO,
            'documentType' => 1,
            'id' => $this->getRequest()->getParam('id')
        ];

        return $this->getSalesDocument->execute($query);
    }

    /**
     * @param array $order
     * @return Phrase
     */
    public function getOrderStatus(array $order): Phrase
    {
        return $this->getOrderStatus->execute($order);
    }

    public function isModuleEnabled()
    {
      return $this->moduleManager->isEnabled('SendCloud_SendCloud');
    }
}
