<?php

/**
 * Copyright 2015 Dirk Groenen
 *
 * (c) Dirk Groenen <dirk@bitlabs.nl>
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
     * @responsefile    interestsPageOne
     */
    public function testIfCollectionAllReturnsItems()
    {
        $response = $this->pinterest->following->interests();

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertTrue(is_array($response->all()));
    }

    /**
     * @responsefile    interestsPageOne
     */
    public function testIfCollectionGetReturnsCorrectAlbum()
    {
        $response = $this->pinterest->following->interests();

        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Collection", $response);
        $this->assertInstanceOf("SiapepFrance\Pinterest\Models\Interest", $response->get(1));
        $this->assertEquals($response->get(1)->id, "955147773988");
    }

    /**
     * @responsefile    interestsPageOne
     */
    public function testIfCollectionHasNextPage()
    {
        $response = $this->pinterest->following->interests();

        $this->assertTrue($response->hasNextPage());
    }

    /**
     * @responsefile    interestsPageOne
     */
    public function testIfCollectionDecodesToJson()
    {
        $response = $this->pinterest->following->interests();

        $this->assertTrue(is_string($response->toJson()));
    }

    /**
     * @responsefile    interestsPageOne
     */
    public function testIfCollectionDecodesToArray()
    {
        $response = $this->pinterest->following->interests();

        $this->assertTrue(is_array($response->toArray()));
    }
}
