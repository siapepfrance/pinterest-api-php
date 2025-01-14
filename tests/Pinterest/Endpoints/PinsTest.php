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

class PinsTest extends \PHPUnit\Framework\TestCase
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
        $response = $this->pinterest->pins->get("813744226420795884");

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Pin", $response);
        $this->assertEquals($response->id, "813744226420795884");
    }

    public function testFromBoard()
    {
        $response = $this->pinterest->pins->fromBoard("813744226420795884");

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Pin", $response->get(0));
    }

    public function testCreate()
    {
        $response = $this->pinterest->pins->create(array(
            "title"         => "Test pin from API wrapper",
            "description"   => "Test description pin from API wrapper",
            "link"          => "https://www.pinterest.com/",
            "media_source"  => [
                "source_type" => "image_url",
                "url" => "https://download.unsplash.com/photo-1438216983993-cdcd7dea84ce"
            ],
            "board_id"      => "813744226420795884"
        ));

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Pin", $response);
        $this->assertEquals($response->id, "813744226420795884");
    }

    public function testEdit()
    {
        $response = $this->pinterest->pins->edit("813744226420795884", array(
            "title"      => "Test pin from API wrapper - update"
        ));

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Pin", $response);
        $this->assertEquals($response->id, "813744226420795884");
    }

    public function testDelete()
    {
        $response = $this->pinterest->pins->delete("813744226420795884");

        $this->assertTrue($response);
    }
}
