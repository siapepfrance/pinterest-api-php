<?php 
/**
 * Copyright 2021 SIAPEP France 
 *
 * (c) SIAPEP France <contact@siapep.fr>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DirkGroenen\Pinterest\Models;

class AdCampaign extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["id", "ad_account_id", "name", "status", "lifetime_spend_cap", "daily_spend_cap", "order_line_id", "tracking_urls", "objective_type", "created_time", "updated_time", "type"];

}
