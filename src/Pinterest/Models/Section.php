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

class Section extends Model {
        
    /**
     * The available object keys
     * 
     * @see https://developers.pinterest.com/docs/api/sections/?
     * 
     * @var array
     */
    protected $fillable = ["id", "name"/*"title"*/];

}
