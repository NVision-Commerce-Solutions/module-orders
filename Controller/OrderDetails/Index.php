<?php

namespace Commerce365\Orders\Controller\OrderDetails;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;

class Index implements ActionInterface
{
    private PageFactory $resultPageFactory;
    private Session $session;
    private RedirectFactory $redirectFactory;

    public function __construct(
        PageFactory $resultPageFactory,
        RedirectFactory $redirectFactory,
        Session $customerSession
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->session = $customerSession;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $resultRedirect = $this->redirectFactory->create();
            $resultRedirect->setPath('customer/account/login');
            return $resultRedirect;
        }

        return $this->resultPageFactory->create();
    }
}
