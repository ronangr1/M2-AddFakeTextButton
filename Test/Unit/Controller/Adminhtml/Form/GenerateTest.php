<?php declare(strict_types=1);
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Test\Unit\Controller\Adminhtml\Form;

use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Webapi\Rest\Request as RestRequest;
use PHPUnit\Framework\MockObject\MockObject;
use Ronangr1\AddFakeTextButton\Controller\Adminhtml\Form\Generate;

class GenerateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var JsonFactory|MockObject
     */
    private $resultJsonFactoryMock;
    /**
     * @var Json|MockObject
     */
    private $resultJsonMock;
    /**
     * @var RestRequest|MockObject
     */
    private $requestMock;

    /**
     * @var Generate
     */
    private $generate;

    public function setUp(): void
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->requestMock = $this->createPartialMock(RestRequest::class, ['getBodyParams']);
        $this->resultJsonFactoryMock = $this->createPartialMock(JsonFactory::class, ['create']);
        $this->resultJsonMock = $this->createPartialMock(Json::class, ['setData']);

        $this->generate = $objectManager->getObject(
            Generate::class,
            [
                'request' => $this->requestMock,
                'resultJson' => $this->resultJsonMock,
                'resultJsonFactory' => $this->resultJsonFactoryMock
            ]
        );
    }

    /**
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function testExecute()
    {
        $params = [
            'title' => true,
            'text' => false
        ];

        $this->requestMock
            ->expects($this->atLeastOnce())
            ->method('getBodyParams')
            ->willReturn(json_encode($params));

        $this->assertEquals(json_encode($params), $this->requestMock->getBodyParams());

        $data = [
            'title' => 'Et magnam ex et esse',
            'text' => 'Doloribus tenetur sapiente ullam velit et doloribus voluptatem. Quo ratione voluptatum dignissimos numquam cum est quisquam.'
        ];

        $this->resultJsonFactoryMock
            ->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($this->resultJsonMock);

        $this->resultJsonMock->expects($this->once())
            ->method('setData')
            ->willReturn($data);

        $this->assertEquals($data, $this->generate->execute());
    }
}
