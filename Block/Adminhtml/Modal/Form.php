<?php declare(strict_types=1);
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Block\Adminhtml\Modal;

class Form extends \Magento\Backend\Block\Template
{
    protected $_template = "Ronangr1_AddFakeTextButton::modal.phtml";

    public function getUrlAction(): string
    {
        return $this->getUrl('fake_text/form/generate', ['form_key' => $this->getFormKey()]);
    }
}
