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

use SiapepFrance\Pinterest\Models\Section;
use SiapepFrance\Pinterest\Models\Collection;

class Sections extends Endpoint {

    /**
     * Create a section
     *
     * @access public
     * @param  string   $boardId
     * @param  array    $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Section
     */
    public function create(string $boardId, array $data)
    {
        $headers = $this->getDefaultHeaders();
        $response = $this->request->post(sprintf("boards/%s/sections", $boardId), $data, $headers);
        return new Section($this->master, $response);
    }

    /**
     * Update a section
     *
     * @access public
     * @param  string   $boardId
     * @param  string   $sectionId
     * @param  array    $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Section
     */
    public function update(string $boardId, string $sectionId, array $data)
    {
        $headers = $this->getDefaultHeaders();
        $response = $this->request->put(sprintf("boards/%s/sections/%s", $boardId, $sectionId), $data, $headers);
        return new Section($this->master, $response);
    }

    /**
     * Get sections for the given board
     *
     * @access public
     * @param  string   $boardId
     * @param  array    $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Collection<Section>
     */
    public function get(string $boardId, array $data = [])
    {
        $response = $this->request->get(sprintf("boards/%s/sections", $boardId), $data);
        return new Collection($this->master, $response, "Section");
    }

    /**
     * Get pins for section
     *
     * @access public
     * @param  string   $boardId
     * @param  string   $sectionId
     * @param  array    $data
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Collection<Pin>
     */
    public function pins(string $boardId, string $sectionId, array $data = [])
    {
        $response = $this->request->get(sprintf("boards/%s/sections/%s/pins", $boardId, $sectionId), $data);
        return new Collection($this->master, $response, "Pin");
    }

    /**
     * Delete a board's section
     *
     * @access public
     * @param  string   $boardId
     * @param  string   $sectionId
     * @throws \SiapepFrance\Pinterest\Exceptions\PinterestException
     * @return Collection<Pin>
     */
    public function delete($boardId, $sectionId)
    {
        $this->request->delete(sprintf("boards/%s/sections/%s", $boardId, $sectionId));
        return true;
    }
}