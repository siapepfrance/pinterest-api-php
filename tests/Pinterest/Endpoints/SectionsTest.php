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

class SectionsTest extends \PHPUnit\Framework\TestCase
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

    public function testGet()
    {
        $response = $this->pinterest->sections->get("503066289565421201");

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Section", $response->get(0));
        $this->assertEquals($response->get(0)->id, "549755885175");
    }

    public function testPins()
    {
        $response = $this->pinterest->sections->pins("123456789", "503066289565421201");

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Pin", $response->get(0));
    }

    public function testCreate()
    {
        $response = $this->pinterest->sections->create("503066289565421205", array(
            "title" => "Test from API"
        ));

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Section", $response);
        $this->assertEquals($response->id, "549755885175");
    }

    public function testDelete()
    {
        $response = $this->pinterest->sections->delete("123456789", "5027630990032422748");

        $this->assertTrue($response);
    }
}
