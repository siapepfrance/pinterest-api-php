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

class BoardsTest extends \PHPUnit\Framework\TestCase
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
        $response = $this->pinterest->boards->get("503066289565421201");

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Board", $response);
        $this->assertEquals($response->id, "503066289565421201");
    }

    public function testCreate()
    {
        $response = $this->pinterest->boards->create(array(
            "name"          => "Test board from API",
            "description"   => "Test Board From API Test"
        ));

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Board", $response);
        $this->assertEquals($response->id, "549755885175");
    }

    public function testEdit()
    {
        $response = $this->pinterest->boards->edit("503066289565421201", array(
            "name"          => "Test board from API"
        ));

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Board", $response);
        $this->assertEquals($response->id, "503066289565421205");
    }

    public function testDelete()
    {
        $response = $this->pinterest->boards->delete("503066289565421205");

        $this->assertTrue($response);
    }
}
