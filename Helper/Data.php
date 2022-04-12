<?php
/**
 * Copyright © Ronan Guérin. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Ronangr1\AddFakeTextButton\Helper;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    private FakerFactory $fakerFactory;
    private FakerGenerator $faker;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param FakerFactory $fakerFactory
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        FakerFactory $fakerFactory
    )
    {
        parent::__construct($context);
        $this->fakerFactory = $fakerFactory;
        $this->faker = $this->fakerFactory->create();
    }

    public function generateFakeTitle(): string
    {
        return $this->faker->words(5, true);
    }

    public function generateFakeText(): string
    {
        return $this->faker->text(500);
    }

}
