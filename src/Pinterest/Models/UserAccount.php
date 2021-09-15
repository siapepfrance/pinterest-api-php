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

class UserAccount extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["account_type", "profile_image", "website_url", "username"];

}
