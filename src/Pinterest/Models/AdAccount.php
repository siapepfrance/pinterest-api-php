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

class AdAccount extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["id", "name", "owner", "country", "currency"];

}
