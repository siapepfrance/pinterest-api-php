<?php
/**
 * Copyright 2021 SIAPEP France
 *
 * (c) SIAPEP France <contact@siapep.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest\Endpoints;

use SiapepFrance\Pinterest\Models\Pin;
use SiapepFrance\Pinterest\Models\Collection;

class Pins extends Endpoint {

    /**
     * Get a pin object
     *
     * @access public
     * @param  string   $pinId
     * @param array     $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Pin
     */
    public function get($pinId, array $data = [])
    {
        $response = $this->request->get(sprintf("pins/%s", $pinId), $data);
        return new Pin($this->master, $response);
    }

    /**
     * Get all pins from the given board
     *
     * @access public
     * @param  string   $boardId
     * @param array     $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function fromBoard($boardId, array $data = [])
    {
        $response = $this->request->get(sprintf("boards/%s/pins", $boardId), $data);
        return new Collection($this->master, $response, "Pin");
    }

    /**
     * Create a pin
     *
     * @access public
     * @param  array    $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Pin
     */
    public function create(array $data)
    {
        $headers = $this->getDefaultHeaders();
        $response = $this->request->post("pins", $data, $headers);
        return new Pin($this->master, $response);
    }

    /**
     * Edit a pin
     *
     * @access public
     * @param  string   $pinId
     * @param  array    $data
     * @param  string   $fields
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Pin
     */
    public function edit($pinId, array $data, $fields = null)
    {
        $query = (!$fields) ? array() : array("fields" => $fields);
        $headers = $this->getDefaultHeaders();
        $response = $this->request->update(sprintf("pins/%s", $pinId), $data, $query, $headers);
        return new Pin($this->master, $response);
    }

    /**
     * Delete a pin
     *
     * @access public
     * @param  string   $pinId
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return boolean
     */
    public function delete($pinId)
    {
        $this->request->delete(sprintf("pins/%s", $pinId));
        return true;
    }
}
