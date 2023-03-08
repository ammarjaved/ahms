<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityModel extends Model
{
    use HasFactory;
    protected $table = "utility_usage";
    public $timestamps = false;

    protected $fillable =[
        'pd_id',
        'utility_id',
        'on_time',
        'off_time',
        'total_time_in_min',
        'charges'
    ];

}
