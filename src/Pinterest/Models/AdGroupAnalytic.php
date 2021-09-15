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

class AdGroupAnalytic extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["DATE", "AD_GROUP_ID", "SPEND_IN_DOLLAR", "TOTAL_CLICKTHROUGH"];

}
