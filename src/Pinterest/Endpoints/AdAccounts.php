<?php
/**
 * Copyright 2021 SIAPEP France
 *
 * (c) SIAPEP France <contact@siapep.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DirkGroenen\Pinterest\Endpoints;

use DirkGroenen\Pinterest\Models\Collection;

class AdAccounts extends Endpoint {

    /**
     * Get the ad accounts
     *
     * @access public
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function get(array $data = [])
    {
        $response = $this->request->get('ad_accounts', $data);
        return new Collection($this->master, $response, "AdAccount");
    }

    /**
     * Get the ad account analytics
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getAnalytics($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/analytics', $adAccountId), $data);
        return new Collection($this->master, $response, "AdAccountAnalytic");
    }

    /**
     * Get the ad account campaigns
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getCampaigns($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/campaigns', $adAccountId), $data);
        return new Collection($this->master, $response, "AdCampaign");
    }

    /**
     * Get the ad campaign analytics
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getCampaignAnalytics($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/campaigns/analytics', $adAccountId), $data);
        return new Collection($this->master, $response, "AdCampaignAnalytic");
    }

    /**
     * Get the ad groups
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getAdGroups($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/ad_groups', $adAccountId), $data);
        return new Collection($this->master, $response, "AdGroup");
    }

    /**
     * Get the ad group analytics
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getAdGroupAnalytics($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/ad_groups/analytics', $adAccountId), $data);
        return new Collection($this->master, $response, "AdGroupAnalytic");
    }

    /**
     * Get the ads
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getAds($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/ads', $adAccountId), $data);
        return new Collection($this->master, $response, "Ad");
    }

    /**
     * Get the ads analytics
     *
     * @access public
     * @param array     $adAccountId
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return Collection
     */
    public function getAdAnalytics($adAccountId, array $data = [])
    {
        $response = $this->request->get(sprintf('ad_accounts/%s/ads/analytics', $adAccountId), $data);
        return new Collection($this->master, $response, "AdAnalytic");
    }

}
