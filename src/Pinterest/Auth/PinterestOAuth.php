<?php
/**
 * Copyright 2021 SIAPEP France
 *
 * (c) SIAPEP France <contact@siapep.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest\Auth;

use SiapepFrance\Pinterest\Transport\Request;
use SiapepFrance\Pinterest\Exceptions\PinterestException;

class PinterestOAuth {

    /**
     * The application ID
     *
     * @var string
     */
    private $client_id;

    /**
     * The app secret
     *
     * @var string
     */
    private $client_secret;

    /**
     * Random string indicating the state
     * to prevent spoofing
     *
     * @var void
     */
    private $state;

    /**
     * A reference to the request instance
     *
     * @var Request
     */
    private $request;

    /**
     * The redirect uri
     *
     * @var string
     */
    private $redirect_uri;

    /**
     * Pinterest's oauth endpoint
     */
    const AUTH_HOST = "https://www.pinterest.com/oauth/";

    /**
     * Construct
     *
     * @param  string   $client_id
     * @param  string   $client_secret
     * @param  Request  $request
     */
    public function __construct($client_id, $client_secret, $request)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;

        // Generate and set the state
        $this->state = $this->generateState();

        // Set request instance
        $this->request = $request;
    }

    /**
     * Returns the login url
     *
     * @access public
     * @param  array    $scopes
     * @param  string   $redirect_uri
     * @return string
     */
    public function getLoginUrl($redirect_uri, $scopes = array("read_public"), $response_type = "code")
    {
        $queryparams = array(
            "response_type"     => $response_type,
            "redirect_uri"      => $redirect_uri,
            "client_id"         => $this->client_id,
            "scope"             => implode(",", $scopes),
            "state"             => $this->state
        );

        $this->setRedirectUri($redirect_uri);

        // Build url and return it
        return sprintf('%s?%s', self::AUTH_HOST, http_build_query($queryparams));
    }

    /**
     * @param string $redirect_uri
     * @return PinterestOAuth
     */
    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
        return $this;
    }

    /**
     * Generates a random string and returns is
     *
     * @access private
     * @return string       random string
     */
    private function generateState()
    {
        return substr(md5(rand()), 0, 7);
    }

    /**
     * Get the generated state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set a state manually
     *
     * @param  string    $state
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Change the code for an access_token
     *
     * @param  string   $code
     * @return \SiapepFrance\Pinterest\Transport\Response
     */
    public function getOAuthToken($code)
    {
        // Build data array
        $data = array(
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => $this->redirect_uri
        );

        // Build headers array
        $headers = array(
            'Authorization' => sprintf('Basic %s', base64_encode($this->client_id. ':' .$this->client_secret)),
            'http_build_query' => true,
        );

        // Perform post request
        $response = $this->request->post('oauth/token', $data, $headers);

        return $response;
    }

    /**
     * Change the code for an access_token
     *
     * @param  string   $refresh_token
     * @param  string   $scope
     * @return \SiapepFrance\Pinterest\Transport\Response
     */
    public function refreshOAuthToken($refresh_token, $scope)
    {
        // Build data array
        $data = array(
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refresh_token,
            'scope' => $scope
        );

        // Build headers array
        $headers = array(
            'Authorization' => sprintf('Basic %s', base64_encode($this->client_id. ':' .$this->client_secret)),
            'http_build_query' => true,
        );

        // Perform post request
        $response = $this->request->post('oauth/token', $data, $headers);

        return $response;
    }

    /**
     * Set the access_token for further requests
     *
     * @access public
     * @param  string   $access_token
     * @return void
     */
    public function setOAuthToken($access_token)
    {
        $this->request->setAccessToken($access_token);
    }
}