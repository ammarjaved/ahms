<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roomInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = "room_info";

    protected $fillable = [
        'floor' ,'room_no' ,'bed_no' ,'pd_id'
    ];
}
