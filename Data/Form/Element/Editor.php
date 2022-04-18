<?php declare(strict_types=1);
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Data\Form\Element;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Escaper;
use Magento\Framework\Math\Random;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

class Editor extends \Magento\Framework\Data\Form\Element\Editor
{

    /**
     * @var SecureHtmlRenderer
     */
    private $secureRenderer;

    private ScopeConfigInterface $scopeConfig;


    /**
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param array $data
     * @param Json|null $serializer
     * @param Random|null $random
     * @param SecureHtmlRenderer|null $secureRenderer
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Factory                                      $factoryElement,
        CollectionFactory                            $factoryCollection,
        Escaper                                      $escaper,
                                                     $data = [],
        Json $serializer = null,
        ?Random                                      $random = null,
        ?SecureHtmlRenderer                          $secureRenderer = null,
        ScopeConfigInterface                         $scopeConfig
    )
    {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data, $serializer, $random, $secureRenderer);
        $this->secureRenderer = $secureRenderer ?? ObjectManager::getInstance()->get(SecureHtmlRenderer::class);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _getPluginButtonsHtml($visible = true): string
    {
        $html = parent::_getPluginButtonsHtml($visible);
        if ($this->isFakeTextButtonEnable()) {
            $childHtml = '';
            if ($this->getConfig('add_faketext')) {

                $buttonData = [
                    'title' => $this->translate('Insert Fake Text...'),
                    '@click' => "isModalOpen = true",
                    'class' => 'action-add-faketext plugin',
                    'style' => $visible ? '' : 'display:none',
                ];

                $childHtml .= $this->secureRenderer->renderTag('button', $buttonData, $buttonData['title']);

                $html .= $childHtml;
            }
        }

        return $html;
    }

    private function isFakeTextButtonEnable(): bool
    {
        return $this->scopeConfig->getValue('fake_text/general/enable', ScopeConfigInterface::SCOPE_TYPE_DEFAULT) == 1;
    }
}
