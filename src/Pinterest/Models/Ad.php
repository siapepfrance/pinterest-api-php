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

class Ad extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["ad_group_id", "android_deep_link", "carousel_android_deep_links", "carousel_destination_urls", "carousel_ios_deep_links", "click_tracking_url", "creative_type", "destination_url", "ios_deep_link", "is_pin_deleted", "is_removable", "name", "pin_id", "status", "tracking_urls", "view_tracking_url", "ad_account_id", "campaign_id", "collection_items_destination_url_template", "created_time", "id", "rejected_reasons", "rejection_labels", "review_status", "type", "updated_time", "summary_status"];

}
