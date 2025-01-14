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

class Pin extends Model {
        
    /**
     * The available object keys
     * 
     * @var array
     */
    protected $fillable = ["id", "link", "title", "description", "alt_text", "board_id", "board_section_id", "board_owner", "media", "media_source", "created_at"/*, "url", "creator", "note", "color", "counts", "attribution", "image", "metadata", "original_link"*/];

}
