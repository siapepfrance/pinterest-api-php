<?php
/**
 * Copyright 2021 SIAPEP France
 *
 * (c) SIAPEP France <contact@siapep.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest;

use SiapepFrance\Pinterest\Auth\PinterestOAuth;
use SiapepFrance\Pinterest\Utils\CurlBuilder;
use SiapepFrance\Pinterest\Transport\Request;
use SiapepFrance\Pinterest\Exceptions\InvalidEndpointException;

/**
 * @property \SiapepFrance\Pinterest\Endpoints\Boards boards
 * @property \SiapepFrance\Pinterest\Endpoints\Pins pins
 * @property \SiapepFrance\Pinterest\Endpoints\UserAccounts user_accounts
 * @property \SiapepFrance\Pinterest\Endpoints\AdAccounts ad_accounts
 * @property \SiapepFrance\Pinterest\Endpoints\Sections sections
 */
class Pinterest {

    /**
     * Reference to authentication class instance
     *
     * @var Auth\PinterestOAuth
     */
    public $auth;

    /**
     * A reference to the request class which travels
     * through the application
     *
     * @var Transport\Request
     */
    public $request;

    /**
     * A array containing the cached endpoints
     *
     * @var array
     */
    private $cachedEndpoints = [];

    /**
     * Constructor
     *
     * @param  string       $client_id
     * @param  string       $client_secret
     * @param  CurlBuilder  $curlbuilder
     */
    public function __construct($client_id, $client_secret, $curlbuilder = null)
    {
        if ($curlbuilder == null) {
            $curlbuilder = new CurlBuilder();
        }

        // Create new instance of Transport\Request
        $this->request = new Request($curlbuilder);

        // Create and set new instance of the OAuth class
        $this->auth = new PinterestOAuth($client_id, $client_secret, $this->request);
    }

    /**
     * Get an Pinterest API endpoint
     *
     * @access public
     * @param string    $endpoint
     * @return mixed
     * @throws Exceptions\InvalidEndpointException
     */
    public function __get($endpoint)
    {
        $endpoint = str_replace('_', '', ucwords($endpoint, '_'));
        $class = "\\SiapepFrance\\Pinterest\\Endpoints\\" . $endpoint;

        // Check if an instance has already been initiated
        if (!isset($this->cachedEndpoints[$endpoint])) {
            // Check endpoint existence
            if (!class_exists($class)) {
                throw new InvalidEndpointException;
            }

            // Create a reflection of the called class and initialize it
            // with a reference to the request class
            $ref = new \ReflectionClass($class);
            $obj = $ref->newInstanceArgs([$this->request, $this]);

            $this->cachedEndpoints[$endpoint] = $obj;
        }

        return $this->cachedEndpoints[$endpoint];
    }

    /**
     * Get rate limit from the headers
     * response header may change from X-Ratelimit-Limit to X-RateLimit-Limit
     * @access public
     * @return integer
     */
    public function getRateLimit()
    {
        $header = $this->request->getHeaders();
        if (is_array($header)) {
            $header = array_change_key_case($header, CASE_LOWER);
        }
        return (isset($header['x-ratelimit-limit']) ? $header['x-ratelimit-limit'] : 1000);
    }

    /**
     * Get rate limit remaining from the headers
     * response header may change from X-Ratelimit-Remaining to X-RateLimit-Remaining
     * @access public
     * @return mixed
     */
    public function getRateLimitRemaining()
    {
        $header = $this->request->getHeaders();
        if (is_array($header)) {
            $header = array_change_key_case($header, CASE_LOWER);
        }
        return (isset($header['x-ratelimit-remaining']) ? $header['x-ratelimit-remaining'] : 'unknown');
    }
}
