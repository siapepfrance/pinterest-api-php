<?php
/**
 * Copyright 2015 Dirk Groenen
 *
 * (c) Dirk Groenen <dirk@bitlabs.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest\Endpoints;

use SiapepFrance\Pinterest\Transport\Request;
use SiapepFrance\Pinterest\Pinterest;


class Endpoint {

    /**
     * Instance of the request class
     *
     * @var Request
     */
    protected $request;

    /**
     * Instance of the master class
     *
     * @var Pinterest
     */
    protected $master;

    /**
     * Create a new model instance
     *
     * @param  Request              $request
     * @param  Pinterest            $master
     */
    public function __construct(Request $request, Pinterest $master)
    {
        $this->request = $request;
        $this->master = $master;
    }

    /**
     * Create default header configurations
     *
     * @return array
     */
    public function getDefaultHeaders()
    {
        return array(
            'Content-Type' => 'application/json',
            'http_build_query' => false,
        );
    }

}