<?php declare(strict_types=1);
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Controller\Adminhtml\Form;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Webapi\Rest\Request;
use Magento\Security\Model\AdminSessionInfo;
use Ronangr1\AddFakeTextButton\Helper\Data;

class Generate extends Action
{
    private JsonFactory $resultJsonFactory;
    private Data $helper;
    private Request $request;
    private AdminSessionInfo $adminSessionInfo;
    private RedirectFactory $redirectFactory;

    /**
     * @param RedirectFactory $redirectFactory
     * @param AdminSessionInfo $adminSessionInfo
     * @param JsonFactory $resultJsonFactory
     * @param Data $helper
     * @param Request $request
     * @param Context $context
     */
    public function __construct(
        RedirectFactory  $redirectFactory,
        AdminSessionInfo $adminSessionInfo,
        JsonFactory      $resultJsonFactory,
        Data             $helper,
        Request          $request,
        Context          $context)
    {
        parent::__construct($context);
        $this->adminSessionInfo = $adminSessionInfo;
        $this->redirectFactory = $redirectFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helper = $helper;
        $this->request = $request;
    }

    public function _isAllowed(): bool
    {
        return true;
    }

    public function execute()
    {
        $data = [];

        if ($this->adminSessionInfo->isSessionExpired()) {
            $data = ['session_timeout' => true];
        }

        $resultJson = $this->resultJsonFactory->create();

        $post = $this->request->getBodyParams();


        if ($post) {
            if (isset($post['title']) && $post['title']) {
                $data['title'] = $this->helper->generateFakeTitle();
            }
            if (isset($post['text']) && $post['text']) {
                $data['text'] = $this->helper->generateFakeText();
            }
        } else {
            $data = ['success' => false];
        }


        return $resultJson->setData($data);
    }
}
