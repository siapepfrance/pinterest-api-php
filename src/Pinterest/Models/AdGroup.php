<?php 
/**
 * Copyright 2021 SIAPEP France 
 *
 * (c) SIAPEP France <contact@siapep.fr>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SiapepFrance\Pinterest\Models;

class AdGroup extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["name", "status", "budget_in_micro_currency", "bid_in_micro_currency", "budget_type", "start_time", "end_time", "targeting_spec", "lifetime_frequency_cap", "tracking_urls", "auto_targeting_enabled", "placement_group", "pacing_delivery_type", "conversion_learning_mode_type", "summary_status", "feed_profile_id", "campaign_id", "billable_event", "id", "type", "ad_account_id", "created_time", "updated_time"];

}
