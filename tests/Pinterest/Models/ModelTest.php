<?php

/**
 * Copyright 2021 SIAPEP France
 *
 * (c) SIAPEP France <contact@siapep.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest\Tests\Endpoints;

use \SiapepFrance\Pinterest\Pinterest;
use \SiapepFrance\Pinterest\Tests\Utils\CurlBuilderMock;

class ModelTest extends \PHPUnit\Framework\TestCase
{

    /**
     * The Pinterest instance
     *
     * @var Pinterest
     */
    private $pinterest;

    /**
     * Setup a new instance of the Pinterest class
     *
     * @return void
     */
    public function setUp(): void
    {
        $curlbuilder = CurlBuilderMock::create($this);

        // Setup Pinterest
        $this->pinterest = new Pinterest("0", "0", $curlbuilder);
        $this->pinterest->auth->setOAuthToken("0");
    }

    /**
     * @responsefile    pin
     */
    public function testIfPinDecodesToJson()
    {
        $response = $this->pinterest->pins->get("181692166190246650");

        $this->assertTrue(is_string($response->toJson()));
    }

    /**
     * @responsefile    pin
     */
    public function testIfPinConvertsToArray()
    {
        $response = $this->pinterest->pins->get("181692166190246650");

        $this->assertTrue(is_array($response->toArray()));
    }
}
