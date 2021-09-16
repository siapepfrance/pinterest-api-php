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

class CollectionTest extends \PHPUnit\Framework\TestCase
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
     * @responsefile    boardsPageOne
     */
    public function testIfCollectionAllReturnsItems()
    {
        $response = $this->pinterest->boards->listBoards();

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertTrue(is_array($response->all()));
    }

    /**
     * @responsefile    boardsPageOne
     */
    public function testIfCollectionGetReturnsCorrectBoard()
    {
        $response = $this->pinterest->boards->listBoards();

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Board", $response->get(1));
        $this->assertEquals($response->get(1)->id, "1234567890");
    }

    /**
     * @responsefile    boardsPageOne
     */
    public function testIfCollectionDecodesToJson()
    {
        $response = $this->pinterest->boards->listBoards();

        $this->assertTrue(is_string($response->toJson()));
    }

    /**
     * @responsefile    boardsPageOne
     */
    public function testIfCollectionDecodesToArray()
    {
        $response = $this->pinterest->boards->listBoards();

        $this->assertTrue(is_array($response->toArray()));
    }
}
