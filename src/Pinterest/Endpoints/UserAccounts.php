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

use DirkGroenen\Pinterest\Models\UserAccount;
use DirkGroenen\Pinterest\Models\UserAccountAnalytic;

class UserAccounts extends Endpoint {

    /**
     * Get the current user account
     *
     * @access public
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return UserAccount
     */
    public function get(array $data = [])
    {
        $response = $this->request->get('user_account', $data);
        return new UserAccount($this->master, $response);
    }

    /**
     * Get the current user account analytics
     *
     * @access public
     * @param array     $data
     * @throws \DirkGroenen\Pinterest\Exceptions\PinterestException
     * @return UserAccountAnalytic
     */
    public function getAnalytics(array $data = [])
    {
        $response = $this->request->get('user_account/analytics', $data);
        return new UserAccountAnalytic($this->master, $response);
    }

}
