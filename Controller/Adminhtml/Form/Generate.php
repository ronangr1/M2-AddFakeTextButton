<?php declare(strict_types=1);
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Controller\Adminhtml\Form;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Webapi\Rest\Request;
use Ronangr1\AddFakeTextButton\Helper\Data;

class Generate extends Action
{
    private JsonFactory $resultJsonFactory;
    private Data $helper;
    private Request $request;

    /**
     * @param JsonFactory $resultJsonFactory
     * @param Data $helper
     * @param Request $request
     * @param Context $context
     */
    public function __construct(
        JsonFactory $resultJsonFactory,
        Data        $helper,
        Request $request,
        Context     $context)
    {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helper = $helper;
        $this->request = $request;
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        $post = $this->request->getBodyParams();

        $data = [];

        if ($post) {
            if (isset($post['title']) && $post['title']) {
                $data['title'] = $this->helper->generateFakeTitle();
            }
            if (isset($post['text']) && $post['text']) {
                $data['text'] = $this->helper->generateFakeText();
            }
        }

        return $resultJson->setData($data);
    }
}
