<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage\Local\StickersStorageService;

class StickerModel extends Model
{

    public $table = 'stickers';

    public $fillable = [
        'user_id',
        'name',
    ];

    public $timestamps = true;

}
